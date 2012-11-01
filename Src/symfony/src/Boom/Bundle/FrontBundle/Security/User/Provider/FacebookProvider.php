<?php

namespace Boom\Bundle\FrontBundle\Security\User\Provider;

use Boom\Bundle\LibraryBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \BaseFacebook;
use \FacebookApiException;
use Gedmo\Sluggable\Util\Urlizer;

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
        $user = $this->processUser($fbId);
        if (empty($user) || $user === null) {
            throw new UsernameNotFoundException('The user is not authenticated on facebook');
        }

        return $user;
    }

    public function processUser($fbId) {

        $loggedUser = null;
        $user = null;

        $userToken = $this->container->get('security.context')->getToken();
        if ($userToken !== null) {
            $loggedUser = $userToken->getUser();
        } else {
            $user = $this->findUserByFbId($fbId);
        }

        try {
            $fbdata = $this->facebook->api('/me');
        } catch (FacebookApiException $e) {
            $fbdata = null;
        }


        if ($user === null || empty($user)) {
            if (!empty($fbdata) && $fbdata !== null) {

                $user = $this->userManager->createUser();

                $user->setEnabled(true);
                $user->setPassword('');
                if (isset($fbdata['username'])) {
                    $username = $fbdata['username'];
                } else {
                    $username = Urlizer::urlize($fbdata['name'], '_');
                }
                $user->setName($fbdata['name']);
                $user->setUsername($username);

                if (isset($fbdata['email'])) {
                    $user->setEmail($fbdata['email']);
                }
                $user->setFBData($fbdata);
                $user->setImageOption(User::IMAGE_FACEBOOK);
                $user->addRole('ROLE_FACEBOOK');
                $user->addRole('ROLE_SOCIAL');
                $this->userManager->updateUser($user);
            }
        } elseif (!empty($loggedUser) || $loggedUser !== null) {
            if (!empty($fbdata) && $fbdata !== null) {
                if (!$user->hasRole('ROLE_FACEBOOK')) {
                    $user->addRole('ROLE_FACEBOOK');
                    $user->addRole('ROLE_SOCIAL');
                    if (isset($fbdata['id'])) {
                        $user->setFacebookId($fbdata['id']);
                    }
                    if (count($this->validator->validate($user, 'Facebook')) > 0) {
                        throw new UsernameNotFoundException('The facebook user could not be stored');
                    } else {
                        $this->userManager->updateUser($user);
                    }
                }
            }
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