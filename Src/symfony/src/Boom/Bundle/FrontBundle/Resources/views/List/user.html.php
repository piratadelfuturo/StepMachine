<?php
$routeName = $app->getRequest()->get('_route');
$routeParams = $app->getRequest()->get('_route_params');
$createdParams = $routeParams;
$createdParams['listname'] = 'creados';
$createdUrl = $view['router']->generate($routeName, $createdParams);
$modifiedParams = $routeParams;
$modifiedParams['listname'] = 'modificados';
$modifiedUrl = $view['router']->generate($routeName, $modifiedParams);
?>
<div class="boomer profile-booms">
    <div class="title-flag">
        <h3>Booms</h3>
        <ul class="display-menu">
            <li class="disp on"><a href="<?php echo $createdUrl ?>">Creados</a></li>
            <li class="disp"><a href="<?php echo $modifiedUrl ?>">Modificados</a></li>
            <!--
            <li class="arrange"><a href="#" class="disp-list">lista</a></li>
            <li class="arrange off"><a href="#" class="disp-mosaico">mosaico</a></li>
            -->
        </ul>
    </div>
    <?php
    echo $view->render(
            'BoomFrontBundle:Boom:blocks/user_list.html.php', array('list' => $list));
    $pagination = $view['boom_pagination']->paginationValues($total, $routeParams['page']);
    echo $view['boom_pagination']->renderPaginationBlock(
            $app->getRequest()->get('_route'),
            $app->getRequest()->get('_route_params'),
            $total, $page, $limit
    );
    ?>
</div>