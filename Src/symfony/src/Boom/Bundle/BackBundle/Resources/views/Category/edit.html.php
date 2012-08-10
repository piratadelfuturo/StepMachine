<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($edit_form, array('BoomBackBundle:Form')) ?>

    <?php

    echo $view->render(
            'BoomBackBundle:Category:form/fullForm.html.php', array(
        'form_url' => $view['router']->generate('BoomBackBundle_category_update', array('id' => $entity['id'])),
        'form_enctype' => $view['form']->enctype($edit_form),
        'form_title' => 'Editar categoría',
        'form' => $edit_form
            )
    );
    ?>
