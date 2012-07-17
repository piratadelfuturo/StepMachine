<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">

        <title>White Label | Login</title>

        <meta name="description" content="">
        <meta name="author" content="revaxarts.com">


        <!-- Apple iOS and Android stuff -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/img/icon.png') ?>">
        <link rel="apple-touch-startup-image" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/img/startup.png') ?>">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">

        <!-- Google Font and style definitions -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">

        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/style.css') ?>">       
	<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/light/theme.css') ?>" id="themestyle">        

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boombackbundle/css/ie.css') ?>">       
        <![endif]-->

        <!-- Use Google CDN for jQuery and jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
        <?php
        foreach (
                array(
                    '/bundles/boomback/js/functions.js',
                    '/bundles/boomback/js/plugins.js',
                    '/bundles/boomback/js/wl_Alert.js',
                    '/bundles/boomback/js/wl_Dialog.js',
                    '/bundles/boomback/js/wl_Form.js',
                    '/bundles/boomback/js/config.js',
                    '/bundles/boomback/js/login.js'
        ) as $url):
            ?>
            <script type="text/javascript" src="<?php echo $view['assets']->getUrl($url) ?>"></script>
        <?php endforeach; ?>
    </head>
    <body id="login">
        <header>
            <div id="logo">
                <a href="/login/">whitelabel</a>
            </div>
        </header>
        <section id="content">
            <?php $view['slots']->output('_content') ?>
        </section>
        <footer>Copyright by revaxarts.com 2011</footer>

    </body>
</html>