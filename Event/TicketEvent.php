<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Event;


use Bez\SupportBundle\Entity\TicketInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TicketEvent
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Event
 */
class TicketEvent extends Event
{
    protected $ticket;
    protected $request;

    /**
     * @param TicketInterface $ticket
     * @param Request $request
     */
    public function __construct(TicketInterface $ticket, Request $request)
    {
        $this->ticket = $ticket;
        $this->request = $request;
    }

    /**
     * @return TicketInterface
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
} 