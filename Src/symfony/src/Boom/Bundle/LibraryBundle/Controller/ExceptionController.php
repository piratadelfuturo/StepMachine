<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boom\Bundle\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController as TwigExceptionController;

/**
 * ExceptionController.
 *
 */
class ExceptionController extends TwigExceptionController {

    /**
     * Converts an Exception to a Response.
     *
     * @param FlattenException     $exception A FlattenException instance
     * @param DebugLoggerInterface $logger    A DebugLoggerInterface instance
     * @param string               $format    The format to use for rendering (html, xml, ...)
     *
     * @return Response
     *
     * @throws \InvalidArgumentException When the exception template does not exist
     */
    public function displayAction(FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html') {
        $request = $this->container->get('request');
        $request->setRequestFormat($format);

        $currentContent = $this->getAndCleanOutputBuffering();

        $templating = $this->container->get('templating');
        $code = $exception->getStatusCode();

        $template = $this->findTemplate($templating, $format, $code, $this->container->get('kernel')->isDebug());

        $response = $templating->renderResponse(
                $template
                , array(
            'status_code' => $code,
            'status_text' => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
            'exception' => $exception,
            'logger' => $logger,
            'currentContent' => $currentContent,
                )
        );

        return $response;
    }

    /**
     * @param EngineInterface $templating
     * @param string          $format
     * @param integer         $code       An HTTP response status code
     * @param Boolean         $debug
     *
     * @return TemplateReference
     */
    protected function findTemplate($templating, $format, $code, $debug) {
        $name = $debug ? 'exception' : 'error';
        if ($debug && 'html' == $format) {
            $name = 'exception_full';
        }
        $bundles = array();
        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            //$bundles[] = 'BoomBackBundle';
        } else {
            //$bundles[] = 'BoomFrontBundle';
        }
        $bundles[] = 'BoomFrontBundle';

        $bundles[] = 'TwigBundle';
        $engines = array('php', 'twig');

        foreach ($bundles as $bundle) {
            foreach ($engines as $engine) {
                // when not in debug, try to find a template for the specific HTTP status code and format
                if (!$debug) {
                    $template = new TemplateReference($bundle, 'Exception', $name . $code, $format, $engine);
                    if ($templating->exists($template)) {
                        return $template;
                    }
                }

                // try to find a template for the given format
                $template = new TemplateReference($bundle, 'Exception', $name, $format, $engine);
                if ($templating->exists($template)) {
                    return $template;
                }
            }
        }
        // default to a generic HTML exception
        $this->container->get('request')->setRequestFormat('html');

        return new TemplateReference('TwigBundle', 'Exception', $name, 'html', 'twig');
    }

}