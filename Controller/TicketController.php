<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Controller;


use Bez\SupportBundle\Entity\GuestAuthor;
use Bez\SupportBundle\Entity\GuestCompositionInterface;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Event\FilterTicketResponseEvent;
use Bez\SupportBundle\Event\FormEvent;
use Bez\SupportBundle\Form\TicketType;
use Bez\SupportBundle\SupportEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $formFactory = $this->get('bez_support.form_factory.ticket');
        $ticketManager = $this->get('bez_support.ticket_manager');
        $events = $this->get('event_dispatcher');

        $form = $formFactory->createForm();
        $ticket = $ticketManager->createTicket();

        $security = $this->get('security.context');

        $isAnonymous = !$security->getToken() || ($security->getToken() && $security->isGranted('IS_AUTHENTICATED_ANONYMOUSLY'));

        if ($ticket instanceof GuestCompositionInterface && $isAnonymous) {
                $ticket->setAuthor(new GuestAuthor($ticket));
        }

        $form->setData($ticket);


        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $events->dispatch(SupportEvents::CREATE_TICKET_SUCCESS, $event);

                $ticketManager->saveTicket($ticket);

                if (null === $response = $event->getResponse()) {
                    $response = new RedirectResponse($this->generateUrl('bez_support_create_ticket_completed'));
                }

                $event = new FilterTicketResponseEvent($ticket, $request, $response);
                $events->dispatch(SupportEvents::CREATE_TICKET_COMPLETED, $event);

                return $event->getResponse();

            }
        }

        return $this->get('templating')->renderResponse('BezSupportBundle:Ticket:new.html.twig', array(
            'ticket_form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newSuccessAction(Request $request)
    {
        return $this->get('templating')->renderResponse('BezSupportBundle:Ticket:newSuccess.html.twig');
    }
} 