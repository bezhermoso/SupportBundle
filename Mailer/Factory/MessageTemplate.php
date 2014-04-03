<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Mailer\Factory;


use Bez\SupportBundle\Entity\CommentInterface;
use Bez\SupportBundle\Entity\GuestAuthor;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Mailer\Message;
use Symfony\Bridge\Twig\Form\TwigRendererEngineInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class MessageTemplate
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Mailer\Factory
 */
class MessageTemplate implements MessageFactoryInterface
{

    protected $ticketTemplate;

    protected $commentTemplate;

    protected $templating;

    protected $fromName;

    protected $fromEmail;

    protected $inbox;

    public function __construct(
        EngineInterface $templating,
        $ticketTemplate,
        $commentTemplate,
        $fromName,
        $fromEmail,
        $inbox = null
    ) {
        $this->templating = $templating;
        $this->ticketTemplate = $ticketTemplate;
        $this->commentTemplate = $commentTemplate;
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->inbox = $inbox;
    }
    /**
     * @param TicketInterface $ticket
     * @return mixed
     */
    public function createFromTicket(TicketInterface $ticket)
    {
        $message = new Message();
        $message->setSubject($ticket->getSubject());
        $message->setFrom($ticket->getAuthor()->getEmail(), $ticket->getAuthor()->getName());
        $message->setBody($this->templating->render($this->ticketTemplate, array('ticket' => $ticket)));
        if ($this->inbox) {
            $message->addRecipient($this->inbox, '');
        }
        return $message;
    }

    /**
     * @param CommentInterface $comment
     * @return mixed
     */
    public function createFromComment(CommentInterface $comment)
    {
        $ticket = $comment->getResponseTo();

        $message = new Message();
        $message->setSubject('Re: ' . $ticket->getSubject());
        $message->setBody($this->templating->render($this->commentTemplate, array('comment' => $comment)));

        $toTicketAuthor = $comment->getAuthor() instanceof GuestAuthor &&
                        $comment->getAuthor()->getEmail() == $ticket->getAuthor()->getEmail();

        $toTicketAuthor = $toTicketAuthor ?:
                          $comment->getAuthor()->getId() == $ticket->getAuthor()->getId();

        if ($toTicketAuthor) {
            $message->addRecipient($ticket->getAuthor()->getEmail(), $ticket->getAuthor()->getName());
            $message->setFrom($this->fromEmail, $this->fromName);
        } elseif ($this->inbox) {
            $message->addRecipient($this->inbox, '');
            $message->setFrom($comment->getAuthor()->getEmail(), $comment->getAuthor()->getName());
        }

        return $message;

    }
}