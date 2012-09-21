<?php
/**
 * @var \Symfony\Component\Form\FormView $form
 */
?>
<?php $view['form']->setTheme($form, array('BoomBackBundle:Form')) ?>
<form id="<?php echo $form->getName() ?>" action="<?php echo $view['router']->generate('BoomBackBundle_widget_dailyseven_ajax_save') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
    <fieldset>
        <?php echo $view['form']->row($form['_token']) ?>
        <?php echo $view['form']->row($form['name']) ?>
        <?php
        foreach ($form['list'] as $key => $element) {
            foreach ($element as $sub_key => $sub_element) {
                echo $view['form']->row($sub_element, array('label' => $key.') '.$sub_key));
            }
        }
        ?>
        <section>
            <div>
                <button id="boom-submit" class="submit" type="submit" >Guardar</button>
            </div>
        </section>
    </fieldset>
</form>
<script type="text/javascript" >
    (function($,window){
        $("#<?php echo $form->getName() ?>").submit(function(e){
            e.preventDefault();
            _this = $(this);
            _this.slideUp();
            $.post(
            _this.attr( 'action' ),
            _this.serialize(),
            function(data){
                _this.slideDown();
            },'json');
        });
    })(jQuery,window);

</script>