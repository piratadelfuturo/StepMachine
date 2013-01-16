<!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#" xmlns:og="http://opengraphprotocol.org/schema/">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# seven_boom_mx: http://ogp.me/ns/fb/seven_boom_mx#">
    <?php $fb_boom_graph_data = $view['slots']->get('fb_boom_graph_data', null); ?>
    <?php if ($fb_boom_graph_data !== null): ?>
      <meta property="fb:app_id" content="349118228506488" />
      <meta property="og:site_name" content="7boom" />
      <meta property="og:type"   content="<?php echo $view->escape($fb_boom_graph_data['type']) ?>" />
      <meta property="og:url"    content="<?php echo $view->escape($fb_boom_graph_data['url']) ?>" />
      <meta property="og:title"  content="<?php echo $view->escape($fb_boom_graph_data['title']) ?>" />
      <meta property="og:image"  content="http://www.7boom.mx<?php echo $view->escape($fb_boom_graph_data['image']) ?>" />
      <meta property="og:description" content="<?php echo $view->escape($view['slots']->get('description', 'Ordenamos junto contigo al mundo en listas de 7. Todas las opiniones, todos los temas todas las jerarquías.')) ?>" />
    <?php endif; ?>
    <?php $title = $view->escape($view['slots']->get('title', null));?>
    <title>
      <?php echo $title !== null ? $title . ' - ' : ''; ?>7boom
    </title>
    <meta name="description" content="<?php echo $view->escape($view['slots']->get('description', 'Ordenamos junto contigo al mundo en listas de 7. Todas las opiniones, todos los temas todas las jerarquías.')) ?>">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/boomfront-theme/jquery-ui-1.8.22.custom.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/webfonts.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/style.css?v=3'); ?>">
    <!--[if gte IE 9]>
      <style type="text/css">.gradient {filter: none;}</style>
    <![endif]-->
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/modernizr-1.7.min.js') ?>"></script>
  </head>
  <body class="gradient">
    <div class="wrapper">
      <header class="cf">
        <?php echo $view->render('BoomFrontBundle::blocks/header.html.php'); ?>
      </header>
        <?php
        ini_set('display_errors',1);
   error_reporting(E_ALL);
          if ($view['security']->isGranted('ROLE_USER') == false) {
              echo $view->render('BoomFrontBundle:Profile:blocks/headerNotGranted.html.php');
          } elseif($view['security']->isGranted('ROLE_SUPER_ADMIN') == false) {
              //echo $view['actions']->render('BoomFrontBundle:Profile:userBlock', array(), array('standalone' => false));
              echo $view->render('BoomFrontBundle:Profile:blocks/header.html.php');
          }
        ?>
      <div id="container" class="cf <?php $view['slots']->output('layout_container_css_class', '') ?>">
        <?php $view['slots']->output('_content') ?>
      </div>
    </div>
    <?php echo $view->render('BoomFrontBundle::blocks/footer.html.php'); ?>
    <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-36293587-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
    </script>
    
    <script type="text/javascript">
      function likeBoom()
      {
        FB.api(
          '/me/og.likes',
          'post',
          {
          boom: "<?php echo $view->escape($fb_boom_graph_data['url']) ?>"
          },
          function(response) {
          // handle the response
          }
        );
      };
    </script>
      
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery-1.8.2.min.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery-ui-1.8.23.custom.min.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/file_upload/js/jquery.iframe-transport.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/file_upload/js/jquery.fileupload.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.cookie.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.boomAjaxUpload.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/jquery.blockUI.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/libs/tiny_mce/tiny_mce_src.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/jquery.dragsort-0.5.1.min.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/plugins.js') ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/bundles/boomfront/js/script.js') ?>"></script>
        <?php
        echo $view['facebook']->initialize(
                array(
            'xfbml' => true,
            'fbAsyncInit' => 'window.onFbInit()',
            'oauth' => true), 'BoomFrontBundle::blocks/facebook/initialize.html.php'
        );
        ?>
  </body>
</html>
