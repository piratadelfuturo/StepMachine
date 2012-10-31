<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>
<?php echo $view['form']->errors($edit_form) ?>
<form action="<?php echo $view['router']->generate('BoomBackBundle_user_update', array('id' => $entity['id'])) ?>" method="post" <?php echo $view['form']->enctype($edit_form) ?> >
    <fieldset>
        <label><?php echo $entity['username'] ?></label>
        <?php echo $view['form']->row($edit_form['_token']) ?>
        <?php echo $view['form']->row($edit_form['bio']) ?>
        <?php if(!empty($entity['password'])): ?>
            <?php echo $view['form']->row($edit_form['admin']) ?>
        <?php endif; ?>
        <?php echo $view['form']->row($edit_form['collaborator'],array('label'=>'Colaborador')) ?>
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
        <?php if($entity['confirmationtoken'] !== null && $view['security']->isGranted('ROLE_SUPER_ADMIN')):?>
        <section>
            <section>
                <label>Password reset link</label>
            </section>
            <div>
                <a href="<?php echo $view['router']->generate('fos_user_resetting_reset',array('token' => $entity['confirmationtoken']),true)?>">
                    <?php echo $view['router']->generate('fos_user_resetting_reset',array('token' => $entity['confirmationtoken']),true)?>
                </a>
            </div>
        </section>
        <?php endif; ?>
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