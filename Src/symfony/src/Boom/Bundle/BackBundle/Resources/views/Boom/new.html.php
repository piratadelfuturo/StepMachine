<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<style type="text/css">
    .accordion_content{

    }
</style>
<form action="<?php echo $view['router']->generate('BoomBackBundle_boom_create') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >

    <fieldset>
        <label>Crear Boom</label>
        <?php echo $view['form']->row($form['title'], array('label' => 'Título')) ?>
        <?php echo $view['form']->row($form['summary'], array('label' => 'Resumen')) ?>
        <?php echo $view['form']->row($form['image'], array('label' => 'Imagen')) ?>
    </fieldset>

    <fieldset id="<?php echo $form['elements']->get('id') ?>" class="sort-elements">
        <label>Boomies</label>
        <?php
        foreach ($form['elements'] as $element):
            ?>
            <fieldset id="<?php echo $element->get('id') ?>">
                <label>
                    <strong><?php echo "B{$element['position']->vars['value']}"; ?></strong>
                    <span><?php echo $element['title']->vars['value'] ?><span>
                            </label>
                            <fieldset class="accordion_content">
                                <?php
                                echo $view['form']->widget(
                                        $element['position'], array(
                                    'attr' => array(
                                        'class' => 'boomie_position_input'
                                    )
                                        )
                                );
                                echo $view['form']->row(
                                        $element['title'], array(
                                    'attr' => array(
                                        'class' => 'boomie_title_input'
                                    )
                                        )
                                );

                                echo $view['form']->rest($element);
                                ?>
                            </fieldset>
                            </fieldset>
                        <?php endforeach; ?>

                        </fieldset>
                        <fieldset>
                            <section>
                                <div>
                                    <button class="submit" type="submit" >Guardar</button>
                                </div>
                            </section>
                        </fieldset>

                        </form>

                        <ul class="record_actions">
                            <li>
                                <a href="{{ path('boom') }}">
                                    Back to the list
                                </a>
                            </li>
                        </ul>
                        <script type="text/javascript">
                            (function(document,$){
                                $(document).ready(function(){

                                    var elements = $( "#boom_bundle_librarybundle_boomtype_elements",document );

                                    elements.children('fieldset').each(function(){
                                        var _this = $(this);
                                        var title = _this.find('> label > span');

                                        _this
                                        .find('input.boomie_title_input')
                                        .eq(0)
                                        .keyup(function(){

                                            title.text($(this).val());
                                        });
                                    });


                                    elements.sortable({
                                        axis: "y",
                                        handle: "label",
                                        items: "> fieldset",
                                        update: function( event, ui ) {
                                            // IE doesn't register the blur when sorting
                                            // so trigger focusout handlers to remove .ui-state-focus
                                            var position = 1;
                                            $(this)
                                            .children('fieldset')
                                            .each(function(){
                                                $(this)
                                                .find('input.boomie_position_input').first()
                                                .val(position);

                                                $(this).find('> label > strong').first()
                                                .text("B"+position)
                                                position++
                                            });
                                            //ui.item.children( "h3" ).triggerHandler( "focusout" );
                                        }
                                    })
                                    .disableSelection()
                                    .find('> fieldset > label')
                                    .click(function(){
                                        $(this).next().toggle();
                                    })
                                    .next()
                                    .toggle();
                                });
                            })(document,jQuery);
                        </script>