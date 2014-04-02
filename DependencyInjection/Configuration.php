<?php

namespace Bez\SupportBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bez_support');

        $rootNode
            ->children()
                ->scalarNode('ticket_class')->cannotBeEmpty()->isRequired()->end()
                ->scalarNode('comment_class')->cannotBeEmpty()->isRequired()->end()
                ->scalarNode('author_class')->cannotBeEmpty()->isRequired()->end()
                ->scalarNode('object_manager_name')->defaultNull()->end()
            ->end();

        $this->attachServiceConfig($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function attachServiceConfig(ArrayNodeDefinition $node)
    {
        $node->addDefaultsIfNotSet()
             ->children()
                ->arrayNode('services')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('ticket_manager')->defaultValue('bez_support.ticket_manager.default')->end()
                            ->scalarNode('comment_manager')->defaultValue('bez_support.ticket_manager.default')->end()
                            ->scalarNode('ref_code_generator')->defaultValue('bez_support.ref_code_generator.default')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
