(function(document,$){
    var accordionCount = 0;

    $(document).ready(function(){

        var elements = $( "#boom_bundle_backbundle_listgrouptype_list_elements",document );
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

        accordionCount = elements.children().length;

        var search = $('#column-search-boom',document);
        var add     = $('#column-search-boom-add',document);
        var resultContainer = $('#column-search-boom-results',document);
        search.keypress(function(event){
            if (event.which == 13) {
                event.preventDefault();
                resultContainer.empty().addClass('loading');
                $.ajax(
                {
                    url: Routing.generate('BoomBackBundle_boom_ajaxsearch'),
                    type: 'GET',
                    data: {
                        q: search.val()
                    },
                    dataType: 'json',
                    success: function(data){
                        resultContainer.removeClass('loading');
                        if(data.length > 0){
                            for(i=0;i<=data.length-1;i++){
                                var container = createDisplayNode(data[i],elements,createAccordionNode);
                                resultContainer.append(container);
                            }
                        }
                    }
                });
                return false;
            }

        })

        var createDisplayNode = function(data,sortable,addCallback){
            var container = $(document.createElement('div'));
            var title = $(document.createElement('strong'));
            var category = $(document.createElement('strong'));
            var add = $(document.createElement('a'));
            container.data('boom',data).addClass('alert').addClass('i_arrow_left');
            container.append(title,document.createElement('br'),category);
            title.text(data.title);
            category.text(data.category_name);
            container.click(function(event){
                addCallback(data,sortable,accordionCount++);
                return false;
            })
            return container;
        }

        var createAccordionNode = function(data,sortable,number){
            var newElement = $(document.createElement('fieldset'));
            var container  = $(document.createElement('fieldset'));
            var prototype = $(sortable).attr('data-prototype');
            var transferElement = $(prototype.replace(/__name__/g, number));
            var label = $(document.createElement('label'));


            container.append(transferElement.children());
            label.text(number);
            newElement
            .append(
                label,
                container
                )
            .attr('id',transferElement.attr('id'));
            sortable.append(newElement);

            label.click(function(){
                $(this).next().toggle();
            })
            .next().toggle();
            transferElement.remove();

            var urlVal;
            if(data.slug){
                urlVal = Routing.generate(
                    'BoomFrontBundle_boom_show',
                    {
                        category_slug:data.category_slug,
                        slug:data.slug
                    },true
                    );
            }
            var iTitle      = container.find('input[id$="title"]',0).val(data.title||'');
            var iSummary    = container.find('input[id$="summary"]',0).val(data.summery||'');
            var iUrl        = container.find('input[id$="url"]',0).val(urlVal||'');
            var iBoom       = container.find('input[id$="boom"]',0).val(data.id||'');
            var iCategory   = container.find('input[id$="category"]',0).val(data.category_id||'');
            var iImage      = container.find('input[id$="image"]',0).val(data.image_id||'');
            var iPosition   = container.find('input[id$="position"]',0).val(sortable.children().length);

            return false;
        }

        add.click(function(e){
            e.preventDefault();
            createAccordionNode({},elements,accordionCount++);
            return false;
        })
    });

})(document,jQuery);
