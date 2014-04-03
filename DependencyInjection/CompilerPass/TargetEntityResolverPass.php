<?php
/**
 * Copyright 2014 Bezalel Hermoso <bezalelhermoso@gmail.com>
 * 
 * This project is free software released under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php 
 */

namespace Bez\SupportBundle\DependencyInjection\CompilerPass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TargetEntityResolverPass
 *
 * @author Bezalel Hermoso <bezalelhermoso@gmail.com>
 * @package Bez\SupportBundle\DependencyInjection\CompilerPass
 */
class TargetEntityResolverPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('bez_support.config')) {
            return;
        }

        $config = $container->getParameter('bez_support.config');

        if ($config['resolve_target_entities'] == false) {
            return;
        }

        if (!$container->hasDefinition('doctrine.orm.listeners.resolve_target_entity')) {
            return;
        }
        $resolver = $container->getDefinition('doctrine.orm.listeners.resolve_target_entity');

        $resolutions = array(
            'Bez\SupportBundle\Entity\AuthorInterface' => $config['author_class'],
            'Bez\SupportBundle\Entity\TicketInterface' => $config['ticket_class'],
        );

        foreach ($resolutions as $interface => $implementation) {
            $resolver->addMethodCall('addResolveTargetEntity', array($interface, $implementation, array()));
        }

        $tags = $resolver->getTags();

        $ev = $this->getAppropriateEventManager($container, $config);

        if (!isset($tags['doctrine.event_listener'])) {
            $ev->addMethodCall('addEventListener', array(
                array('loadClassMetadata'),
                new Reference('doctrine.orm.listeners.resolve_target_entity')
            ));
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     * @return null|\Symfony\Component\DependencyInjection\Definition
     */
    private function getAppropriateEventManager(ContainerBuilder $container, $config)
    {
        $ev = null;

        if ($container->hasDefinition('doctrine.dbal.default_connection.event_manager')) {
            $ev = $container->getDefinition('doctrine.dbal.default_connection.event_manager');
        }

        if ($config['object_manager_name']) {
            $ev = $container->getDefinition(
                                sprintf(
                                    'doctrine.dbal.%s_connection.event_manager',
                                    $config['object_manager_name']));
        }

        return $ev;
    }
}