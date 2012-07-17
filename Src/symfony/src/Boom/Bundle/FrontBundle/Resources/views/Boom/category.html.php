<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
      <?php echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock',
              array(
                  'title' => 'top semanal'
              )
              );?>
      <?php echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock',
              array(
                  'title' => 'booms de usuarios'
              )
              );?>
      <?php echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock',
              array(
                  'title' => 'últimos'
              )
              );?>
      <?php echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock',
              array(
                  'title' => 'recomendados'
              )
              );?>