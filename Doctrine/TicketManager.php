<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Doctrine;


use Bez\SupportBundle\Entity\CommentInterface;
use Bez\SupportBundle\Entity\GuestAuthor;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Model\TicketManager as BaseTicketManager;
use Bez\SupportBundle\Query\QueryInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class TicketManager
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Doctrine
 */
class TicketManager extends BaseTicketManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $ticketClass;

    /**
     * @var string
     */
    protected $commentClass;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $tickets;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $comments;

    /**
     * @param EntityManager $em
     * @param $ticketClass
     * @param $commentClass
     */
    public function __construct(EntityManager $em, $ticketClass, $commentClass)
    {
        $this->em = $em;
        $this->tickets = $em->getRepository($ticketClass);

        $metadata = $em->getClassMetadata($ticketClass);
        $this->ticketClass = $metadata->getName();

        $this->comments = $em->getRepository($commentClass);

        $metadata = $em->getClassMetadata($commentClass);
        $this->commentClass = $metadata->getName();

    }

    /**
     * @param mixed|array $criteria
     * @return TicketInterface
     */
    public function findTicketBy($criteria)
    {
        return $this->tickets->findOneBy($criteria);
    }

    /**
     * @param $criteria
     * @return TicketInterface[]
     */
    public function findTicketsBy($criteria)
    {
        if (array_key_exists('author', $criteria)) {

            $author = $criteria['author'];

            if ($author instanceof GuestAuthor) {
                $criteria['authorEmail'] = $author->getEmail();
                unset($criteria['author']);
            }
        }

        return $this->tickets->findBy($criteria);
    }

    /**
     * @param TicketInterface $ticket
     * @param bool $flush
     * @return void
     */
    public function saveTicket(TicketInterface $ticket, $flush = true)
    {
        $this->em->persist($ticket);

        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * @return string
     */
    public function getTicketClass()
    {
        return $this->ticketClass;
    }

    /**
     * @param TicketInterface $ticket
     * @param \Bez\SupportBundle\Query\QueryInterface $query
     * @return CommentInterface[]
     */
    public function findCommentsOnTicket(TicketInterface $ticket, QueryInterface $query)
    {
        $this->comments->findBy(
                            array('ticket' => $ticket),
                            $query->getOrderBy(),
                            $query->getMaxResults(),
                            $query->getStartAt());
    }

    /**
     * @return mixed
     */
    public function getCommentClass()
    {
        return $this->commentClass;
    }

    /**
     * @param CommentInterface $comment
     * @param bool $flush
     * @return void
     */
    public function saveComment(CommentInterface $comment, $flush = true)
    {
        $this->em->persist($comment);

        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * @return array|\Bez\SupportBundle\Entity\TicketInterface[]
     */
    public function findAllTickets()
    {
        return $this->tickets->findAll();
    }
}
