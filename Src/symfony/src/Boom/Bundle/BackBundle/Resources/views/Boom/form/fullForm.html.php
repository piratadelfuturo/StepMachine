<?php echo $view['form']->errors($form) ?>
<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
        <?php if (isset($entity) && $entity['slug'] !== null): ?>
            <section>
                <label>URL</label>
                <div>
                    <?php
                    $url = $view['router']->generate(
                            'BoomFrontBundle_boom_show', array('category_slug' => $entity['category']['slug'],
                        'slug' => $entity['slug']), true);
                    ?>
                    <a href="<?php echo $url ?>" target="_blank" ><?php echo $url ?></a>
                </div>
            </section>
        <?php endif; ?>
        <?php echo $view['form']->row($form['_token']) ?>
        <?php echo $view['form']->row($form['title'], array('label' => 'Título')) ?>
        <?php
        echo $view['form']->row(
                $form['summary'], array(
            'label' => 'Resumen',
            'attr' => array(
                'class' => 'boomie-position-input'
            )
                )
        )
        ?>
        <?php echo $view['form']->row($form['date_published'], array('label' => 'Fecha de publicación')) ?>
        <?php echo $view['form']->row($form['image'], array('label' => 'Imagen')) ?>
        <?php /* ?>
        <section>
            <?php echo $view['form']->label($form['image'], 'Imagen') ?>
            <div>
                <?php echo $view['form']->widget($form['image']['id']); ?>
                <?php echo $view['form']->widget($form['image']['file'], array('attr' => array('class' => 'ajax-image-uploader'))); ?>
            </div>
        </section>
         <?php */ ?>
        <?php echo $view['form']->row($form['nsfw'], array('label' => 'NSFW')) ?>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría')) ?>
        <?php echo $view['form']->row($form['status'], array('label' => 'Estatus')) ?>
        <?php if (isset($form['featured'])): ?>
            <?php echo $view['form']->row(
                    $form['featured'],
                    array(
                        'label' => 'Recomendado'
                        )
                    ) ?>
        <?php endif; ?>
        <?php echo $view['form']->row($form['tags'], array('label' => 'Etiquetas')) ?>
    </fieldset>
    <fieldset id="<?php echo $form['elements']->get('id') ?>" class="sort-elements">
        <label>Boomies</label>
        <?php
        foreach ($form['elements'] as $element):
            ?>
            <fieldset id="<?php echo $element->get('id') ?>" class="widget" >
                <h3 class="handle icon">
                    <strong><?php echo "B{$element['position']->vars['value']}"; ?></strong>
                    <span><?php echo $element['title']->vars['value'] ?></span>
                    <a class="icon i_powerpoint_document"></a>
                    <a class="collapse"></a>
                </h3>
                <fieldset class="accordion_content">
                    <?php if (isset($element['id']) && $element['id'] !== null): ?>
                        <?php //echo $view['form']->widget($element['id']); ?>
                    <?php endif; ?>
                    <?php
                    echo $view['form']->widget(
                            $element['position'], array(
                        'attr' => array(
                            'class' => 'boomie-position-input'
                        )
                            )
                    );
                    echo $view['form']->row(
                            $element['title'], array(
                        'label' => 'Título',
                        'attr' => array(
                            'class' => 'boomie-title-input'
                        )
                            )
                    );

                    echo $view['form']->row(
                            $element['image'], array(
                        'label' => 'Imagen'
                            )
                    );

                    echo $view['form']->row(
                            $element['content'], array(
                                'label' => 'Contenido',
                        'attr' => array(
                            'class' => 'boom-wysiwyg'
                        )
                            )
                    );
                    ?>
                </fieldset>
            </fieldset>
        <?php endforeach; ?>

    </fieldset>
    <fieldset>
        <section>
            <div>
                <button id="boom-preview" class="submit" type="button" value ="<?php echo $entity['id'] ?>" >Preview</button>
                <button id="boom-submit" class="submit" type="button" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>