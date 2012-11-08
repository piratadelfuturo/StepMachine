(function(document,$){
    var accordionCount = 0;

    $(document).ready(function(){

        var renumberElements = function(root){
                var position = 1;
                $(root)
                .children('fieldset')
                .each(function(){
                    var pos = $(this)
                    .find('input[id$=_position]').eq(0);
                    pos.val(position);

                    $(this).find('> h3 > span').eq(0)
                    .text(position)
                    position++
                });

        }

        var elements = $( "#boom_bundle_backbundle_listgrouptype_list_elements",document );
        elements.children().each(function(){
            var _this = $(this);
            _this.on("click",".widget .handle .remove",function(e){
                e.preventDefault();
                _this.remove();
                renumberElements(_this);
                return false;
            })
        })

        elements.sortable({
            axis: "y",
            handle: ".handle",
            items: "> fieldset",
            update: function( event, ui ) {
                renumberElements(elements)
            }
        })
        .disableSelection()
        .find('> fieldset > .handle')
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
            container.data('boom',data).addClass('alert').addClass('i_plus');
            container.append(title,document.createElement('br'),category);
            title.text(data.title);
            category.text(data.category_name);
            container.click(function(event){
                event.preventDefault();
                addCallback(data,sortable,accordionCount++);
                return false;
            })
            return container;
        }

        var createAccordionNode = function(data,sortable,number){
            var prototype = $(sortable).attr('data-prototype');
            var transferElement = $(prototype.replace(/__name__/g, number));
            var container  = transferElement.find('> fieldset',0);
            var handle = transferElement.find('> .handle',0);

            sortable.append(transferElement);

            handle.click(function(){
                $(this).next().toggle();
            })
            .next().toggle();

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
            var iSummary    = container.find('input[id$="summary"]',0).val(data.summary||'');
            var iUrl        = container.find('input[id$="url"]',0).val(urlVal||'');
            var iBoom       = container.find('input[id$="boom"]',0).val(data.id||'');
            var iCategory   = container.find('input[id$="category"]',0).val(data.category_id||'');
            var iImageId    = container.find('input[id$="image_id"]',0).val(data.image_id||'');
            var iImageFile  = container.find('input[id$="image_file"]',0).val('');
            var iImageImg   = container.find('img[id$="image_img"]',0).attr('src',data.image_path);
            var iPosition   = container.find('input[id$="position"]',0).val(sortable.children().length+1);

            $(iImageFile).boomAjaxUpload({
                url: Routing.generate(
                    'BoomBackBundle_image_ajax_create',
                    {
                        _format: 'json',
                        path: iImageFile.attr('name'),
                        w: 158,
                        h: 90
                    }),
                done:function(e, data){
                    if(data.result.id){
                        iImageImg.attr('src',data.result.path);
                    }
                }

            });

            return false;
        }

        add.click(function(e){
            e.preventDefault();
            createAccordionNode({},elements,accordionCount++);
            return false;
        })
    });

})(document,jQuery);
