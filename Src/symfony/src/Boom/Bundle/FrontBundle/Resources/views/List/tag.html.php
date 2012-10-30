<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<h3 class="title-flag">Tag: <?php echo $view->escape($entity['name']) ?></h3>
<?php
echo $view->render('BoomFrontBundle:Boom:blocks/list.html.php', array(
    'list' => $list
));
echo $view['boom_pagination']->renderPaginationBlock($app->getRequest()->get('_route'), $app->getRequest()->get('_route_params'), $total, $page);
?>
