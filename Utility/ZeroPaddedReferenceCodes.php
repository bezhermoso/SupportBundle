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
 * Class ReferenceCodeGenerator
 *
 * Default reference code generator.
 *
 * Generates an 8-digit reference code; an 8-digit zero-padded version of the ticket's unique identifier.
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Utility
 */
class ReferenceCodeGenerator implements ReferenceCodeGeneratorInterface
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

        $code = str_pad($ticket->getId(), 8, 0, STR_PAD_LEFT);
        $ticket->setReferenceCode($code);

        return $code;

    }
}