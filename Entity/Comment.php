<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;

/**
 * Class Comment
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Entity
 */
abstract class Comment implements CommentInterface, GuestCompositionInterface
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var TicketInterface
     */
    protected $responseTo;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var AuthorInterface
     */
    protected $author;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var string|null
     */
    protected $authorName = null;

    /**
     * @var string|null
     */
    protected $authorEmail = null;

    /**
     * @param \Bez\SupportBundle\Entity\AuthorInterface $author
     */
    public function setAuthor(AuthorInterface $author)
    {
        $this->author = $author;
    }

    /**
     * @return \Bez\SupportBundle\Entity\AuthorInterface
     */
    public function getAuthor()
    {
        if (!$this->author && ($this->authorName !== null || $this->authorEmail !== null)) {
            $this->author = new GuestAuthor($this);
        }
        return $this->author;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Bez\SupportBundle\Entity\TicketInterface $responseTo
     */
    public function setResponseTo(TicketInterface $responseTo)
    {
        $this->responseTo = $responseTo;
    }

    /**
     * @return \Bez\SupportBundle\Entity\TicketInterface
     */
    public function getResponseTo()
    {
        return $this->responseTo;
    }

}