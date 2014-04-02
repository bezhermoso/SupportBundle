<?php

namespace Bez\SupportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Class CommentType
 *
 *
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Form
 */
class CommentType extends AbstractType
{
    /**
     * @var SecurityContextInterface|null
     */
    protected $security;

    protected $commentClass;

    /**
     * @param SecurityContextInterface $security
     */
    public function __construct($commentClass, SecurityContextInterface $security = null)
    {
        $this->commentClass = $commentClass;
        $this->security = $security;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('body', 'textarea');

        $builder->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubnmit'));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPresetData'));
    }

    /**
     * @param FormEvent $event
     */
    public function onPresetData(FormEvent $event)
    {
        if (!$this->security) {
            return;
        }

        if ($this->security->isGranted('ROLE_SUPPORT_STAFF')) {
            /**
             * @todo Add status resolution input fields
             */
        }

    }

    /**
     * @param FormEvent $event
     */
    public function onPostSubmit(FormEvent $event)
    {

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->commentClass,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bez_support_ticket_comment';
    }
}
