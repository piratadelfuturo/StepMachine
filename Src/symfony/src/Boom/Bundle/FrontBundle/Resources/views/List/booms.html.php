<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<h3><?php echo $view->escape($entity['name']) ?></h3>
<?php echo $view->render('BoomFrontBundle:Boom:blocks/list.html.php', array(
            'list'  => $list
                ));
?>
