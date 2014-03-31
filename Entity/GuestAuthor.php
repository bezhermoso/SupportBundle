<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Entity;


/**
 * Class GuestAuthor
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Entity
 */
class GuestAuthor implements AuthorInterface
{
    /**
     * @var GuestCompositionInterface
     */
    protected $composition;

    /**
     * @param GuestCompositionInterface $composition
     */
    public function __construct(GuestCompositionInterface $composition)
    {
        $this->setComposition($composition);
    }

    /**
     * @param GuestCompositionInterface $composition
     */
    public function setComposition(GuestCompositionInterface $composition)
    {
        $this->composition = $composition;
    }

    /**
     * @throws \DomainException
     * @return void
     */
    public function getId()
    {
        throw new \DomainException('GuestAuthor entities does not have unique IDs.');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->composition->getAuthorEmail();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->composition->getAuthorName();
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->composition->setAuthorEmail($email);
    }

    /**
     * @param $name
     * @return string|void
     */
    public function setName($name)
    {
       $this->composition->setAuthorName($name);
    }
}