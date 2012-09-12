<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<div class="g8" >
    <h3><?php echo $entity['name'] ?></h3>
    <?php
        $view->render(
                '',
                array(
                    'form' => $form,
                    'form_url' =>
                )
                );
    ?>
</div>
<div class="g4" >
    <form>
        <fieldset>
            <section>
                <section>
                </section>
                <div>
                    <button class="i_create_write icon yellow" id="column-search-boom-add">Agregar posición vacia</button>
                </div>
            </section>
            <section class="i_magnifying_glass" style="background-position: 12px 18px;background-repeat: no-repeat;" >
                <section>
                </section>
                <div>
                    <input type="text" value="" id="column-search-boom" />
                </div>
            </section>
        </fieldset>
        <fieldset id="column-search-boom-results">
        </fieldset>

    </form>
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