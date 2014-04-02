<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Doctrine;


use Bez\SupportBundle\Entity\TicketInterface;
use Bez\SupportBundle\Utility\ReferenceCodeGeneratorInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * Class TicketRefCodeListener
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Doctrine
 */
class TicketRefCodeListener implements EventSubscriber
{
    protected $refCodeGenerator;

    /**
     * @param ReferenceCodeGeneratorInterface $refCodeGenerator
     */
    public function __construct(ReferenceCodeGeneratorInterface $refCodeGenerator)
    {
        $this->refCodeGenerator = $refCodeGenerator;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::postPersist
        );
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        $em = $args->getEntityManager();

        if ($object instanceof TicketInterface) {
            if ($object->getReferenceCode()) {
                $this->refCodeGenerator->generate($object);
                $em->persist($object);
                $em->flush();
            }
        }
    }
}