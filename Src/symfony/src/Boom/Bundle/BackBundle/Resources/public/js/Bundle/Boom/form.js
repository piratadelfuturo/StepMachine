(function(document,$){
    $(document).ready(function(){
        var textareas = $('form#boom_bundle_backbundle_boomtype #boom_bundle_backbundle_boomtype_elements textarea');
        tinyMCE.init({
            theme : "advanced",
            mode : "specific_textareas",
            editor_selector : "boom-wysiwyg",
            width: "100%",
            plugins : "bbcode,autoresize,boom",
            theme_advanced_buttons1 : "bold,italic,underline,undo,redo,forecolor,styleselect,removeformat,cleanup,boom_image",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            valid_elements: "strong/b,i/em,u,blockquote/quote,"+
                            "img[!src|alt|title|width|height|!insert-id],"+
                            "a[!href|!target:_blank],"+
                            "div[!class<gallery|!insert-id|!insert-type],"+
                            "ul,ol,li,table,tr,td,th,thead,tbody",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_resizing : true,
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

(function(document,$){
    $(document).ready(function(){

        var elements = $( "#boom_bundle_backbundle_boomtype_elements",document );
        elements.children('.widget').each(function(){
            var _this = $(this);
            var title = _this.find('> .handle > span');
            _this
            .find('input.boomie-title-input')
            .eq(0)
            .keyup(function(){
                title.text($(this).val());
            });
            _this
            .find('> .handle > .collapse')
            .click(function(){
                $(this).parent().next().toggle();
                _this.toggleClass('collapsed',0);
            });
        });

        elements.sortable({
            axis: "y",
            handle: ".handle",
            items: "> .widget",
            update: function( event, ui ) {
                var position = 1;
                $(this)
                .children('.widget')
                .each(function(){
                    $(this)
                    .find('input.boomie-position-input').first()
                    .val(position);

                    $(this).find('> .handle > strong').first()
                    .text("B"+position)
                    position++
                });
            },
            start: function(e, ui){
                console.log(this);
                $(this).find('.boom-wysiwyg').each(function(){
                    tinyMCE.execCommand( 'mceRemoveControl', false, $(this).attr('id') );
                    $(this).attr('readonly','readonly');
                });
            },
            stop: function(e,ui) {
                console.log(this);
                $(this).find('.boom-wysiwyg').each(function(){
                    $(this).removeAttr('readonly');
                    tinyMCE.execCommand( 'mceAddControl', true, $(this).attr('id') );
                    $(this).sortable("refresh");
                });
            }
        })
        .disableSelection();

    });

})(document,jQuery);

(function(document,$){
    $(document).ready(function(){
        $('#boom_image_file').fileupload({
        dataType: 'json',
        url: Routing.generate('BoomBackBundle_image_ajax_create',{ _format: 'json'}),
        done: function (e, data) {
            if(data.result.id){
                $('#boom_image_id').val(data.result.id)
                console.log(this);
            }
        }
    });

    });
})(document,jQuery);