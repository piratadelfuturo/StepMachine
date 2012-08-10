(function(document,$){
    $(document).ready(function(){

        var elements = $( "#boom_bundle_librarybundle_boomtype_elements",document );

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
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
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
(function(document,$){
    $(document).ready(function(){
        //$('.image-uploader').imageManager();
        });
})(document,jQuery);