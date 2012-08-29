<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
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
    <a href="#"><span class="comocrear">¿Cómo crear tu boom?</span></a>
    <div id="form-boom">
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
    </div>
</div>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/js/Bundle/Boom/form.js') ?>"></script>

