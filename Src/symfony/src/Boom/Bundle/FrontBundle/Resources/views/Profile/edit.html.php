<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomFrontBundle:Form')) ?>
<div class="editar-perfil">
    <h3 class="title-flag gris">Configuración de la Cuenta</h3>
    <form action="<?php echo $view['router']->generate('BoomFrontBundle_profile_edit') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
        <fieldset class="basic-info">
            <?php echo $view['form']->row($form['_token']) ?>
            <div class="usr-pic">
                <img src="<?php echo $entity['imagepath'] ?>" id="user-img" height="150px" width="150px"/>
            </div>
            <div class="grad-border">
            <?php
              echo $view['form']->row(
                      $form['username'], array(
                  'label' => 'nombre de usuario',
                  'attr' => array(
                      'placeholder' => 'Username'
                  )
                      )
                    );?>
            </div>
            <?php
            echo $view['form']->row(
                    $form['firstname'], array(
                'label' => 'Nombre',
                'attr' => array(
                  'placeholder' => 'Nombre',
                )
            ));
            echo $view['form']->row(
                    $form['lastname'], array(
                'label' => 'apellido',
                'attr' => array(
                    'placeholder' => 'Apellido'
                )
                    )
            );
                       echo $view['form']->row(
                    $form['profile_image'], array(
                'label' => 'imagen',
                'attr' => array(
                  'placeholder' => 'placeholder'
                )
                    )
                  ); 
            ?>
            <p>Sube una imagen de 150X150 pixeles para que sea tu ávatar en 7Boom.</p>
          </fieldset>
          <fieldset>
            <div class="grad-border">

          <?php 
            echo $view['form']->row(
                    $form['bio'], array(
                'label' => 'bio',
                'attr' => array(
                    'placeholder' => 'Tu descripción o Bio. No te excedas, a nadie le importa, realmente...'
                )
                    )
                  ); 
?>
</div>
        </fieldset>
        <fieldset>
          <h3>cambiar correo</h3>
        </fieldset>
        <fieldset>
          <h3>Conecta con twitter</h3>
          <?php
            echo $view['form']->row(
                    $form['twitter_username'], array(
                'label' => 'Twitter',
                'attr' => array(
                    'placeholder' => '@Twitter'
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

