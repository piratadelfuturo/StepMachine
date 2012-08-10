<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
    <?php

    echo $view->render(
            'BoomBackBundle:Category:form/fullForm.html.php', array(
        'form_url' => $view['router']->generate('BoomBackBundle_category_create'),
        'form_enctype' => $view['form']->enctype($form),
        'form_title' => 'Crear categoría',
        'form' => $form
            )
    );
    ?>
