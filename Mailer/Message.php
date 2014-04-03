<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Mailer;

/**
 * Class Message
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Mailer
 */
class Message implements MessageInterface
{

    protected $subject;

    protected $body;

    protected $recipients = array();

    protected $fromName;

    protected $fromEmail;
    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param $subject
     * @return mixed
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $body
     * @return mixed
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function isHtml()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getFromName()
    {
        // TODO: Implement getFromName() method.
    }

    /**
     * @return mixed
     */
    public function getFromEmail()
    {
        // TODO: Implement getFromEmail() method.
    }

    /**
     * @param $email
     * @param $name
     * @return mixed
     */
    public function setFrom($email, $name)
    {
        $this->fromEmail = $email;
        $this->fromName = $name;
    }


    /**
     * @return mixed
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param $recipientEmail
     * @param $recipientName
     * @return mixed
     */
    public function addRecipient($recipientEmail, $recipientName)
    {
        $this->recipients[] = array('email' => $recipientEmail, 'name' => $recipientName);
    }
}