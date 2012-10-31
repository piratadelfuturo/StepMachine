<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomFrontBundle:Form')) ?>
<div class="editar-perfil">
    <h3 class="title-flag gris">Configuración de la Cuenta</h3>
    <form action="<?php echo $view['router']->generate('BoomFrontBundle_profile_edit') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
        <fieldset>
            <?php echo $view['form']->row($form['_token']) ?>
            <div class="usr-pic">
                <img src="<?php echo $entity['imagepath'] ?>" id="user-img" height="150px" width="150px"/>
            </div>
            <?php
            echo $view['form']->row(
                    $form['profile_image'], array(
                'label' => 'imagen',
                'attr' => array(
                    'placeholder' => 'placeholder'
                )
                    )
            );
            echo $view['form']->row(
                    $form['firstname'], array(
                'label' => 'Nombre',
                'attr' => array(
                    'placeholder' => 'placeholder'
                )
            ));
            echo $view['form']->row(
                    $form['name'], array(
                'label' => 'nombre publico',
                'attr' => array(
                    'placeholder' => 'placeholder'
                )
                    )
            );
            echo $view['form']->row(
                    $form['username'], array(
                'label' => 'nombre de usuario',
                array(
                    'placeholder' => 'placeholder'
                )
                    )
            );
            echo $view['form']->row(
                    $form['bio'], array(
                'label' => 'bio',
                'attr' => array(
                    'placeholder' => 'placeholder'
                )
                    )
            );
            echo $view['form']->row(
                    $form['twitter_username'], array(
                'label' => 'Twitter',
                'attr' => array(
                    'placeholder' => 'placeholder'
                )
                    )
            );
            ?>
        </fieldset>
        <fieldset>
            <section>
                <div>
                    <button class="submit" type="submit" >Guardar</button>
                </div>
            </section>
        </fieldset>
    </form>
</div>

