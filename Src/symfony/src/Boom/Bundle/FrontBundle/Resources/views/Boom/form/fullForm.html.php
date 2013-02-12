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
            <?php echo '<span class="img-instrucciones">680 x 382 píxeles / JPG, PNG.</span>'?>
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
                <p>Un material es NSFW (Not Safe For Work) si contiene desnudos o material explícito que no puedan ver menores de edad ni godínez bajo vigilancia laboral.</p>
            </div>
            <?php echo $view['form']->widget($form['nsfw']) ?>
            <label>NSFW:</label>
        </section>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría: '))?>
        <?php
            if(isset($form['status'])){
                echo $view['form']->row($form['status'], array('label' => 'Status: '));
            }
        ?>
    </fieldset>
    <ul id="<?php echo $form['elements']->get('id') ?>" class="sort-elements booms">
        <?php
        $positionCounter = 0;
        foreach ($form['elements'] as $element):
            $positionCounter++;
            ?>
            <li class="boomie-editor"><fieldset id="<?php echo $element->get('id') ?>" class="boomie boom">
                    <label>
                        <span class="place"><?php echo $positionCounter; ?></span>
                    </label>
                    <?php /*
                      <div class="uploader">
                        <p class="instrucciones">Click para subir tu imagen</p>
                        <?php
                        echo $view['form']->widget(
                                $element['image'], array(
                            'attr' => array(
                                'class' => 'up-pic image-uploader',
                                'placeholder' => "Click para subir tu imagen",
                                'multiple' => 'multiple'
                            )
                                )
                        )
                        ?>
                    </div>
                    */?>
                    <?php
                    echo $view['form']->widget(
                            $element['title'], array(
                        'attr' => array(
                            'class' => 'boomie-title-input',
                            'placeholder' => 'Título del Boom No.' . $positionCounter
                        )
                            )
                    );
                    echo $view['form']->widget(
                            $element['position'], array(
                        'attr' => array(
                            'class' => 'boomie-position-input'
                        )
                            )
                    );
                    ?>
                    <div class="accordion_content">
                        <ul class="wyswyg-menu">
                            <li class="hyperlink">
                                <div class="balloon">Hipervínculo</div>
                                <a href="#" >Hipervínculo</a>
                            </li>
                            <li class="picture">
                                <div class="balloon">Foto</div>
                                <a href="#" image-path="<?php echo $view['router']->generate('BoomFrontBundle_image_ajax_create') ?>" >
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
                                    image-path="<?php echo $view['router']->generate('BoomFrontBundle_image_ajax_create') ?>"
                                    gallery-new-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_new') ?>"
                                    gallery-create-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_create') ?>"
                                    gallery-edit-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_edit', array('id' => '__id__')) ?>"
                                    gallery-update-path="<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_update', array('id' => '__id__')) ?>"
                                    >
                                    Galería
                                </a>
                            </li>
                            <li class="video">
                                <div class="balloon">Video</div>
                                <a href="#" >Video</a>
                            </li>
                        </ul>
                        <div class="wysiwyg-container">
                            <?php
                            echo $view['form']->widget(
                                    $element['content'], array(
                                'attr' => array(
                                    'class' => 'boom-wysiwyg',
                                    'placeholder' => 'Escribe aquí tu boom...',
                                    'gallery-preview' => $view['router']->generate('BoomFrontBundle_gallery_iframe_preview')
                                )
                                    )
                            );
                            ?>
                        </div>
                    </div>
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
