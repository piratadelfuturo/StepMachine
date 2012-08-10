<?php
$nav = array();
$nav[] = array(
    '_route' => 'BoomBackBundle_homepage',
    'class' => 'i_house',
    'text' => 'Inicio',
);
$nav[] = array(
    '_route' => '',
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
$nav[] = array(
    '_route' => '',
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
    '_route' => 'BoomBackBundle_user_index',
    'class' => 'i_v-card',
    'text' => 'Usuarios');

?>
<nav>
    <ul id="nav">
        <?php foreach ($nav as $n): ?>
            <li class="<?php echo $n['class'] ?>">
                <a <?php echo !empty($n['_route']) ? 'href="'.$view['router']->generate($n['_route']).'"' : '' ?> class="<?php echo $view['request']->getParameter('_route') == $n['_route'] ? 'active' : '' ?>">
                    <span><?php echo $n['text'] ?></span>
                </a>
                <?php if (isset($n['children']) && !empty($n['children'])): ?>
                    <ul>
                        <?php foreach ($n['children'] as $c): ?>
                            <li class="<?php echo $c['class'] ?>">
                                <a href="<?php echo!empty($c['_route']) ? $view['router']->generate($c['_route']) : '' ?>" class="<?php echo $view['request']->getParameter('_route') == $c['_route'] ? 'active' : '' ?>">
                                    <span><?php echo $c['text'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <li class="i_image"><a><span>Home</span></a></li>
        <li class="i_image"><a href="#"><span>Imagenes</span></a></li>
        <li class="i_images"><a href="#"><span>Galerías</span></a></li>
        <li class="i_tags"><a href="#"><span>Tags</span></a></li>
        <li class="i_calendar_day"><a href="#"><span>Calendar</span></a></li>
    </ul>
</nav>