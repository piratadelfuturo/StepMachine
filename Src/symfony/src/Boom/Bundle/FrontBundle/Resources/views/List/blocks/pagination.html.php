<?php
/**
 * @var $page
 * @var $routeParams
 * @var $routeName
 * @var $pagination
 */
if(count($pagination['segment_pages']) > 0):
?>
<div class="pags">
    <ul class="paginador">
        <?php
        if ($page !== 0 && !($page > 0)) {
            $prevParams = $route_params;
            $prevParams['page'] = $page - 1;
            $prevRoute = $view['router']->generate($route_name, $prevParams);
        } else {
            $prevRoute = null;
        }
        ?>
        <li><a <?php echo $prevRoute === null ? '' : 'href="' . $prevRoute . '"' ?>><span class="pagina-prev">prev</span></a></li>
        <?php
        foreach ($pagination['segment_pages'] as $pageNum):
            $pageParam = $route_params;
            $pageParam['page'] = $pageNum;
            $pageUrl = $view['router']->generate(
                    $route_name, $pageParam
            );
            $even = '';
            $on = '';
            if ($page == $pageNum) {
                $on = 'on';
            }
            if ($pageNum % 2 == 0) {
                $even = 'even';
            }
            ?>
            <li><a href="<?php echo $pageUrl ?>"><span class="pagina <?php echo $even . ' ' . $on ?>"><?php echo $pageNum ?></span></a></li>
        <?php endforeach; ?>
        <?php
        if ($page < $pagination['total_pages']) {
            $nextParams = $route_params;
            $nextParams['page'] = $page + 1;
            $nextRoute = $view['router']->generate($route_name, $nextParams);
        } else {
            $nextRoute = null;
        }
        ?>
        <li><a <?php echo $nextRoute === null ? '' : 'href="' . $nextRoute . '"'; ?>>
                <span class="pagina-next">next</span></a>
        </li>
    </ul>
</div>
<?php
endif;
?>