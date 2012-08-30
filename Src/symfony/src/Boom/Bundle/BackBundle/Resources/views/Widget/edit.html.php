<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>
<h1>Widget</h1>
<?php
echo $view->render(
        'BoomBackBundle:Widget:form/fullForm.html.php', array(
    'form_url'      => $view['router']->generate('BoomBackBundle_widget_update',array('id' => $entity['id'])),
    'form_enctype'  => $view['form']->enctype($edit_form),
    'form_title'    => 'Crear widget',
    'form'          => $edit_form,
    'entity'        => $entity
        )
);
?>