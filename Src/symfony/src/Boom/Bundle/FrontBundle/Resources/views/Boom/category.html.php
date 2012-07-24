<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
    $blocks = array();
    $blocks['top_semanal'] = array(
                  'title' => 'top semanal'        
    );
    $blocks['booms_usuarios'] = array(
                  'title' => 'booms de usuarios'
    );
    $blocks['ultimos'] = array(
                  'title' => 'últimos'
    );
    $blocks['recomendados'] = array(
                  'title' => 'recomendados'
    );
    
    foreach($blocks as $block):?>
      <?php echo $view->render('BoomFrontBundle:Boom:blocks/block_list.html.php',
              $block
              );?>
<?php endforeach; ?>