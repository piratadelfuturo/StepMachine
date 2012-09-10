<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <?php echo $view['form']->widget($form['_token']) ?>
        <?php echo $view['form']->label($form['title'], 'Título de tu boom') ?>
        <input type="text" name="title" id="form-titleboom" placeholder="Título de tu Boom" />
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
        <section>
            <?php echo $view['form']->label($form['image'], 'Imagen') ?>
            <div><?php echo $view['form']->widget($form['image'], array('attr' => array('class' => 'image-uploader'))); ?> </div>
        </section>
        <?php echo $view['form']->row($form['nsfw'], array('label' => 'NSFW')) ?>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría principal')) ?>
    </fieldset>
    <fieldset id="<?php echo $form['elements']->get('id') ?>" class="sort-elements booms">
        <label>Boomies</label>
        <?php
        foreach ($form['elements'] as $element):
            ?>
            <fieldset id="<?php echo $element->get('id') ?>" class="boomie">
                <label>
                    <span class="place"><?php echo "{$element['position']->vars['value']}"; ?></span>
                    <span><?php echo $element['title']->vars['value'] ?></span>
                </label>
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
                    ?><D-º>
                </fieldset>
            </fieldset>
            <span class="tab"><a href=""><span>TAB</span></a></span>
        <?php endforeach; ?>
        <?php echo $view['form']->row($form['tags'], array('label' => 'Tags:')) ?>
    </fieldset>
    <button class="submit" type="submit" >¡Publicar!</button>
</form>
