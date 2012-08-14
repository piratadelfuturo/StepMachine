<?php

namespace Boom\Bundle\FrontBundle\Security\User\Provider;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \BaseFacebook;
use \FacebookApiException;

class FacebookProvider implements UserProviderInterface {
    /*
     * @var \Facebook
     */

    protected $facebook;
    protected $userManager;
    protected $validator;
    protected $container;

    public function __construct(BaseFacebook $facebook, $userManager, $validator, ContainerInterface $container) {
        $this->facebook = $facebook;
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->container = $container;
    }

    public function supportsClass($class) {
        return $this->userManager->supportsClass($class);
    }

    public function findUserByFbId($fbId) {
        return $this->userManager->findUserBy(array('facebookId' => $fbId));
    }

    public function findUserByUsername($username) {
        return $this->userManager->findUserBy(array('username' => $username));
    }

    public function loadUserByUsername($fbId) {

        $user = $this->findUserByFbId($fbId);

        $loggedUser = null;

        if (is_null($user)) {
            $userToken = $this->container->get('security.context')->getToken();
            if (!is_null($userToken)) {
                $loggedUser = $userToken->getUser();
            }
        }


        try {
            $fbdata = $this->facebook->api('/me');
        } catch (FacebookApiException $e) {
            $fbdata = null;
        }

        if (empty($user) || is_null($user)) {
            if (!empty($fbdata) && !is_null($fbdata)) {

                $user = $this->userManager->createUser();
                $user->setEnabled(true);
                $user->setPassword('');
                $user->setUsername($fbdata['username']);
                if (isset($fbdata['email'])) {
                    $user->setEmail($fbdata['email']);
                }
                $user->addRole('ROLE_FACEBOOK');
                $user->addRole('ROLE_SOCIAL');

                // TODO use http://developers.facebook.com/docs/api/realtime
                $user->setFBData($fbdata);

                if (count($this->validator->validate($user, 'Facebook')) > 0) {
                    // TODO: the user was found obviously, but doesnt match our expectations, do something smart
                    throw new UsernameNotFoundException('The facebook user could not be stored');
                } else {
                    $this->userManager->updateUser($user);
                }
            }
        } elseif (!empty($loggedUser) || !is_null($loggedUser)) {
            if (!empty($fbdata) && !is_null($fbdata)) {
                if (!$user->hasRole('ROLE_FACEBOOK')) {
                    $user->addRole('ROLE_FACEBOOK');
                    $user->addRole('ROLE_SOCIAL');
                    $user->setFBData($fbdata);
                    if (count($this->validator->validate($user, 'Facebook')) > 0) {
                        // TODO: the user was found obviously, but doesnt match our expectations, do something smart
                        throw new UsernameNotFoundException('The facebook user could not be stored');
                    } else {
                        $this->userManager->updateUser($user);
                    }
                }
            }
        }

        if (empty($user) || is_null($user)) {
            throw new UsernameNotFoundException('The user is not authenticated on facebook');
        }

        return $user;
    }

    public function refreshUser(UserInterface $user) {
        if (!$this->supportsClass(get_class($user)) || !$user->getFacebookId()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getFacebookId());
    }

}