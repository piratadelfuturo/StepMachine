<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
        <?php if(isset($entity) && $entity['slug'] !== null): ?>
            <section>
                <label>URL</label>
                <div>
                    <?php
                        $url = $view['router']->generate('BoomFrontBundle_slug_show',array('slug' => $entity['category']['slug'].'/'.$entity['slug']),true);
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
        <?php echo $view['form']->row($form['date_published'],array('Label' => 'Fecha de publicación')) ?>
        <section>
            <?php echo $view['form']->label($form['image'], 'Imagen') ?>
            <div><?php echo $view['form']->widget($form['image'], array('attr' => array('class' => 'image-uploader'))); ?> </div>
        </section>
        <?php echo $view['form']->row($form['nsfw'], array('label' => 'NSFW')) ?>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría')) ?>
        <?php echo $view['form']->row($form['status'], array('label' => 'Estatus')) ?>
        <?php // echo $view['form']->row($form['tags'], array('label' => 'Etiquetas')) ?>
    </fieldset>
    <fieldset id="<?php echo $form['elements']->get('id') ?>" class="sort-elements">
        <label>Boomies</label>
        <?php
        foreach ($form['elements'] as $element):
            ?>
            <fieldset id="<?php echo $element->get('id') ?>">
                <label>
                    <strong><?php echo "B{$element['position']->vars['value']}"; ?></strong>
                    <span><?php echo $element['title']->vars['value'] ?></span>
                </label>
                <fieldset class="accordion_content">
                    <?php if(isset($element['id']) && $element['id'] !== null): ?>
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
                        'attr' => array(
                            'class' => 'boomie-title-input'
                        )
                            )
                    );

                    echo $view['form']->row(
                            $element['content'], array(
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
                <button id="boom-preview" value ="<?php echo $entity['id']?>" class="submit" type="submit" >Preview</button>
                <button id="boom-submit" class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>