<?php

namespace Bez\SupportBundle\Form;

use Bez\SupportBundle\Entity\TicketInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class TicketType
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\Form
 */
class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', 'text')
            ->add('body', 'textarea');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPresetData'));

    }

    /**
     * @param FormEvent $event
     */
    public function onPresetData(FormEvent $event)
    {
        $ticket = $event->getData();

        if (!$ticket instanceof TicketInterface) {
            return;
        }

        if ($ticket->getId()) {
            $event->getForm()->remove('subject');
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bez\SupportBundle\Entity\TicketInterface'
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
