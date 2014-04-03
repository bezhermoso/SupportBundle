<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Mailer;

/**
 * Interface MessageInterface
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Mailer
 */
interface MessageInterface
{
    /**
     * @return mixed
     */
    public function getSubject();

    /**
     * @param $subject
     * @return mixed
     */
    public function setSubject($subject);

    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @param $body
     * @return mixed
     */
    public function setBody($body);

    /**
     * @return mixed
     */
    public function isHtml();

    /**
     * @return mixed
     */
    public function getFromName();

    /**
     * @return mixed
     */
    public function getFromEmail();

    /**
     * @param $email
     * @param $name
     * @return mixed
     */
    public function setFrom($email, $name);

    /**
     * @return mixed
     */
    public function getRecipients();

    /**
     * @param $recipientEmail
     * @param $recipientName
     * @return mixed
     */
    public function addRecipient($recipientEmail, $recipientName);
} 