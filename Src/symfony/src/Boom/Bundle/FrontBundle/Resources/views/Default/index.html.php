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
                  'title' => 'top semanal'
    );
    $blocks['booms_usuarios'] = array(
                  'title' => 'booms de usuarios'
    );
    $blocks['ultimos'] = array(
                  'title' => 'últimos',
                  'list' => $latest
    );
    $blocks['recomendados'] = array(
                  'title' => 'recomendados'
    );

    foreach($blocks as $block):?>
      <?php echo $view->render('BoomFrontBundle:Boom:blocks/block_list.html.php',
              $block
              );?>
<?php endforeach; ?>