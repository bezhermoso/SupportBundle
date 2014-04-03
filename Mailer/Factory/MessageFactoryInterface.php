<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Mailer\Factory;


use Bez\SupportBundle\Entity\CommentInterface;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Mailer\MessageInterface;

/**
 * Interface MessageFactoryInterface
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Mailer\Factory
 */
interface MessageFactoryInterface
{
    /**
     * @param TicketInterface $ticket
     * @return MessageInterface
     */
    public function createFromTicket(TicketInterface $ticket);

    /**
     * @param CommentInterface $comment
     * @return MessageInterface
     */
    public function createFromComment(CommentInterface $comment);
} 