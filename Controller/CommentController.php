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
use Bez\SupportBundle\Event\FilterCommentResponseEvent;
use Bez\SupportBundle\Event\FormEvent;
use Bez\SupportBundle\SupportEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommentController
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Controller
 */
class CommentController extends Controller
{
    /**
     * @param Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $ticket = $this->get('bez_support.ticket_manager')->findTicketByReferenceCode($request->get('ticket'));

        if ($ticket == false) {
            throw $this->createNotFoundException('Ticket not found.');
        }

        $commentManager = $this->get('bez_support.comment_manager');
        $events = $this->get('event_dispatcher');
        $formFactory = $this->get('bez_support.form_factory.comment');

        $comment = $commentManager->createComment();

        $comment->setResponseTo($ticket);

        $isAnonymous = !$this->get('security.context')->getToken() ||
            ($this->get('security.context')->getToken() && $this->get('security.context')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY'));

        if ($comment instanceof GuestCompositionInterface && $isAnonymous) {
            $comment->setAuthor(new GuestAuthor($comment));
        }

        $form = $formFactory->createForm();

        $form->setData($comment);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $event = new FormEvent($form, $request);
                $events->dispatch(SupportEvents::CREATE_COMMENT_SUCCESS, $event);

                $commentManager->saveComment($comment);

                if (null == $response = $event->getResponse()) {
                    $response = new RedirectResponse(
                                        $this->generateUrl( 'bez_support_view_ticket',
                                                            array(
                                                                'ticket' => $request->get('ticket')
                                                            )));
                }

                $event = new FilterCommentResponseEvent($comment, $request, $response);
                $events->dispatch(SupportEvents::CREATE_COMMENT_COMPLETED, $event);

                return $event->getResponse();

            }

        }

        return $this->get('templating')->renderResponse('BezSupportBundle:Comment:new.html.twig', array(
            'comment_form' => $form->createView(),
            'ticket' => $ticket,
        ));
    }
} 