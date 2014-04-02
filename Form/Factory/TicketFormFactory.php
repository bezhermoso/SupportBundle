<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Form\Factory;


use Symfony\Component\Form\FormTypeInterface;

/**
 * Class TicketFormFactory
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Form\Factory
 */
class TicketFormFactory extends AbstractFormFactory
{

    /**
     * @return string|FormTypeInterface
     */
    public function getFormType()
    {
        return 'bez_support_ticket';
    }
}