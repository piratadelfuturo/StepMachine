<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>
<h1>Imagen</h1>
<?php
echo $view->render(
        'BoomBackBundle:Image:form/fullForm.html.php', array(
    'form_url' => $view['router']->generate('BoomBackBundle_image_create'),
    'form_enctype' => $view['form']->enctype($edit_form),
    'form_title' => 'Editar boom',
    'form' => $edit_form,
    'entity' => $entity
        )
);
?>