<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')); ?>
<form id="<?php echo $form->get('id') ?>" method="post" >
    <?php echo $view['form']->widget($form['_token']) ?>
    <ul
        id="<?php echo $form['galleryimagerelations']->get('id') ?>"
        data-prototype="<?php echo $view->escape($view['form']->row($form['galleryimagerelations']->get('prototype'))); ?>"
        class="gallery"
        >
            <?php foreach ($form['galleryimagerelations'] as $element): ?>
                <?php echo $view['form']->row($element) ?>
            <?php endforeach; ?>
    </fieldset>
</form>
<script text="text/javscript">

</script>