(function(document,$){
    $(document).ready(function(){

        var elements = $( "#boom_bundle_backbundle_boomtype_elements",document );

        elements.children('fieldset').each(function(){
            var _this = $(this);
            var title = _this.find('> label > span');
            _this
            .find('input.boomie-title-input')
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
                var position = 1;
                $(this)
                .children('fieldset')
                .each(function(){
                    $(this)
                    .find('input.boomie-position-input').first()
                    .val(position);

                    $(this).find('> label > strong').first()
                    .text("B"+position)
                    position++
                });
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

(function(document,$){
    $(document).ready(function(){
        var textareas = $('form#boom_bundle_backbundle_boomtype #boom_bundle_backbundle_boomtype_elements textarea');
        textareas.tinymce({
            script_url : '/bundles/boomback/js/lib/tiny_mce/tiny_mce.js',
            theme : "advanced",
            mode : "textareas",
            width: "100%",
            plugins : "bbcode,autoresize",
            theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            valid_elements: "strong/b,i/em,u,blockquote",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_styles : "Code=codeStyle;Quote=quoteStyle",
            //content_css : "css/bbcode.css",
            entity_encoding : "raw",
            add_unload_trigger : false,
            remove_linebreaks : false,
            inline_styles : false,
            convert_fonts_to_spans : false

        });

        $form = $('#boom_bundle_backbundle_boomtype');

        $submit = $form.find('#boom-submit');

        $preview = $form.find('#boom-preview');

        $submit.click(function(){
            $form
            .attr('target','_self')
            .attr(
                'action',
                Routing.generate('BoomBackBundle_boom_update', {
                    id: $entityId.val()
                }));
        });

        $preview.click(function(){
            $form.attr('target','_blank')
            .attr(
                'action',
                Routing.generate('BoomBackBundle_boom_preview', {
                    id: $preview.val()
                }));


        });

    });

})(document,jQuery);

