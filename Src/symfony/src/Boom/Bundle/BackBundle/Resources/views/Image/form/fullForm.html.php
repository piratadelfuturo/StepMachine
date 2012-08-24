<?php
$img = null;
if(isset($entity) && $entity->getPath() !== null){
    $img = $view['assets']->getUrl($view['boom_image']->getBoomImagePath().$entity['path']);
} ?>

<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $form_enctype ?> >
    <fieldset>
        <label><?php echo $form_title ?></label>
    </fieldset>
    <fieldset>
        <?php
        echo $view['form']->row($form['_token']);
        echo $view['form']->row($form['title'], array('label' => 'Título'));
        echo $view['form']->row($form['description'], array('label' => 'Descripción'));
        echo $view['form']->row($form['nsfw'], array('label' => 'NSFW'));
        ?>
        <section>
            <section>
                <?php
                if(isset($form['file'])):
                    echo $view['form']->label($form['file'], 'Imagen');
                else: ?>
                <label>Imagen</label>
                <?php
                endif;
                ?>
            </section>
            <div>
                <?php
                if(isset($form['file'])):
                    echo $view['form']->widget($form['file'], array('label' => 'Imagen'));
                elseif($img !== null): ?>
                    <img src="<?php echo $img ?>" />
                <?php endif; ?>

            </div>
        </section>
    </fieldset>
    <fieldset>
        <section>
            <div>
                <button class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>

</form>