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

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/js/Bundle/Boom/form.js') ?>"></script>
