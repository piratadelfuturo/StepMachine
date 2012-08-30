<?php $view->extend('BoomFrontBundle::layout.html.php') ?>
<?php $view['slots']->output('top_two_col',''); ?>
<div id="booms-container">
<?php $view['slots']->output('_content') ?>
</div>
<aside>
    <?php $view['slots']->output('sidebar_top') ?>
    <?php
        $widgets = $view['boom_front']->getWidgetBlock('upper_sidebar');
        foreach($widgets as $widget){
            echo $widget;
        }
    ?>
    <div class="banner1 sb-bloque">
        BANNER
    </div>
    <?php echo $view->render('BoomFrontBundle:Widget:facebook.html.php'); ?>
    <?php echo $view->render('BoomFrontBundle:Widget:twitter.html.php'); ?>
    <?php echo $view['actions']->render('BoomFrontBundle:Widget:collaborators'); ?>
    <?php
        $widgets = $view['boom_front']->getWidgetBlock('lower_sidebar');
        foreach($widgets as $widget){
            echo $widget;
        }
    ?>
</aside>