<?php

namespace Boom\Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ResettingController as BaseController;

class ResettingController extends BaseController {

    /**
     * Request reset user password: show form
     */
    public function requestAction() {
        return $this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:request.html.php');
    }

    /**
     * Request reset user password: submit form and send email
     */
    public function sendEmailAction(Request $request) {
        $token = $this->container->get('security.context')->getToken();

        if ($this->container->get('security.context')->isGranted('ROLE_USER') == true) {
            $username = $token->getUser()->getUsername();
        } else {
            $username = $this->container->get('request')->request->get('username');
        }

        /** @var $user UserInterface */
        $user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($username);

        if (null === $user) {
            return $this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:request.html.php', array('invalid_username' => $username));
        }

        if ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            return $this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:passwordAlreadyRequested.html.php');
        }

        if (null === $user->getConfirmationToken()) {
            /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }

        $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $this->container->get('fos_user.mailer')->sendResettingEmailMessage($user);
        $user->setPasswordRequestedAt(new \DateTime());
        $this->container->get('fos_user.user_manager')->updateUser($user);

        return new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_check_email'));
        //return new RedirectResponse($this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:checkEmail.html.php'));
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction() {
        $session = $this->container->get('session');
        $email = $session->get(static::SESSION_EMAIL);
        $session->remove(static::SESSION_EMAIL);

        if (empty($email) || $email === null) {
            // the user does not come from the sendEmail action
            return new RedirectResponse($this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:reset.html.php'));
            //return new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_request'));
        }

        return $this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:checkEmail.html.php', array(
                    'email' => $email,
                ));
    }

    /**
     * Reset user password
     */
    public function resetAction(Request $request, $token) {
        $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        if (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            //return new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_request'));
            return new RedirectResponse($this->container->get('templating')->renderResponse('Boom:BoomUserBundle:Resetting:request.html.php'));
        }

        $form = $this->container->get('fos_user.resetting.form.factory');
        $formHandler = $this->container->get('fos_user.resetting.form.handler');
        $process = $formHandler->process($user);

        if ($process) {
            $this->setFlash('fos_user_success', 'resetting.flash.success');
            //$response = new RedirectResponse($this->getRedirectionUrl($user));
            $response = $this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:success.html.php');
            $this->authenticateUser($user, $response);

            return $response;
        }

        return $this->container->get('templating')->renderResponse('BoomUserBundle:Resetting:reset_content.html.php', array(
                    'token' => $token,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Authenticate a user with Symfony Security
     *
     * @param \FOS\UserBundle\Model\UserInterface        $user
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response) {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                    $this->container->getParameter('fos_user.firewall_name'), $user, $response);
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }

    /**
     * Generate the redirection url when the resetting is completed.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getRedirectionUrl(UserInterface $user) {
        return $this->container->get('router')->generate('fos_user_profile_show');
    }

    /**
     * Get the truncated email displayed when requesting the resetting.
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail(UserInterface $user) {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }

    protected function setFlash($action, $value) {
        $this->container->get('session')->setFlash($action, $value);
    }

    protected function getEngine() {
        return $this->container->getParameter('fos_user.template.engine');
    }

}
