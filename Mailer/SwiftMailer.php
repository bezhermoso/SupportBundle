<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Mailer;

/**
 * Class SwiftMailer
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Mailer
 */
class SwiftMailer implements MailerInterface
{

    protected $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param MessageInterface $message
     * @return mixed
     */
    public function deliverMessage(MessageInterface $message)
    {
        $swift = new \Swift_Message($message->getSubject(), $message->getBody());
        $swift->setFrom($message->getFromEmail(), $message->getFromName());

        foreach ($message->getRecipients() as $recipient) {
            $message->addRecipient($recipient['email'], $recipient['name']);
        }
        $this->mailer->send($swift);
    }
}