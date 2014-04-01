<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Doctrine;

use Bez\SupportBundle\Entity\AuthorInterface;
use Bez\SupportBundle\Entity\GuestAuthor;
use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Model\TicketManager as BaseTicketManager;
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
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    /**
     * @param EntityManager $em
     * @param $ticketClass
     */
    public function __construct(EntityManager $em, $ticketClass)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($ticketClass);

        $metadata = $em->getClassMetadata($ticketClass);
        $this->ticketClass = $metadata->getName();
    }

    /**
     * @param mixed|array $criteria
     * @return TicketInterface
     */
    public function findTicketBy($criteria)
    {

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
}