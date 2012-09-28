<?php

namespace Boom\Bundle\LibraryBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BoomLibraryExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $container->setParameter('boom_library.web_path', $config['web_path']);
        $container->setParameter('boom_library.content_upload_path', $config['content_upload_path']);
        $container->setParameter('boom_library.profile_image_path', $config['profile_image_path']);
        $container->setParameter('boom_library.boom_image_path', $config['boom_image_path']);
        $container->setParameter('boom_library.boom_image_background', $config['boom_image_background']);
        $container->setParameter('boom_library.boom_image_sizes', $config['boom_image_sizes']);
    }
}
