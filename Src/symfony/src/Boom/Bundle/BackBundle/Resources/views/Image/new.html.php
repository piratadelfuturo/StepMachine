<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<h1>Imagen</h1>
<?php
echo $view->render(
        'BoomBackBundle:Image:form/fullForm.html.php', array(
    'form_url' => $view['router']->generate('BoomBackBundle_image_create'),
    'form_enctype' => $view['form']->enctype($form),
    'form_title' => 'Crear boom',
    'form' => $form
        )
);
?>
