<!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#"
      xmlns:og="http://opengraphprotocol.org/schema/">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>7boom - <?php $view['slots']->output('title', 'likes your luck') ?></title>
  
  <meta name="description" content="<?php $view['slots']->output('description', 'likes your luck') ?>">
  
  <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" /> 
  
  <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/webfonts.css');?>">
  <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/style.css');?>">
  
  <?php ?>
  <?php ?>
  
  <!--[if gte IE 9]>
    <style type="text/css">.gradient {filter: none;}</style>
  <![endif]-->
</head>
<body class="gradient">
  <?php echo $view['facebook']->initialize(
          array(
              'xfbml' => true,
              'fbAsyncInit' => 'onFbInit();',
              'oauth' => true)
          ); ?>
  <header>
    <?php echo $view->render('BoomFrontBundle::blocks/header.html.php');?>
  </header>
    <?php echo $view['actions']->render('BoomFrontBundle:User:userBlock');?>
  <div id="container" class="<?php $view['slots']->output('layout_container_css_class','') ?>">
    <?php $view['slots']->output('_content') ?>
  </div>
    <?php echo $view->render('BoomFrontBundle::blocks/footer.html.php');?>
</body>
</html>