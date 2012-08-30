<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<h1>Widget</h1>
<?php
echo $view->render(
        'BoomBackBundle:Widget:form/fullForm.html.php', array(
    'form_url'      => $view['router']->generate('BoomBackBundle_widget_create'),
    'form_enctype'  => $view['form']->enctype($form),
    'form_title'    => 'Crear widget',
    'form'          => $form,
    'entity'        => $entity
        )
);
?>