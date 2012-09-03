<?php

namespace Boom\Bundle\FrontBundle\Security\Firewall;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;
use Symfony\Component\HttpFoundation\Request;
use FOS\FacebookBundle\Security\Authentication\Token\FacebookUserToken;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * The listener is responsible for fielding requests to the firewall
 * and calling the authentication provider.
 */
class FacebookListener extends AbstractAuthenticationListener
{

    protected $facebook;

    protected $userManager;

    protected $authSecurityContext;

    public function setFacebook(\BaseFacebook $facebook){
        $this->facebook = $facebook;
    }

    public function setUserManager(\FOS\UserBundle\Model\UserManagerInterface $userManager){
        $this->userManager = $userManager;
    }

    public function setAuthSecurityContext(SecurityContextInterface $authSecurityContext){
        $this->authSecurityContext = $authSecurityContext;
    }

    protected function attemptAuthentication(Request $request)
    {
        return $this->authenticationManager->authenticate(new FacebookUserToken($this->providerKey));
    }

    /*
    protected function requiresAuthentication(Request $request){

        if($this->httpUtils->checkRequestPath($request, $this->options['check_path'])){
            return true;
        }

        if ((bool) $this->facebook->getUser() && !$this->authSecurityContext->isGranted('ROLE_FACEBOOK')) {
            return true;
        }
        return false;
    }*/

    /*
    public function handle(GetResponseEvent $event) {

        $request = $event->getRequest();

        if (null !== $this->securityContext->getToken()) {
            return;
        }

        $cookie = $this->getFacebookCookie();
        if ($cookie) {
            $token = new FacebookUserToken();
            $token->setAccessToken($cookie['access_token']);


            $content = @file_get_contents(
                            'https://graph.facebook.com/me?access_token=' .
                            $token->getAccessToken());
            if ($content) {
                $userData = json_decode($content);
                $user = new FacebookUser($userData);
                $token->setUser($user);
                $this->securityContext->setToken($token);
            }
        }
    }*/

    /**
     * Handles form based authentication.
     *
     * @param GetResponseEvent $event A GetResponseEvent instance
     */
    /*
    final public function handled(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$this->requiresAuthentication($request)) {
            return;
        }

        if (!$request->hasSession()) {
            throw new \RuntimeException('This authentication method requires a session.');
        }

        try {
            if (!$request->hasPreviousSession()) {
                throw new SessionUnavailableException('Your session has timed out, or you have disabled cookies.');
            }

            if (null === $returnValue = $this->attemptAuthentication($request)) {
                return;
            }

            if ($returnValue instanceof TokenInterface) {
                $this->sessionStrategy->onAuthentication($request, $returnValue);

                $response = $this->onSuccess($event, $request, $returnValue);
            } elseif ($returnValue instanceof Response) {
                $response = $returnValue;
            } else {
                throw new \RuntimeException('attemptAuthentication() must either return a Response, an implementation of TokenInterface, or null.');
            }
        } catch (AuthenticationException $e) {
            $response = $this->onFailure($event, $request, $e);
        }

        $event->setResponse($response);
    }*/
}