<?php
    $routeName = $app->getRequest()->get('_route');
    $routeParams = $app->getRequest()->get('_route_params');
    $createdParams = $routeParams;
    $createdParams['listname'] = 'creados';
    $createdUrl = $view['router']->generate($routeName,$createdParams);
    $modifiedParams = $routeParams;
    $modifiedParams['listname'] = 'modificados';
    $modifiedUrl = $view['router']->generate($routeName,$modifiedParams);
?>
<div class="boomer profile-booms">
    <div class="title-flag">
        <h3>Booms</h3>
        <ul class="display-menu">
            <li class="disp on"><a href="<?php echo $createdUrl?>">Creados</a></li>
            <li class="disp"><a href="<?php echo $modifiedUrl?>">Modificados</a></li>
            <!--
            <li class="arrange"><a href="#" class="disp-list">lista</a></li>
            <li class="arrange off"><a href="#" class="disp-mosaico">mosaico</a></li>
            -->
        </ul>
    </div>
    <?php
    echo $view->render(
            'BoomFrontBundle:Boom:blocks/user_list.html.php',array('list' => $list))
    ?>
    <?php
    $pagination = $view['boom_pagination']->paginationValues($total ,$routeParams['page']);
    ?>
    <?php if(!empty($pagination['segment_pages'])): ?>
    <div class="pags">
        <ul class="paginador">
            <?php ?>
            <li><a href="#"><span class="pagina-prev">prev</span></a></li>
            <?php ?>
            <?php foreach($pagination['segment_pages'] as $pageNum):
                $pageParam = $routeParams;
                $pageParam['page'] = $pageNum;
                $pageUrl = $view['router']->generate(
                        $routeName,
                        $pageParam
                        );
                ?>
            <li><a href="<?php echo $pageUrl ?>"><span class="pagina"><?php echo $pageNum ?></span></a></li>
            <?php endforeach;?>
            <?php ?>
            <li><a href="#"><span class="pagina-next">next</span></a></li>
            <?php ?>
        </ul>
    </div>
    <?php endif; ?>
</div>