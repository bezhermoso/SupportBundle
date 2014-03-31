<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;

/**
 * Interface AuthorInterface
 *
 * @package Bez\SupportBundle\Entity
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 */
interface AuthorInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return string
     */
    public function setName($name);
} 