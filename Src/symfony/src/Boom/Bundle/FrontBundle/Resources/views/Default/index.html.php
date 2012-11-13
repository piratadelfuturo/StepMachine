<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->start('top_two_col');
if ($top['listelements'] !== null) {
    echo $view->render('BoomFrontBundle:Default:blocks/big_top.html.php', array(
        'title' => $top['name'],
        'list' => $top['listelements']
    ));
}
$view['slots']->stop();
$blocks = array();
$blocks['weekly'] = array(
    'title' => $weekly['name'],
    'list' => !empty($weekly['listelements']) ? $weekly['listelements'] : array(),
    'template' => 'BoomFrontBundle:Boom:blocks/long_numbered_list.html.php'
);
$blocks['featured'] = array(
    'title' => 'recomendados',
    'list' => $featured,
    'more_url' => $view['router']->generate('BoomFrontBundle_list_recommended'),
    'template' => 'BoomFrontBundle:Boom:blocks/block_list.html.php'
);
$blocks['latest'] = array(
    'title' => 'últimos',
    'list' => $latest,
    'more_url' => $view['router']->generate('BoomFrontBundle_list_latest'),
    'template' => 'BoomFrontBundle:Boom:blocks/block_list.html.php'
);
$blocks['user_booms'] = array(
    'title' => 'booms de usuarios',
    'list' => $users,
    'more_url' => $view['router']->generate('BoomFrontBundle_list_users'),
    'template' => 'BoomFrontBundle:Boom:blocks/block_list.html.php'
);

foreach ($blocks as $block) {
    echo $view->render($block['template'], $block
    );
}