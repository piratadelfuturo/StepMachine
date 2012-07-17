<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$view['slots']->start('top_two_col');
echo $view['actions']->render('BoomFrontBundle:Default:bigTopBlock', array(
            'title' => 'top semanal'
                ));
$view['slots']->stop();
?>
<?php
echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock', array(
    'title' => 'top semanal'
        )
);
?>
<?php
echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock', array(
    'title' => 'booms de usuarios'
        )
);
?>
<?php
echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock', array(
    'title' => 'últimos'
        )
);
?>
<?php
echo $view['actions']->render('BoomFrontBundle:Boom:homeBlock', array(
    'title' => 'recomendados'
        )
);
?>