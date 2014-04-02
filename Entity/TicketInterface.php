<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;

/**
 * Interface TicketInterface
 *
 * @package Bez\SupportBundle\Model
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 */
interface TicketInterface
{
    const STATUS_OPEN = 0;

    const STATUS_CLOSED = 1;

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getReferenceCode();

    /**
     * @param $code
     * @return void
     */
    public function setReferenceCode($code);

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @param $subject
     * @return void
     */
    public function setSubject($subject);

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
     * @return AuthorInterface
     */
    public function getAuthor();

    /**
     * @param AuthorInterface $author
     * @return void
     */
    public function setAuthor(AuthorInterface $author = NULL);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param $status
     * @return void
     */
    public function setStatus($status);

    /**
     * @return \DateTime
     */
    public function getCreatedDate();

    /**
     * @param \DateTime $created
     * @return void
     */
    public function setCreatedDate(\DateTime $created);

    /**
     * @return \DateTime
     */
    public function getUpdatedDate();

    /**
     * @param \DateTime $updated
     * @return void
     */
    public function setUpdatedDate(\DateTime $updated);
}