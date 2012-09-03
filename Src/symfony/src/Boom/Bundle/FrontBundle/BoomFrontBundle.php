<?php

namespace Boom\Bundle\FrontBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Boom\Bundle\FrontBundle\DependencyInjection\Compiler\FacebookListenerOverrideCompilerPass;

class BoomFrontBundle extends Bundle {

    /*
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new FacebookListenerOverrideCompilerPass());
    }*/

}
