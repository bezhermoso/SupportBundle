<?php

namespace Bez\SupportBundle\Form;

use Bez\SupportBundle\Entity\TicketInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Class TicketType
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Form
 */
class TicketType extends AbstractType
{
    protected $ticketClass;

    protected $security;

    /**
     * @param $ticketClass
     * @param SecurityContextInterface $security
     */
    public function __construct($ticketClass, SecurityContextInterface $security)
    {
        $this->ticketClass = $ticketClass;
        $this->security = $security;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', 'text')
            ->add('body', 'textarea');

        $builder->addEventListener(FormEvents::POST_SET_DATA, array($this, 'onPostsetData'));

    }

    /**
     * @param FormEvent $event
     */
    public function onPostsetData(FormEvent $event)
    {
        $ticket = $event->getData();

        if (!$ticket instanceof TicketInterface) {
            return;
        }

        if ($ticket->getId()) {
            $event->getForm()->remove('subject');
        }

        if ($ticket->getAuthor()) {
            $event->getForm()->add('author', 'bez_support_author');
        }

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->ticketClass
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bez_support_ticket';
    }
}
