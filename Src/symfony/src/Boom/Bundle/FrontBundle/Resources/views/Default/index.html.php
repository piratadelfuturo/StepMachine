<?php $view->extend('BoomFrontBundle::layout.html.php') ?>
Hello <?php echo $view->escape($name) ?>!
<?php
var_dump($view['assets']->javascripts());
?>