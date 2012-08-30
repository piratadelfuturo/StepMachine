<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
        <?php echo $view['form']->rest($form) ?>
    </fieldset>
    <fieldset>
        <section>
            <div>
                <button id="boom-submit" class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>