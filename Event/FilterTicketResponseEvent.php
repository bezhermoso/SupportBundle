<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Event;

use Bez\SupportBundle\Entity\TicketInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FilterTicketResponseEvent
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Event
 */
class FilterTicketResponseEvent extends TicketEvent
{

    protected $response;

    /**
     * @param TicketInterface $ticket
     * @param Request $request
     * @param Response $response
     */
    public function __construct(TicketInterface $ticket, Request $request, Response $response)
    {
        parent::__construct($ticket, $request);
        $this->response = $response;
    }


    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

} 