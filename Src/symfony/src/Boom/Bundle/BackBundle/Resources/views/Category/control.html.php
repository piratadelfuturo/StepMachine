<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>Categories</h1>
    <?php echo $view['form']->rest($form); ?>
    <?php foreach($categories as $category):?>

    <?php endforeach; ?>
</div>
<script type="text/javascript">
    (function(document,$){

    })(document,jQuery);
</script>