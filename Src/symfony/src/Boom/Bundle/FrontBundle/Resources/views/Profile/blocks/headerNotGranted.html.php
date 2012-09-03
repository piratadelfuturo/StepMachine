<?php
    $thisUrl = $view['router']->generate(
            $view['request']->getParameter('_route'),
            $view['request']->getParameter('_route_params') ,
            true
            );
    $loginCheck = $view['router']->generate('BoomFrontBundle_login_check_fb',array('referer'=>$thisUrl),true);
    $fbLoginUrl = $view['router']->generate('BoomFrontBundle_login_fb',array('referer' => $thisUrl));
?>
<div id="usr-cnt">
    <div id="usr-box">
        <div id="usr-bar">
            <ul>
                <li>
                    <a id="fb-login-check" href="<?php echo $fbLoginUrl ?>" registration-url="<?php echo $loginCheck ?>" scope="<?php echo $view['facebook']->getScope() ?>" target="_blank" >Login</a>
                </li>
            </ul>
        </div>
    </div>
</div>