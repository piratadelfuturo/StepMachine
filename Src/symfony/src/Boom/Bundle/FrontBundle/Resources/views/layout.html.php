<!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#"
      xmlns:og="http://opengraphprotocol.org/schema/">
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# seven_boom_mx: http://ogp.me/ns/fb/seven_boom_mx#">
        <?php
        $title = $view['slots']->get('title', null);
        ?>
        <title>7boom <?php echo $title !== null ? '- ' . $title : ''; ?></title>

        <meta name="description" content="<?php echo $view['slots']->get('description', '') ?>">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <?php $fb_boom_graph_data = $view['slots']->get('fb_boom_graph_data', null); ?>
        <?php if ($fb_boom_graph_data !== null): ?>
            <meta property="fb:app_id" content="349118228506488" />
            <meta property="og:type"   content="seven_boom_mx:boom" />
            <meta property="og:url"    content="<?php echo $view->escape($fb_boom_graph_data['url']) ?>" />
            <meta property="og:title"  content="<?php echo $view->escape($fb_boom_graph_data['title']) ?>" />
            <meta property="og:image"  content="<?php echo $view->escape($fb_boom_graph_data['image']) ?>" />
        <?php endif; ?>

        <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" />

        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/boomfront-theme/jquery-ui-1.8.22.custom.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/webfonts.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/style.css?v=2'); ?>">

        <!--[if gte IE 9]>
          <style type="text/css">.gradient {filter: none;}</style>
        <![endif]-->

        <!-- Use Google CDN for jQuery and jQuery UI -->
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery-1.7.2.min.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery-ui-1.8.22.custom.min.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.cookie.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.blockUI.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/plugins.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/script.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/modernizr-1.7.min.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/jquery.dragsort-0.5.1.min.js') ?>"></script>


    </head>
    <body class="gradient">
        <?php
        echo $view['facebook']->initialize(
                array(
            'xfbml' => true,
            'fbAsyncInit' => 'window.onFbInit()',
            'oauth' => true), 'BoomFrontBundle::blocks/facebook/initialize.html.php'
        );
        ?>
        <header>
            <?php echo $view->render('BoomFrontBundle::blocks/header.html.php'); ?>
        </header>
        <?php
        if ($view['security']->isGranted('ROLE_USER') == false) {
            echo $view->render('BoomFrontBundle:Profile:blocks/headerNotGranted.html.php');
        } else {
            echo $view['actions']->render('BoomFrontBundle:Profile:userBlock', array(), array('standalone' => false));
        }
        ?>
        <div id="container" class="<?php $view['slots']->output('layout_container_css_class', '') ?>">
            <?php $view['slots']->output('_content') ?>
        </div>
        <?php echo $view->render('BoomFrontBundle::blocks/footer.html.php'); ?>
    </body>
</html>
