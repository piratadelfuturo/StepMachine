<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // BoomFrontBundle_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boom\\Bundle\\FrontBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'BoomFrontBundle_homepage'));
        }

        // BoomBackBundle_homepage
        if (0 === strpos($pathinfo, '/admin/hello') && preg_match('#^/admin/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Boom\\Bundle\\BackBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'BoomBackBundle_homepage'));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
