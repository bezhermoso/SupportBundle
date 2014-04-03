<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Model;


use Bez\SupportBundle\Entity\CommentInterface;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Query\QueryInterface;

interface CommentManagerInterface
{
    /**
     * @return CommentInterface
     */
    public function createComment();

    /**
     * @param TicketInterface $ticket
     * @param \Bez\SupportBundle\Query\QueryInterface $query
     * @return CommentInterface[]
     */
    public function findCommentsOnTicket(TicketInterface $ticket, QueryInterface $query = NULL);

    /**
     * @param CommentInterface $comment
     * @return void
     */
    public function saveComment(CommentInterface $comment);
} 