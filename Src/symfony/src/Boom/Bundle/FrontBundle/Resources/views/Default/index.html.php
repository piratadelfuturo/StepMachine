<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$view['slots']->start('top_two_col');
echo $view->render('BoomFrontBundle:Default:blocks/big_top.html.php', array(
            'title' => 'top semanal'
                ));
$view['slots']->stop();
?>
<?php
    $blocks = array();
    $blocks['top_semanal'] = array(
                  'title'   => 'top semanal',
                  'list'    => array(),
                  'template'=> 'BoomFrontBundle:Boom:blocks/long_numbered_list.html.php'
    );
    $blocks['booms_usuarios'] = array(
                  'title' => 'booms de usuarios',
                  'list'  => array(),
                  'more_url' => $view['router']->generate('BoomFrontBundle_list_users'),
                  'template'=> 'BoomFrontBundle:Boom:blocks/block_list.html.php'
    );
    $blocks['ultimos'] = array(
                  'title'   => 'últimos',
                  'list'    => $latest,
                  'more_url'=> $view['router']->generate('BoomFrontBundle_list_latest'),
                  'template'=> 'BoomFrontBundle:Boom:blocks/block_list.html.php'
    );
    $blocks['recomendados'] = array(
                  'title'   => 'recomendados',
                  'list'    =>  array(),
                  'more_url'=>  $view['router']->generate('BoomFrontBundle_list_recommended'),
                  'template'=> 'BoomFrontBundle:Boom:blocks/block_list.html.php'
    );

    foreach($blocks as $block):?>
      <?php echo $view->render($block['template'],
              $block
              );?>
<?php endforeach; ?>