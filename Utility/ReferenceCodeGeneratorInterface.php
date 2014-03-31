<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Utility;


use Bez\SupportBundle\Entity\TicketInterface;

/**
 * Interface ReferenceCodeGeneratorInterface
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Utility
 */
interface ReferenceCodeGeneratorInterface
{
    /**
     * @param TicketInterface $ticket
     * @return string
     * @throws \DomainException
     */
    public function generate(TicketInterface $ticket);
} 