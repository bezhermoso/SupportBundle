<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\EventListener;


use Composer\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class FlashMessages implements EventSubscriberInterface
{
    protected $session;

    protected $translator;

    protected static $messages = array();

    /**
     * @param Session $session
     * @param TranslatorInterface $translator
     */
    public function __construct(Session $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array_fill_keys(array_keys(static::$messages), 'addFlash');
    }

    /**
     * @param Event $event
     * @throws \InvalidArgumentException
     */
    public function addFlash(Event $event)
    {
        if (!isset(static::$messages[$event->getName()])) {
            throw new \InvalidArgumentException('Cannot find appropriate flash message for event "' . $event->getName() . '"');
        }

        $message = static::$messages[$event->getName()];
        $this->session->getFlashBag()->add('success', $this->translator->trans($message, array(), 'BezSupportBundle'));
    }
}