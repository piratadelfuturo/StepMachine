<!DOCTYPE HTML>
<html xmlns:fb="http://www.facebook.com/2008/fbml"
      xmlns:og="http://opengraphprotocol.org/schema/">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>7boom</title>
  <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" /> 
  <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/webfonts.css');?>">
  <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/style.css');?>">
  <!--[if gte IE 9]>
    <style type="text/css">.gradient {filter: none;}</style>
  <![endif]-->
</head>
<body class="gradient">
  <?php echo $view['facebook']->initialize(array('xfbml' => true, 'fbAsyncInit' => 'onFbInit();')) ?>
  <header>
    <?php echo $view->render('BoomFrontBundle::blocks/header.html.php');?>
  </header>
    <?php echo $view['actions']->render('BoomFrontBundle:User:userBlock');?>
  <div id="container">
    <?php $view['slots']->output('_content') ?>
  </div>
    <?php echo $view->render('BoomFrontBundle::blocks/footer.html.php');?>
</body>
</html>