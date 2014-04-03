<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Mailer;


/**
 * Interface MailerInterface
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Utility
 */
interface MailerInterface
{
    /**
     * @param MessageInterface $message
     * @return mixed
     */
    public function deliverMessage(MessageInterface $message);
} 