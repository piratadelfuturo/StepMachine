<form action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
        <?php echo $view['form']->row($form['_token']) ?>
        <?php echo $view['form']->row($form['name'], array('label' => 'Nombre')) ?>
    </fieldset>
    <fieldset>
        <section>
            <div>
                <button class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>