<?php $view->extend('BoomFrontBundle::layout.html.php') ?>
<?php $view['slots']->output('_content') ?>
<aside>
    <div class="banner1 sb-bloque">
        BANNER
    </div>
    <?php echo $view['actions']->render('BoomFrontBundle:Widget:facebook'); ?>
    <div class="tw-wdgt sb-bloque">
        <h3><span>twitter</span></h3>
    </div>
    <?php echo $view['actions']->render('BoomFrontBundle:Widget:collaborators'); ?>
    <?php echo $view['actions']->render('BoomFrontBundle:Widget:daily'); ?>
</aside>