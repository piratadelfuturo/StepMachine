<?php
$nav = array();
$nav[] = array(
    '_route' => 'BoomBackBundle_dashboard',
    'class' => 'i_house',
    'text' => 'Dashboard',
);
$nav[] = array(
    'class' => 'i_desk',
    'text' => 'Home',
    'children' => array(
        array(
            '_route' => array(
                'BoomBackBundle_list_edit',
                array(
                    'block' => 'home_page',
                    'name' => 'top'
                )
            ),
            'class' => 'i_create_write',
            'text' => 'Top'
        ),
        array(
            '_route' => array(
                'BoomBackBundle_list_edit',
                array(
                    'block' => 'home_page',
                    'name' => 'semanal'
                )
            ),
            'class' => 'i_create_write',
            'text' => 'Semanal'
        )
    )
);
if ($view['security']->isGranted('ROLE_SUPER_ADMIN') == false) {
    $nav[] = array(
        'class' => 'i_create_write',
        'text' => 'Booms',
        'children' => array(
            array(
                '_route' => 'BoomBackBundle_boom_index',
                'class' => 'i_create_write',
                'text' => 'Lista'
            ),
            array(
                '_route' => 'BoomBackBundle_boom_new',
                'class' => 'i_create_write',
                'text' => 'Nuevo'
            )
        )
    );
/*
    $nav[] = array(
        'class' => 'i_image',
        'text' => 'Imágenes',
        'children' => array(
            array(
                '_route' => 'BoomBackBundle_image_index',
                'text' => 'Lista',
                'class' => 'i_v-card'
            ),
            array(
                '_route' => 'BoomBackBundle_image_new',
                'text' => 'Nueva',
                'class' => 'i_v-card'
            )
        )
    );

    $nav[] = array(
        'class' => 'i_images',
        'text' => 'Galerías',
        'children' => array(
            array(
                '_route' => 'BoomBackBundle_gallery_index',
                'text' => 'Lista',
                'class' => 'i_v-card'
            ),
            array(
                '_route' => 'BoomBackBundle_gallery_new',
                'text' => 'Nueva',
                'class' => 'i_v-card'
            )
        )
    );
 */
}
$nav[] = array(
    'class' => 'i_folder',
    'text' => 'Categorías',
    'children' => array(
        array(
            '_route' => 'BoomBackBundle_category_index',
            'class' => 'i_create_write',
            'text' => 'Lista'
        ),
        array(
            '_route' => 'BoomBackBundle_category_new',
            'class' => 'i_create_write',
            'text' => 'Nuevo'
        )
    )
);
$nav[] = array(
    'class' => 'i_v-card',
    'text' => 'Usuarios',
    '_route' => 'BoomBackBundle_user_index'
);

$nav[] = array(
    '_route' => 'BoomBackBundle_tag_index',
    'class' => 'i_tags',
    'text' => 'Tags'
);

$nav[] = array(
    'class' => 'i_blocks_images',
    'text' => 'Widgets',
    'children' => array(
        array(
            '_route' => 'BoomBackBundle_widget_index',
            'text' => 'Lista',
            'class' => 'i_blocks_images'
        ),
        array(
            '_route' => 'BoomBackBundle_widget_new',
            'text' => 'Nuevo',
            'class' => 'i_blocks_images'
        )
    )
);
?>
<nav>
    <ul id="nav">
        <?php foreach ($nav as $n): ?>
            <li class="<?php echo $n['class'] ?>">
                <a <?php echo isset($n['_route']) ? 'href="' . $view['router']->generate($n['_route']) . '"' : '' ?> class="<?php echo isset($n['_route']) && $view['request']->getParameter('_route') == $n['_route'] ? 'active' : '' ?>">
                    <span><?php echo $n['text'] ?></span>
                </a>
                <?php if (isset($n['children']) && !empty($n['children'])): ?>
                    <ul>
                        <?php foreach ($n['children'] as $c): ?>
                            <li class="<?php echo $c['class'] ?>">
                                <?php
                                $route = '';
                                if (isset($c['_route'])) {
                                    $route = call_user_func_array(array($view['router'], 'generate'), is_array($c['_route']) ? $c['_route'] : array($c['_route']));
                                }
                                ?>
                                <a href="<?php echo $route ?>" class="<?php echo isset($c['_route']) && $view['request']->getParameter('_route') == $c['_route'] ? 'active' : '' ?>">
                                    <span><?php echo $c['text'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
<!-- <li class="i_calendar_day"><a href="#"><span>Calendar</span></a></li> -->
    </ul>
</nav>