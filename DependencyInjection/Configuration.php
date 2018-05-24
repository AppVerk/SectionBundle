<?php

namespace AppVerk\SectionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $root = $treeBuilder
            ->root('appverk_sections', 'array')
            ->children();

        $this->addOptionsSection($root);
        $this->addSectionsSection($root);
        $this->addFieldsSection($root);

        return $treeBuilder;
    }

    private function addOptionsSection(NodeBuilder $builder)
    {
        $builder
            ->arrayNode('options')
                ->children()
                    ->booleanNode('translatable')->defaultFalse()->end()
                ->end()
            ->end();
    }

    private function addFieldsSection(NodeBuilder $builder)
    {
        $builder
            ->arrayNode('fields')
                ->prototype('array')
                    ->children()
                        ->scalarNode('factory')->isRequired()->end()
                        ->scalarNode('admin_template')->isRequired()->end()
                    ->end()
                ->end()
            ->end();
    }

    private function addSectionsSection(NodeBuilder $builder)
    {
        $builder
            ->arrayNode('sections')
                ->prototype('array')
                    ->children()
                        ->scalarNode('name')->end()
                        ->scalarNode('block')->defaultNull()->end()
                        ->scalarNode('preview')->defaultFalse()->end()
                        ->scalarNode('admin_template')->end()
                        ->scalarNode('model')->end()
                        ->arrayNode('fields')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('title')->end()
                                    ->scalarNode('type')->isRequired()->end()
                                    ->scalarNode('control')->end()
                                    ->scalarNode('label')->end()
                                    ->scalarNode('name')->end()
                                    ->scalarNode('text')->end()
                                        ->arrayNode('options')
                                            ->arrayPrototype()
                                                ->children()
                                                    ->scalarNode('label')->end()
                                                    ->scalarNode('value')->end()
                                                    ->scalarNode('name')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->booleanNode('settings')->defaultFalse()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
