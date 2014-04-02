<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Model;


use Bez\SupportBundle\Entity\AuthorInterface;
use Bez\SupportBundle\Entity\CommentInterface;
use Bez\SupportBundle\Entity\GuestCompositionInterface;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Query\QueryInterface;

/**
 * Class TicketManager
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Model
 */
abstract class TicketManager implements TicketManagerInterface, CommentManagerInterface
{
    /**
     * @return TicketInterface
     */
    public function createTicket()
    {
        $class = $this->getTicketClass();
        return new $class();
    }

    /**
     * @param $id
     * @return TicketInterface
     */
    public function findTicketById($id)
    {
        return $this->findTicketBy(array('id' => $id));
    }

    /**
     * @param $code
     * @return TicketInterface[]
     */
    public function findTicketByReferenceCode($code)
    {
        return $this->findTicketBy(array('referenceCode' => $code));
    }

    /**
     * @param AuthorInterface $author
     * @return TicketInterface[]
     */
    public function findTicketsByAuthor(AuthorInterface $author)
    {
        return $this->findTicketsBy(array('author' => $author));
    }

    /**
     * @param mixed|array $criteria
     * @return TicketInterface
     */
    abstract public function findTicketBy($criteria);

    /**
     * @param $criteria
     * @return TicketInterface[]
     */
    abstract public function findTicketsBy($criteria);

    /**
     * @return CommentInterface
     */
    public function createComment()
    {
        $class = $this->getCommentClass();
        return new $class();
    }

    /**
     * @return string
     */
    abstract public function getTicketClass();

    /**
     * @return mixed
     */
    abstract public function getCommentClass();
} 