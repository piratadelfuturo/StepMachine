<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomFrontBundle:Form')) ?>
<div class="editar-perfil">
    <h3 class="title-flag gris">Configuración de la Cuenta</h3>
    <form action="<?php echo $view['router']->generate('BoomFrontBundle_profile_update') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
        <fieldset class="basic-info">
            <?php echo $view['form']->row($form['_token']) ?>
            <div>
                <?php echo $view['form']->errors($form)?>
            </div>
            <div class="user-card">
                <div class="user-image-block">
                    <div class="user-image">
                        <img src="<?php echo $view['boom_image']->getProfileImageUrl($entity['imagepath'], array(150, 150)) ?>" id="user-img" width="150px"/>
                    </div>
                </div>
                <div class="user-personal-data">
                    <?php
                    echo $view['form']->widget(
                            $form['username'], array(
                        'label' => 'nombre de usuario',
                        'attr' => array(
                            'placeholder' => 'Nombre de usuario'
                        )
                            )
                    );
                    echo $view['form']->widget(
                            $form['name'], array(
                        'label' => 'Nombre público',
                        'attr' => array(
                            'placeholder' => 'Nombre público',
                        )
                    ));
                    echo $view['form']->widget(
                            $form['firstname'], array(
                        'label' => 'Nombre',
                        'attr' => array(
                            'placeholder' => 'Nombre',
                        )
                    ));
                    echo $view['form']->widget(
                            $form['lastname'], array(
                        'label' => 'apellido',
                        'attr' => array(
                            'placeholder' => 'Apellido'
                        )
                            )
                    );
                    ?>
                    <div class="image-row">
                        <?php
                        echo $view['form']->label(
                                $form['profile_image']
                        );
                        echo $view['form']->widget(
                                $form['profile_image']);
                        ?>
                    </div>
                </div>
            </div>
            <?php
            echo $view['form']->row(
                    $form['bio'], array(
                'attr' => array(
                    'placeholder' => 'Tu descripción o Bio. No te excedas, a nadie le importa, realmente...'
                )
                    )
            );
            echo $view['form']->row(
                    $form['email'], array(
                'label' => 'E-mail',
                'attr' => array(
                    'placeholder' => '@twitter'
                )
                    )
            );
            echo $view['form']->row(
                    $form['twitter_username'], array(
                'label' => 'Conecta con twitter',
                'attr' => array(
                    'placeholder' => '@twitter'
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

