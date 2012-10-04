<?php $view['form']->setTheme($form, array('BoomFrontBundle:Form')) ?>
<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
    <fieldset>
        <?php echo $view['form']->errors($form) ?>
        <?php echo $view['form']->widget($form['_token']) ?>
        <?php echo $view['form']->label($form['title'], 'Título de tu boom') ?>
        <div class="grad-border">
            <?php
            echo $view['form']->widget($form['title'], array(
                'attr' => array(
                  'placeholder' => 'Título de tu Boom',
                  'class' => 'titulo-deboom'
                    )))
            ?>
        </div>
        <?php
        echo $view['form']->row(
                $form['summary'], array(
            'label' => 'Resumen',
            'attr' => array(
                'placeholder' => 'El resumen de tu Boom…',
                'class' => 'boomie-resumen'
            )
                )
        )
        ?>
        <section>
            <?php echo $view['form']->label($form['image'], 'Imagen') ?>
            <div><?php
            echo $view['form']->widget(
                    $form['image'], array(
                'attr' => array(
                    'class' => 'image-uploader'
                )
                    )
            );
            ?></div>
        </section>
        <section id="nsfw-sc">
          <div class="balloon">
            <p>Un material es NSFW (not safe for work) si contien desnudos o material explícito que no puedan ver menores de edad ni godínez bajo vigilancia labora.</p>
          </div>
          <?php echo $view['form']->widget($form['nsfw']) ?>
          <label>NSFW:</label>
        </section>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría: ')) ?>
    </fieldset>
    <ul id="<?php echo $form['elements']->get('id') ?>" class="sort-elements booms">
        <?php foreach ($form['elements'] as $element): ?>
            <li><fieldset id="<?php echo $element->get('id') ?>" class="boomie boom">
                    <label>
                        <div class="balloon">
                            <p>Arrastra este boomie</p>
                        </div>
                        <span class="place"><?php echo (string) $element['position']->vars['value']; ?></span>
                    </label>
                    <div class="uploader">
                      <p class="instrucciones">Arrastra tu foto</p>
                      <?php
                      echo $view['form']->widget(
                              $element['image'], array(
                          'attr' => array(
                              'class' => 'up-pic image-uploader',
                              'placeholder' => "Arrastra tu foto",
                              'multiple' => 'multiple'
                          )
                              )
                            ) ?>
                    </div>
                    <?php echo $view['form']->widget(
                            $element['title'], array(
                        'attr' => array(
                            'class' => 'boomie-title-input',
                            'placeholder' => 'Título del Boom No.' . $element['position']->vars['value']
                        )
                            )
                    );
                    ?>
                    <div class="accordion_content">
                        <ul class="wyswyg-menu">
                            <li class="hyperlink">
                              <div class="balloon">Hipervinculo</div>
                              <a href="#" >Hipervinculo</a>
                            </li>
                            <li class="picture">
                              <div class="balloon">Foto</div>
                              <a href="#" image-path="<?php echo $view['router']->generate('BoomFrontBundle_image_ajax_create')?>" >
                                  Foto
                              </a>
                            </li>
                            <!--
                            <li class="embed">
                              <div class="balloon">Embed</div>
                              <a href="#" >Embed</a>
                            </li>
                            -->
                            <li class="gallery">
                              <div class="balloon">Galería</div>
                              <a
                                  href="#"
                                  image-path="<?php echo $view['router']->generate('BoomFrontBundle_image_ajax_create')?>"
                                  gallery-new-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_new')?>"
                                  gallery-create-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_create')?>"
                                  gallery-edit-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_edit',array('id' => '__id__'))?>"
                                  gallery-update-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_update',array('id' => '__id__'))?>"
                                  >
                                  Galería
                              </a>
                            </li>
                            <li class="video">
                              <div class="balloon">Video</div>
                              <a href="#" >Video</a>
                            </li>
                        </ul>
                        <?php
                        echo $view['form']->widget(
                                $element['position'], array(
                            'attr' => array(
                                'class' => 'boomie-position-input'
                            )
                                )
                        );?>
                        <div class="wysiwyg-container">
                        <?php
                        echo $view['form']->widget(
                                $element['content'], array(
                            'attr' => array(
                                'class' => 'boom-wysiwyg',
                                'placeholder' => 'Escribe aquí tu boom...'
                            )
                                )
                        );
                        ?>
                        </div>
                    </div>
                    <span class="tab"><a href="#"><span>TAB</span></a></span>
                </fieldset></li>
        <?php endforeach; ?>
    </ul>
    <?php
    echo $view['form']->row(
            $form['tags'], array(
        'attr' => array(
            'label' => 'Tags\:',
            'placeholder' => 'Escribe tus tags separados por comas...'
        )
            )
    )
    ?>
    <button class="submit" type="submit" >¡Publicar!</button>
</form>
