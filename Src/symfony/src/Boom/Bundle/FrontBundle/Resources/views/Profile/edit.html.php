<?php //$view->extend('BoomBackBundle::layout.html.php') ?>
<?php //$view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>

<form action="<?php echo $view['router']->generate('BoomBackBundle_user_update', array('id' => $entity['id'])) ?>" method="post" <?php echo $view['form']->enctype($edit_form) ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
        <?php echo $view['form']->row($edit_form['_token']) ?>
        <?php echo $view['form']->rest($edit_form) ?>
    </fieldset>
    <fieldset>
        <section>
            <div>
                <button class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>