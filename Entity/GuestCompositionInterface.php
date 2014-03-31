<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;


/**
 * Interface GuestCompositionInterface
 *
 * @package Bez\SupportBundle\Entity
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 */
interface GuestCompositionInterface
{
    /**
     * @return string
     */
    public function getAuthorName();

    /**
     * @param string $name
     * @return void
     */
    public function setAuthorName($name);

    /**
     * @return string
     */
    public function getAuthorEmail();

    /**
     * @param string $email
     * @return void
     */
    public function setAuthorEmail($email);
} 