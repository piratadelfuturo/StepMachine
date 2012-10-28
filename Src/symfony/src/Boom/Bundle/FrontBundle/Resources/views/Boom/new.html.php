<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<div id="usr-site">
    <div id="tusitio-bar">
        <h3>tu sitio</h3>
        <ul>
            <a href="#"><li class="reciente-booms">Reciente</li></a>
            <a href="#"><li class="mis-booms">Mis Booms</li></a>
            <a href="#"><li class="recomendados-booms">Recomendados</li></a>
        </ul>
    </div>
    <span id="creatuboom"><h3>crea tu boom</h3></span>
    <div id="form-boom">
        <?php
        if (!isset($form_url)) {
            $form_url = $view['router']->generate('BoomFrontBundle_boom_create');
        }

        echo $view->render(
                'BoomFrontBundle:Boom:form/fullForm.html.php', array(
            'form_url' => $form_url,
            'form' => $form
                )
        );
        ?>
    </div>
</div>

