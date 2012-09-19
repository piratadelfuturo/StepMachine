<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <?php echo $view['form']->widget($form['_token']) ?>
        <?php echo $view['form']->label($form['title'], 'Título de tu boom') ?>
        <div class="grad-border">
        <?php echo $view['form']->widget($form['title'],array('attrs' => array(
            'placeholder' => 'Título de tu Boom'
            ))) ?>
        </div>
        <?php
        echo $view['form']->row(
          $form['summary'], array(
            'label' => 'Resumen',
            'attr' => array(
              'class' => 'boomie-resumen'
            )
          )
        )
        ?>
        <section>
            <?php echo $view['form']->label($form['image'], 'Imagen') ?>
            <div><?php echo $view['form']->widget($form['image'], array('attr' => array('class' => 'image-uploader'))); ?></div>
        </section>
        <section id="nsfw-sc"><?php echo $view['form']->widget($form['nsfw']) ?><label>NSFW:</label></section>
        <?php echo $view['form']->row($form['category'], array('label' => 'Categoría: ')) ?>
    </fieldset>
    <ul id="<?php echo $form['elements']->get('id') ?>" class="sort-elements booms">
        <?php foreach ($form['elements'] as $element):?>
        <li><fieldset id="<?php echo $element->get('id') ?>" class="boomie boom">
          <form>
            <label>
              <span class="place"><?php echo "{$element['position']->vars['value']}"; ?></span>
            </label>
            <input class="up-pic" type="file multiple" name="boom-pic" placeholder="Arrastra tu foto">
            <?php echo $view['form']->widget(
                $element['title'], array(
                  'attr' => array(
                  'class' => 'boomie-title-input',
                  'placeholder' => 'Título del Boom No.'.$element['position']->vars['value']
                )
              )
            );?>
          </form>
          <div class="accordion_content">
            <?php if (isset($element['id']) && $element['id'] !== null): ?>
              <?php //echo $view['form']->widget($element['id']); ?>
            <?php endif; ?>
            <ul class="wyswyg-menu">
              <a href="#"><li class="hyperlink">Hipervinculo</li></a>
              <a href="#"><li class="picture">Foto</li></a>
              <a href="#"><li class="embed">Embed</li></a>
              <a href="#"><li class="gallery">Galería</li></a>
              <a href="#"><li class="video">Video</li></a>
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
      <?php echo $view['form']->row(
        $form['tags'], array(
          'attr' => array(
            'label' => 'Tags:',
            'placeholder' => 'Escribe tus tags separados por comas...'
          )
        )
      ) ?>
    <button class="submit" type="submit" >¡Publicar!</button>
</form>
