<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;

/**
 * Interface CommentInterface
 *
 * @package Bez\SupportBundle\Entity
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 */
interface CommentInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return TicketInterface
     */
    public function getResponseTo();

    /**
     * @param TicketInterface $ticket
     * @return void
     */
    public function setResponseTo(TicketInterface $ticket);

    /**
     * @return AuthorInterface
     */
    public function getAuthor();

    /**
     * @param AuthorInterface $author
     * @return void
     */
    public function setAuthor(AuthorInterface $author);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @param $body
     * @return void
     */
    public function setBody($body);

    /**
     * @return \DateTime
     */
    public function getCreatedDate();

    /**
     * @param \DateTime $created
     * @return void
     */
    public function setCreatedDate(\DateTime $created);
}