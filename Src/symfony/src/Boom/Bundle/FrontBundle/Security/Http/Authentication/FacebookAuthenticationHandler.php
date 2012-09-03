<?php

namespace Boom\Bundle\FrontBundle\Security\Http\Authentication;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Description of FacebookAuthenticationHandler
 *
 * @author daniel
 */
class FacebookAuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {

    protected $securityContext;

    public function __construct(SecurityContextInterface $securityContext, RouterInterface $router){
        $this->securityContext = $securityContext;
        $this->router = $router;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        $referer = $this->refererRedirect($request);
        $request->getSession()->setFlash('error', $exception->getMessage());
        return new RedirectResponse($referer);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {

        $referer = $this->refererRedirect($request);
        return new RedirectResponse($referer);
    }

    public function onLogoutSuccess(Request $request) {
        $referer = $this->refererRedirect($request);
        return new RedirectResponse($referer);
    }

    protected function refererRedirect(Request $request){
        $query_referer = $request->query->get('referer');
        $header_referer = $request->headers->get('referer');

        $query_referer_array = parse_url($query_referer);
        $header_referer_array = parse_url($header_referer);

        if(isset($query_referer_array['host']) && $query_referer_array['host'] == $request->getHttpHost()){
            $redirect = $query_referer;
        }elseif(isset($header_referer_array['host']) && $header_referer_array['host'] == $request->getHttpHost()){
            $redirect = $header_referer;
        }else{
            $redirect = $this->router->generate('BoomFrontBundle_homepage');
        }
        return $redirect;
    }

}