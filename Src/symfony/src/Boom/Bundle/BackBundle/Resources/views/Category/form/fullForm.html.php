<form action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
        <?php echo $view['form']->row($form['_token']) ?>
        <?php echo $view['form']->row($form['name'], array('label' => 'Nombre')) ?>
        <?php echo $view['form']->row($form['position'],array('label' => 'Posición')) ?>
        <?php echo $view['form']->row($form['featured'], array('label' => 'Principal')) ?>
    </fieldset>
    <fieldset>
        <section>
            <div>
                <button class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>