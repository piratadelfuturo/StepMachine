<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>
<?php
echo $view->render(
        'BoomBackBundle:Boom:form/fullForm.html.php', array(
    'form_url' => $view['router']->generate('BoomBackBundle_boom_update', array('id' => $entity['id'])),
    'form_enctype' => $view['form']->enctype($edit_form),
    'form' => $edit_form,
    'form_title' => 'Editar Boom',
    'entity' => $entity,
    'ajax_image_form' => $ajax_image_form
        )
);
?>

<!--
<form action="<?php $view['router']->generate('BoomBackBundle_boom_delete', array('id' => $entity['id'])) ?>" method="post">
    <?php echo $view['form']->widget($delete_form) ?>
    <fieldset>
        <label>Eliminar</label>
        <section>
            <div>
                <button type="submit">Aceptar</button>
            </div>
        </section>
    </fieldset>
</form>
-->

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/js/Bundle/Boom/form.js') ?>"></script>
