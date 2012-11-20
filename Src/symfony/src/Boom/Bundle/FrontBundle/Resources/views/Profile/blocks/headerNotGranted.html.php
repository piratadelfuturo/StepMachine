<?php
    $loginParams = array();
    $_route = $view['request']->getParameter('_route');
    if($_route !== null){
        $loginParams['referer'] = $view['router']->generate(
            $view['request']->getParameter('_route'),
            $view['request']->getParameter('_route_params') ,
            true
            );

    }
    $loginCheck = $view['router']->generate('BoomFrontBundle_login_check_fb',$loginParams,true);
    $fbLoginUrl = $view['router']->generate('BoomFrontBundle_login_fb',$loginParams);
?>
<div id="usr-cnt">
    <div id="usr-box">
        <div id="usr-bar">
            <ul>
                <li>
                    <a id="fb-login-check" href="<?php echo $fbLoginUrl ?>" registration-url="<?php echo $loginCheck ?>" scope="<?php echo $view['facebook']->getScope() ?>" target="_blank" >HAZ LOGIN CON <span class="fblogo">FACEBOOK</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>