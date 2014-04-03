<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\EventListener;


use Bez\SupportBundle\Event\FilterCommentResponseEvent;
use Bez\SupportBundle\Event\FilterTicketResponseEvent;
use Bez\SupportBundle\Mailer\Factory\MessageFactoryInterface;
use Bez\SupportBundle\Mailer\MailerInterface;
use Bez\SupportBundle\SupportEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class MailDeliveries
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\EventListener
 */
class MailDeliveries implements EventSubscriberInterface
{

    protected $factory;

    protected $mailer;

    /**
     * @param MessageFactoryInterface $factory
     * @param MailerInterface $mailer
     */
    public function __construct(MessageFactoryInterface $factory, MailerInterface $mailer)
    {
        $this->factory = $factory;
        $this->mailer = $mailer;
    }

    /**
     * @return array|void
     */
    public static function getSubscribedEvents()
    {
        return array(
            SupportEvents::CREATE_TICKET_COMPLETED => array('onTicketCreation'),
            SupportEvents::CREATE_COMMENT_COMPLETED => array('onCommentCreation'),
        );
    }

    /**
     * @param FilterTicketResponseEvent $event
     */
    public function onTicketCreation(FilterTicketResponseEvent $event)
    {
        $ticket = $event->getTicket();

        $message = $this->factory->createFromTicket($ticket);

        if (count($message->getRecipients())) {
            $this->mailer->deliverMessage($message);
        }
    }

    /**
     * @param FilterCommentResponseEvent $event
     */
    public function onCommentCreation(FilterCommentResponseEvent $event)
    {
        $comment = $event->getComment();

        $message = $this->factory->createFromComment($comment);

        if (count($message->getRecipients())) {
            $this->mailer->deliverMessage($message);
        }
    }
}