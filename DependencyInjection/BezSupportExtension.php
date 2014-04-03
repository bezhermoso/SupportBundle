<?php

namespace Bez\SupportBundle\DependencyInjection;

use Bez\SupportBundle\DependencyInjection\CompilerPass\TargetEntityResolverPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BezSupportExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('orm.xml');
        $loader->load('forms.xml');
        $loader->load('listeners.xml');
        $loader->load('mailer.xml');

        $container->setAlias('bez_support.ticket_manager', $config['services']['ticket_manager']);
        $container->setAlias('bez_support.comment_manager', $config['services']['comment_manager']);
        $container->setAlias('bez_support.ref_code_generator', $config['services']['ref_code_generator']);
        $container->setAlias('bez_support.mailer', $config['services']['mailer']);

        $container->setParameter('bez_support.config', $config);
        $container->setParameter('bez_support.orm.entity_manager', $config['object_manager_name']);

        $container->setParameter('bez_support.orm.ticket_class', $config['ticket_class']);
        $container->setParameter('bez_support.orm.comment_class', $config['comment_class']);
        $container->setParameter('bez_support.orm.author_class', $config['author_class']);

        $container->setParameter('bez_support.mailer.from_email', $config['mailer']['from_email']);
        $container->setParameter('bez_support.mailer.from_name', $config['mailer']['from_name']);
        $container->setParameter('bez_support.mailer.inbox', $config['mailer']['inbox']);

        $container->setParameter('bez_support.mailer.ticket_template', $config['email_templates']['ticket']);
        $container->setParameter('bez_support.mailer.comment_template', $config['email_templates']['comment']);

    }
}
