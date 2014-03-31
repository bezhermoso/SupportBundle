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
 * Class DatedReferenceCodes
 *
 * Generates reference codes in the following format:
 *
 * YYYY-NNNNNN
 * <four-digit year>-<6-digit zero-padded unique identifier>
 *
 * Example: 2014-000042
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Utility
 */
class DatedReferenceCodes implements ReferenceCodeGeneratorInterface
{

    /**
     * @param TicketInterface $ticket
     * @return string
     * @throws \DomainException
     */
    public function generate(TicketInterface $ticket)
    {
        if (!$ticket->getId()) {
            throw new \DomainException('Ticket must have a unique identifier before a reference code can be generated for it. '
                . 'Ticket passed is probably not persisted yet.');
        }

        if ($ticket->getReferenceCode()) {
            throw new \DomainException(
                sprintf('Ticket already has reference code: %s',
                    $ticket->getReferenceCode()
                ));
        }

        $code = sprintf('%s-%06d', $ticket->getCreatedDate()->format('Y'), $ticket->getId());

        $ticket->setReferenceCode($code);

        return $code;
    }
}