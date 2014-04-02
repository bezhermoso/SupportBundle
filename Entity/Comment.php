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
     * @var GuestAuthor
     */
    protected $guestAuthor;

    /**
     * @param \Bez\SupportBundle\Entity\AuthorInterface $author
     */
    public function setAuthor(AuthorInterface $author = NULL)
    {
        if ($author == null) {
            $this->authorEmail = null;
            $this->authorName = null;
            $this->author = null;
        } elseif ($author instanceof GuestAuthor) {
            $this->guestAuthor = $author;
            $this->author = null;
            $this->authorName = null;
            $this->authorEmail = null;
        } else {
            $this->author = $author;
        }
    }

    /**
     * @return \Bez\SupportBundle\Entity\AuthorInterface
     */
    public function getAuthor()
    {
        if (!$this->author && !$this->guestAuthor && ($this->authorName !== null || $this->authorEmail !== null)) {
            $this->guestAuthor = new GuestAuthor($this);
            return $this->guestAuthor;
        } elseif (!$this->author && $this->guestAuthor) {
            return $this->guestAuthor;
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
    public function setCreatedDate(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
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

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setAuthorName($name)
    {
        $this->authorName = $name;
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setAuthorEmail($email)
    {
        $this->authorEmail = $email;
    }


}