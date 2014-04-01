<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Model;
use Bez\SupportBundle\Entity\AuthorInterface;
use Bez\SupportBundle\Entity\TicketInterface;


/**
 * Interface TicketManagerInterface
 *
 * @package Bez\SupportBundle\Model
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 */
interface TicketManagerInterface
{
    /**
     * @return TicketInterface
     */
    public function createTicket();

    /**
     * @param TicketInterface $ticket
     * @return void
     */
    public function saveTicket(TicketInterface $ticket);

    /**
     * @return string
     */
    public function getTicketClass();

    /**
     * @param $id
     * @return TicketInterface
     */
    public function findTicketById($id);

    /**
     * @param $code
     * @return TicketInterface[]
     */
    public function findTicketByReferenceCode($code);

    /**
     * @param AuthorInterface $author
     * @return TicketInterface[]
     */
    public function findTicketsByAuthor(AuthorInterface $author);
}