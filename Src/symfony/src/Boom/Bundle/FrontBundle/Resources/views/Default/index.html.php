<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$view['slots']->start('top_two_col');
if(empty($top['listelements']) || $top['listelements'] === null){
echo $view->render('BoomFrontBundle:Default:blocks/big_top.html.php', array(
            'title' => $top['name'],
            'list'  => $top['listelements']
                ));
}
$view['slots']->stop();
?>
<?php
    $blocks = array();
    $blocks['weekly'] = array(
                  'title'   => $weekly['name'],
                  'list'    => $weekly['listelements'],
                  'template'=> 'BoomFrontBundle:Boom:blocks/long_numbered_list.html.php'
    );
    $blocks['user_booms'] = array(
                  'title' => 'booms de usuarios',
                  'list'  => array(),
                  'more_url' => $view['router']->generate('BoomFrontBundle_list_users'),
                  'template'=> 'BoomFrontBundle:Boom:blocks/block_list.html.php'
    );
    $blocks['latest'] = array(
                  'title'   => 'últimos',
                  'list'    => $latest,
                  'more_url'=> $view['router']->generate('BoomFrontBundle_list_latest'),
                  'template'=> 'BoomFrontBundle:Boom:blocks/block_list.html.php'
    );
    $blocks['featured'] = array(
                  'title'   => 'recomendados',
                  'list'    =>  $featured,
                  'more_url'=>  $view['router']->generate('BoomFrontBundle_list_recommended'),
                  'template'=> 'BoomFrontBundle:Boom:blocks/block_list.html.php'
    );

    foreach($blocks as $block):?>
      <?php echo $view->render($block['template'],
              $block
              );?>
<?php endforeach; ?>