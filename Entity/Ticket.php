<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;

/**
 * Class Ticket
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Entity
 */
abstract class Ticket implements TicketInterface, GuestCompositionInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $referenceCode;

    /**
     * @var AuthorInterface
     */
    protected $author;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $authorName = null;

    /**
     * @var string
     */
    protected $authorEmail = null;

    /**
     *
     */
    public function __construct()
    {
        $this->status = self::STATUS_OPEN;
    }

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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $referenceCode
     */
    public function setReferenceCode($referenceCode)
    {
        $this->referenceCode = $referenceCode;
    }

    /**
     * @return string
     */
    public function getReferenceCode()
    {
        return $this->referenceCode;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdatedDate(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updated;
    }

    /**
     * Set author's name.
     *
     * Not to be used directly. Use same method on object returned by TicketInterface#getAuthor instead.
     *
     * @param string $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * Not to be used directly. Use same method on object returned by TicketInterface#getAuthor instead.
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set author's email.
     *
     * Not to be used directly. Use same method on object returned by TicketInterface#getAuthor instead.
     *
     * @param string $authorEmail
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * Not to be used directly. Use same method on object returned by TicketInterface#getAuthor instead.
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }
} 