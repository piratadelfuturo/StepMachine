<?php $view['form']->setTheme($form, array('BoomFrontBundle:Form')) ?>
<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <?php echo $view['form']->widget($form['_token']) ?>
        <?php echo $view['form']->label($form['title'], 'Título de tu boom') ?>
        <div class="grad-border">
            <?php
            echo $view['form']->widget($form['title'], array(
                'attr' => array(
                    'placeholder' => 'Título de tu Boom'
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
        <section id="nsfw-sc"><?php echo $view['form']->widget($form['nsfw']) ?><label>NSFW:</label></section>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría: ')) ?>
    </fieldset>
    <ul id="<?php echo $form['elements']->get('id') ?>" class="sort-elements booms">
        <?php foreach ($form['elements'] as $element): ?>
            <li><fieldset id="<?php echo $element->get('id') ?>" class="boomie boom">
                    <label>
                        <div class="balloon">
                            <p>arrastrar</p>
                        </div>
                        <span class="place"><?php echo (string) $element['position']->vars['value']; ?></span>
                    </label>
                    <input class="up-pic" type="file multiple"  placeholder="Arrastra tu foto">
                    <?php
                    echo $view['form']->widget(
                            $element['image'], array(
                        'attr' => array(
                            'class' => 'up-pic image-uploader',
                            'placeholder' => "Arrastra tu foto",
                            'multiple' => 'multiple'
                        )
                            )
                    );
                    echo $view['form']->widget(
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
                            <li class="hyperlink"><a>Hipervinculo</a></li>
                            <li class="picture"><a>Foto</a></li>
                            <li class="embed"><a>Embed</a></li>
                            <li class="gallery"><a>Galería</a></li>
                            <li class="video"><a>Video</a></li>
                        </ul>
                        <?php
                        echo $view['form']->widget(
                                $element['position'], array(
                            'attr' => array(
                                'class' => 'boomie-position-input'
                            )
                                )
                        );
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
                    <span class="tab"><a href=""><span>TAB</span></a></span>
                </fieldset></li>
        <?php endforeach; ?>
    </ul>
    <?php
    echo $view['form']->row(
            $form['tags'], array(
        'attr' => array(
            'label' => 'Tags:',
            'placeholder' => 'Escribe tus tags separados por comas...'
        )
            )
    )
    ?>
    <button class="submit" type="submit" >¡Publicar!</button>
</form>
