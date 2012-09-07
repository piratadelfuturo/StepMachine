<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<form id="<?php echo $form->getName() ?>" action="<?php echo $view['router']->generate('BoomBackBundle_widget_dailyseven') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
    <fieldset>
        <?php echo $view['form']->rest($form) ?>
        <section>
            <div>
                <button id="boom-submit" class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>
</form>