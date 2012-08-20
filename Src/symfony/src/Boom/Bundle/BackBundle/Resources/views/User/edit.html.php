<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>

<form action="<?php echo $view['router']->generate('BoomBackBundle_user_update', array('id' => $entity['id'])) ?>" method="post" <?php echo $view['form']->enctype($edit_form) ?> >
    <fieldset>
        <label><?php echo $entity['username'] ?></label>
        <?php echo $view['form']->row($edit_form['_token']) ?>
        <?php echo $view['form']->row($edit_form['bio']) ?>
        <?php echo $view['form']->row($edit_form['admin']) ?>
        <section>
            <section>
                <label>Roles</label>
            </section>
            <div>
                <ul>
                <?php foreach($entity['roles'] as $role): ?>
                    <li>
                    <?php echo $role; ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </section>
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