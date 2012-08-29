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
                  'more_url'=> $view['router']->generate('BoomFrontBundle_list_top')
    );
    $blocks['booms_usuarios'] = array(
                  'title' => 'booms de usuarios',
                  'list'  => array(),
                  'more_url' => $view['router']->generate('BoomFrontBundle_list_users')
    );
    $blocks['ultimos'] = array(
                  'title'   => 'últimos',
                  'list'    => $latest,
                  'more_url'=> $view['router']->generate('BoomFrontBundle_list_latest')
    );
    $blocks['recomendados'] = array(
                  'title'   => 'recomendados',
                  'list'    =>  array(),
                  'more_url'=>  $view['router']->generate('BoomFrontBundle_list_recommended')
    );

    foreach($blocks as $block):?>
      <?php echo $view->render('BoomFrontBundle:Boom:blocks/block_list.html.php',
              $block
              );?>
<?php endforeach; ?>