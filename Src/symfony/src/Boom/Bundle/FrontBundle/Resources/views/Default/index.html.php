<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$view['slots']->start('top_two_col');
echo $view->render('BoomFrontBundle:Default:blocks/bigTop.html.php', array(
            'title' => 'top semanal'
                ));
$view['slots']->stop();
?>
<?php
echo $view->render('BoomFrontBundle:Boom:home/block.html.php', array(
    'title' => 'top semanal'
        )
);
?>
<?php
echo $view->render('BoomFrontBundle:Boom:home/block.html.php', array(
    'title' => 'booms de usuarios'
        )
);
?>
<?php
echo $view->render('BoomFrontBundle:Boom:home/block.html.php', array(
    'title' => 'últimos'
        )
);
?>
<?php
echo $view->render('BoomFrontBundle:Boom:home/block.html.php', array(
    'title' => 'recomendados'
        )
);
?>