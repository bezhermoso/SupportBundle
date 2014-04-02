<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Doctrine;


use Bez\SupportBundle\Entity\CommentInterface;
use Bez\SupportBundle\Entity\TicketInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * Class TimestampListener
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Doctrine
 */
class TimestampListener implements EventSubscriber
{

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate
        );
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof TicketInterface) {
            if ($entity->getCreatedDate() == null) {
                $entity->setCreatedDate(new \DateTime());
            }

            if ($entity->getUpdatedDate() == null) {
                $entity->setUpdatedDate(new \DateTime());
            }
        }

        if ($entity instanceof CommentInterface && $entity->getCreatedDate() == null) {
            $entity->setCreatedDate(new \DateTime());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        /**
         * @todo Inject timestamp on update, if and only if update date is not modified by user.
         */
    }

}