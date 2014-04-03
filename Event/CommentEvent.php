<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Event;


use Bez\SupportBundle\Entity\CommentInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommentEvent
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Event
 */
class CommentEvent extends Event
{
    protected $comment;

    protected $request;

    /**
     * @param CommentInterface $comment
     * @param Request $request
     */
    public function __construct(CommentInterface $comment, Request $request)
    {
        $this->comment = $comment;
        $this->request = $request;
    }

    /**
     * @return CommentInterface
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
} 