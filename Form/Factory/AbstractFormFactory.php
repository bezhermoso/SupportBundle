<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\Form\Factory;


use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;

/**
 * Class AbstractFormFactory
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Form\Factory
 */
abstract class AbstractFormFactory
{
    protected $factory;

    protected $name;

    protected $options = array();

    protected $validationGroups = array();

    public function __construct(
        FormFactoryInterface $factory,
        $name,
        array $options = array(),
        array $validationGroups = array()
    ) {
        $this->factory = $factory;
        $this->name = $name;
        $this->options = $options;
        $this->validationGroups = $validationGroups;
    }

    /**
     * @param null $name
     * @param array $options
     * @param array $validationGroups
     * @return FormInterface
     */
    public function createForm($name = null, array $options = null, array $validationGroups = null)
    {
        $name = $name ?: $this->name;

        if ($options !== null) {
            $options = array_replace($this->options, $options);
        } else {
            $options = $this->options;
        }

        if ($validationGroups !== null) {
            $validationGroups = array_replace($this->validationGroups, $validationGroups);
        } else {
            $validationGroups = $this->validationGroups;
        }

        $options['validation_groups'] = $validationGroups;

        return $this->factory->createNamed($name, $this->getFormType(), null, $options);
    }

    /**
     * @return string|FormTypeInterface
     */
    abstract public function getFormType();
}