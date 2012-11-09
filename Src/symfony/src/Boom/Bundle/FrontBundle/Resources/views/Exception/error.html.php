<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php'); ?>
<?php
if (!isset($list)) {
    $list = array();
}
$blocks = array();
$blocks['featured'] = array(
    'title' => 'recomendados',
    'list' => $view['boom_front']->getFeaturedBooms(),
    'more_url' => $view['router']->generate('BoomFrontBundle_list_recommended'),
    'template' => 'BoomFrontBundle:Boom:blocks/block_list.html.php'
);
foreach ($blocks as $block):
    ?>


    <div class="boomer">
        <h3 class="title-flag"><span>Error</span></h3>
        <ul class="list cf">
            <li class="error">No encontramos la página que estás buscando</li>
            <li class="error">pero aquí están estas que podrían interesarte:</li>
        </ul>
    </div>

    <?php
    echo $view->render($block['template'], $block
    );
    ?>
<?php endforeach; ?>
