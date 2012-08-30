<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<h1>Boom</h1>
<?php
echo $view->render(
        'BoomBackBundle:Boom:form/fullForm.html.php', array(
    'form_url'      => $view['router']->generate('BoomBackBundle_boom_create'),
    'form_enctype'  => $view['form']->enctype($form),
    'form_title'    => 'Crear Boom',
    'form'          => $form,
    'entity'        => $entity
        )
);
?>

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/js/Bundle/Boom/form.js') ?>"></script>

