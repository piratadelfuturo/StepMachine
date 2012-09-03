<?php
namespace Boom\Bundle\FrontBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FacebookListenerOverrideCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('fos_facebook.security.authentication.listener');
        $definition->setClass('Boom\Bundle\FrontBundle\Security\Firewall\FacebookListener');
        $definition->addMethodCall('setFacebook', array( new Reference('fos_facebook.api')));
        $definition->addMethodCall('setUserManager', array( new Reference('fos_user.user_manager')));
        $definition->addMethodCall('setAuthSecurityContext', array( new Reference('security.context')));
    }
}