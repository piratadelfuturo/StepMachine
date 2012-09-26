<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')); ?>
<form id="<?php echo $form->get('id') ?>" method="post" >
    <?php echo $view['form']->widget($form['_token']) ?>
    <fieldset
        id="<?php echo $form['images']->get('id') ?>"
        data-prototype="<?php echo $view->escape($view['form']->row($form['images']->get('prototype'))); ?>"
        class="sort-elements"
        >
            <?php foreach ($form['images'] as $element): ?>
                <?php echo $view['form']->row($element) ?>
            <?php endforeach; ?>
    </fieldset>
</form>
<script text="text/javscript">

</script>