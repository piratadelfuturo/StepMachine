<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
?>
<h3 class="title-flag"><?php echo $view->escape(isset($page_title) ? $page_title : '') ?> <?php echo isset($entity) ? $entity['name'] : '' ?></h3>
<?php
echo $view->render('BoomFrontBundle:Boom:blocks/list.html.php', array(
    'list' => $list
));
echo $view['boom_pagination']->renderPaginationBlock(
        $app->getRequest()->get('_route'),
        $app->getRequest()->get('_route_params'),
        $total,
        $page,
        $limit
        );
?>
