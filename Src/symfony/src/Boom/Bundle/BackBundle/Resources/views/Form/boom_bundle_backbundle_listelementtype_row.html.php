<fieldset id="<?php echo $form->get('id') ?>" class="widget" >
    <h3 class="handle icon" >
        <?php echo $form->get('name') ?>
        <a class="icon i_bulls_eye"></a>
        <a title="remove" class="collapse remove"></a>
    </h3>
    <fieldset>
        <?php echo $view['form']->widget($form); ?>
    </fieldset>
</fieldset>