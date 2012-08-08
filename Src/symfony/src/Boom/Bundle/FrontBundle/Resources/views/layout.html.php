<!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#"
      xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>7boom - <?php $view['slots']->output('title', '') ?></title>

        <meta name="description" content="<?php $view['slots']->output('description', '') ?>">

        <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" />

        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/boomfront-theme/jquery-ui-1.8.22.custom.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/webfonts.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/style.css'); ?>">

        <!--[if gte IE 9]>
          <style type="text/css">.gradient {filter: none;}</style>
        <![endif]-->

        <!-- Use Google CDN for jQuery and jQuery UI -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.cookie.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.blockUI.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/plugins.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/script.js') ?>"></script>


    </head>
    <body class="gradient">
        <?php
        echo $view['facebook']->initialize(
                array(
                    'xfbml' => true,
                    'fbAsyncInit' => 'onFbInit();',
                    'oauth' => true)
        );
        ?>
        <header>
        <?php echo $view->render('BoomFrontBundle::blocks/header.html.php'); ?>
        </header>
        <?php echo $view['actions']->render('BoomFrontBundle:User:userBlock'); ?>
        <div id="container" class="<?php $view['slots']->output('layout_container_css_class', '') ?>">
        <?php $view['slots']->output('_content') ?>
        </div>
<?php echo $view->render('BoomFrontBundle::blocks/footer.html.php'); ?>
    </body>
</html>