<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>
<form action="<?php echo $view['router']->generate('BoomBackBundle_boom_update', array('id' => $entity['id'])) ?>" method="post" <?php echo $view['form']->enctype($edit_form) ?> >
    <fieldset>
        <label>Boom edit</label>
        <?php echo $view['form']->row($edit_form['title'],array('label' =>'Título')) ?>
        <?php echo $view['form']->row($edit_form['summary'],array('label'=>'Resumen')) ?>
        <?php echo $view['form']->row($edit_form['image'],array('label'=>'Imagen')) ?>
            <?php //echo $view['form']->row($edit_form['categories'],array('label'=>'Categorías')) ?>
        <section>
            <div>
                <button class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>
</form>


<ul class="record_actions">
    <li>
        <a href="{{ path('boom') }}">
            Back to the list
        </a>
    </li>
    <li>
        <form action="<?php $view['router']->generate('BoomBackBundle_boom_delete', array('id' => $entity['id'])) ?>" method="post">
            <?php echo $view['form']->widget($delete_form) ?>
            <button type="submit">Delete</button>
        </form>
    </li>
</ul>