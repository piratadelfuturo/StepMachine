<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<div class="g8" >
    <h3><?php echo ucwords($entity['block']).' - '.$entity['name'] ?></h3>
    <?php
    echo $view->render(
            'BoomBackBundle:List:form/form.html.php', array(
        'form_url' => $view['router']->generate(
                'BoomBackBundle_list_update',
                array(
                    'block' => $entity['block'],
                    'name' => $entity['name']
                )
                ),
        'form_title' => 'Editar Boom',
        'form' => $form,
        'entity' => $entity
            )
    );
    ?>

</div>
<div class="g4" >
    <?php
    echo $view->render(
            'BoomBackBundle:List:form/search.html.php', array(
        'form_url' => $view['router']->generate('BoomBackBundle_boom_create'),
        'form_title' => 'Crear Boom',
        'form' => $form,
        'entity' => $entity
            )
    );
    ?>

</div>

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/js/Bundle/Default/form.js') ?>"></script>
<style type="text/css">
    #column-search-boom-results{
        overflow: hidden;
    }
    #column-search-boom-results div{
            margin: 1px 1px 3px;
    }
    #column-search-boom-results div *{
        margin: 1px 1px 0px 1px;
        clear: both;
    }
    #column-search-boom-results.loading{
        background-image: url('/bundles/boomback/images/ajax-loader.gif');
        background-repeat: no-repeat;
        background-position: center center;
        height: 75px;
    }

</style>