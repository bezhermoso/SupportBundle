<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Query;


use Bez\SupportBundle\Entity\TicketInterface;

/**
 * Class CommentQuery
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Query
 */
class CommentQuery implements QueryInterface
{

    protected $ticket;

    protected $maxResults;

    protected $startAt;

    protected $orderBy;

    public function __construct()
    {
        $this->orderBy = 'created ASC';
    }

    /**
     * @return int|null
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @return int|null
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->order;
    }

    /**
     * @param int $maxResults
     * @return $this
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    /**
     * @param int $start
     * @return $this
     */
    public function setStartAt($start)
    {
        $this->startAt = $start;
        return $this;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrderBy($order)
    {
        $this->orderBy = $order;
        return $this;
    }

    /**
     * @param TicketInterface $ticket
     * @return $this
     */
    public function setTicket(TicketInterface $ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }

    /**
     * @return TicketInterface
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}