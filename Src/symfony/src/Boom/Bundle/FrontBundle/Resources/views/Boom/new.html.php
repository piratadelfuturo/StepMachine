<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<h1>Boom</h1>
<?php
echo $view->render(
        'BoomFrontBundle:Boom:form/fullForm.html.php', array(
    'form_url' => $view['router']->generate('BoomFrontBundle_boom_create'),
    'form_enctype' => $view['form']->enctype($form),
    'form_title' => 'Crear imagen',
    'form' => $form
        )
);
?>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/js/Bundle/Boom/form.js') ?>"></script>

