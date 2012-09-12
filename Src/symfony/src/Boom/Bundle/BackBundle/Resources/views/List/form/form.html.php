<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
    <?php echo $view['form']->row($form['_token']); ?>
    <fieldset
        id="<?php echo $form['list_elements']->get('id') ?>"
        data-prototype="<?php echo $view->escape($view['form']->widget($form['list_elements']->get('prototype'))) ?>"
        class="sort-elements" >
            <?php foreach ($form['list_elements'] as $element): ?>
            <fieldset id="<?php echo $element->get('id') ?>" >
                <label><?php echo $element->get('name') ?></label>
                <fieldset>
                    <?php echo $view['form']->row($element['title']); ?>
                    <?php echo $view['form']->row($element['summary']); ?>
                    <?php echo $view['form']->row($element['url']); ?>
                    <?php echo $view['form']->row($element['boom']); ?>
                    <?php echo $view['form']->row($element['category']); ?>
                    <?php echo $view['form']->row($element['image']); ?>
                    <?php echo $view['form']->row($element['position']); ?>
                </fieldset>
            </fieldset>
        <?php endforeach; ?>
    </fieldset>

    <fieldset>
        <section>
            <div>
                <button type="submit" class="submit" id="boom-submit">Guardar</button>
            </div>
        </section>
    </fieldset>
</form>
