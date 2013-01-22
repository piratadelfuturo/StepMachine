(function(document,$){
    $(document).ready(function(){
        //var textareas = $('form#boom_bundle_backbundle_boomtype #boom_bundle_backbundle_boomtype_elements textarea');
        tinyMCE.init({
            theme : "advanced",
            mode : "specific_textareas",
            editor_selector : "boom-wysiwyg",
            width: "100%",
            plugins : "autoresize,boom,paste",
            theme_advanced_buttons1 : "boom_link,boom_image,boom_video,boom_gallery,bold,italic,undo,redo,forecolor,styleselect,removeformat,cleanup",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            invalid_elements: "span",
            valid_elements: "br,strong/b,i/em,blockquote/quote,"+
            "img[!src|alt|title|width|height|!insert-id],"+
            "a[*],p"+
            "div[!class<gallery|!insert-id],"+
            "ul,ol,li,table,tr,td,th,thead,tbody,iframe[*]",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_resizing : true,
            object_resizing : false,
            relative_urls : false,
            remove_script_host : false,
            add_unload_trigger : false,
            inline_styles : false,
            valid_children : "strong[br|em|#text],em[br|strong|#text]",
            force_br_newlines : true,
            force_p_newlines : false,
            forced_root_block : '',
            paste_use_dialog : false,
            paste_auto_cleanup_on_paste : true
        });

        var form = $('#boom'),
            submit = $('#boom-submit',form),
            preview = $('#boom-preview',form),
            entityId = window.location.href;
;

        submit.click(function(){
            form
            .attr('target','_self')
            .attr(
                'action',
                entityId)
            .submit();
        });

        preview.click(function(){
            form
            .attr('target','_blank')
            .attr(
                'action',
                Routing.generate('BoomBackBundle_boom_preview', {
                    id: preview.val()
                }))
            .submit();

        });

    });

})(document,jQuery);

(function(document,$){
    $(document).ready(function(){

        var elements = $( "#boom_elements",document );
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
                $(ui.item).find('.boom-wysiwyg').each(function(){
                    tinyMCE.execCommand( 'mceRemoveControl', false, $(this).attr('id') );
                    $(this).attr('readonly','readonly');
                });
            },
            stop: function(e,ui) {
                $(ui.item).find('.boom-wysiwyg').each(function(){
                    $(this).removeAttr('readonly');
                    tinyMCE.execCommand( 'mceAddControl', true, $(this).attr('id') );
                });
                $(this).sortable("refresh");
            }
        })
        .disableSelection();

    });

})(document,jQuery);