<?php

namespace Boom\Bundle\LibraryBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('boom_library', 'array' );

        $rootNode
            ->children()
                ->scalarNode('web_path')
                    ->defaultValue('%kernel.root_dir%/../web/')
                ->end()
                ->scalarNode('content_upload_path')
                    ->defaultValue('content/')
                ->end()
                ->scalarNode('boom_image_path')
                    ->defaultValue('%boom_library.content_upload_path%boom-img/')
                ->end()
                ->scalarNode('boom_image_background')
                    ->defaultValue('%kernel.root_dir%/../web/pattern.png')
                ->end()
                ->arrayNode('boom_image_sizes')
                    ->canBeUnset()
                    ->ignoreExtraKeys()
                    ->defaultValue(array(
                        array(
                            'width'     => 100,
                            'height'    => 100,
                            'quality'   => 90,
                            'thumbnail' => true
                        ),
                    ))
                    ->prototype('array')
                        ->children()
                            ->scalarNode('width')->end()
                            ->scalarNode('height')->end()
                            ->scalarNode('quality')
                                ->defaultValue(90)
                            ->end()
                            ->booleanNode('thumbnail')
                                ->defaultValue(true)
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('profile_image_path')
                    ->defaultValue('%boom_library.content_upload_path%user/')
                ->end()
                ->scalarNode('profile_image_background')
                    ->defaultValue('%kernel.root_dir%/../web/pattern.png')
                ->end()
                ->arrayNode('profile_image_sizes')
                    ->canBeUnset()
                    ->ignoreExtraKeys()
                    ->defaultValue(array(
                        array(
                            'width'     => 150,
                            'height'    => 150,
                            'quality'   => 90,
                            'thumbnail' => true
                        ),
                    ))
                    ->prototype('array')
                        ->children()
                            ->scalarNode('width')->end()
                            ->scalarNode('height')->end()
                            ->scalarNode('quality')
                                ->defaultValue(90)
                            ->end()
                            ->booleanNode('thumbnail')
                                ->defaultValue(true)
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('boom_widget_blocks')
                    ->canBeUnset()
                    ->ignoreExtraKeys()
                    ->defaultValue(array())
                    ->prototype('scalar')
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
