<form id="<?php echo $form->getName() ?>" action="<?php echo $form_url ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
    <?php echo $view['form']->row($form['_token']); ?>
    <fieldset
        id="<?php echo $form['list_elements']->get('id') ?>"
        data-prototype="<?php echo $view->escape($view['form']->row($form['list_elements']->get('prototype'))) ?>"
        class="sort-elements" >
            <?php foreach ($form['list_elements'] as $element): ?>
                <?php echo $view['form']->row($element) ?>
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
