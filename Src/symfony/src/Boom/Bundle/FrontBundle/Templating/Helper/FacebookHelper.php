<?php

/*
 * This file is part of the FOSFacebookBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boom\Bundle\FrontBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \BaseFacebook;


class FacebookHelper extends Helper
{
    protected $templating;
    protected $logging;
    protected $culture;
    protected $scope;
    protected $facebook;
    protected $container;

    public function __construct(EngineInterface $templating, BaseFacebook $facebook, $logging = true, $culture = 'en_US', array $scope = array(), ContainerInterface $container = null)
    {
        $this->templating  = $templating;
        $this->logging     = $logging;
        $this->culture     = $culture;
        $this->scope       = $scope;
        $this->facebook    = $facebook;
        $this->container   = $container;

    }

    /**
     * Returns the HTML necessary for initializing the JavaScript SDK.
     *
     * The default template includes the following parameters:
     *
     *  * async
     *  * fbAsyncInit
     *  * appId
     *  * xfbml
     *  * oauth
     *  * status
     *  * cookie
     *  * logging
     *  * culture
     *
     * @param array  $parameters An array of parameters for the initialization template
     * @param string $name       A template name
     *
     * @return string An HTML string
     */
    public function initialize($parameters = array(), $name = null)
    {
        $name = $name ?: '@FOSFacebookBundle::initialize.html.php';
        return $this->templating->render($name, $parameters + array(
            'async'       => true,
            'fbAsyncInit' => '',
            'appId'       => (string) $this->facebook->getAppId(),
            'xfbml'       => false,
            'oauth'       => true,
            'status'      => false,
            'cookie'      => true,
            'logging'     => $this->logging,
            'culture'     => $this->culture,
        ));
    }

    public function loginButton($parameters = array(), $name = null)
    {
        $name = $name ?: '@FOSFacebookBundle::loginButton.html.php';
        return $this->templating->render($name, $parameters + array(
            'autologoutlink' => 'false',
            'label'          => '',
            'scope'          => implode(',', $this->scope),
            'size'           => 'small'
        ));
    }

    public function logoutUrl($parameters = array(), $name = null)
    {
        return $this->facebook->getLogoutUrl($parameters);
    }

    public function getLoginUrl($params = array()){
        return $this->facebook->getLoginUrl($params);
    }

    public function getScope(){
        return implode(',',$this->scope);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return 'facebook';
    }
}
