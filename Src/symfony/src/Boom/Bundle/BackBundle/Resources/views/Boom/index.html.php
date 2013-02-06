<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>Booms</h1>
    <table id="boomTable" class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>URL</th>
                <th style="width:65px" >Categoría</th>
                <th style="width:100px" >Fecha</th>
                <th style="width:45px" > Estatus</th>
                <th style="width:50px" >Usuario</th>
                <th style="width:120px" >Recomendado</th>
                <th style="width:50px">Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    (function(document,$){

        function formatDate(now) {
            var then = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
            then += '@'+now.getHours()+':'+now.getMinutes();
            return then;
        }

        var ed = $(document.createElement('a'))
        .attr('title','Editar')
        .addClass('btn i_pencil small nt');

        var del = $(document.createElement('a'))
        .attr('title','Borrar')
        .addClass('btn i_trashcan small nt');

        var view = $(document.createElement('a'))
        .attr('title','Ver')
        .addClass('btn i_list_images small nt');

        var prev = $(document.createElement('a'))
        .attr('title','Preview')
        .addClass('btn i_magnifying_glass small nt');

        var feat = $(document.createElement('a'))
        .attr('title','Recomendar')
        .addClass('btn i_facebook_like icon small');

        $(document).ready(function() {
            $('#boomTable.datatable').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "bDeferRender": true,
                "sPaginationType": "full_numbers",
                "aaSorting": [[0,'desc'], [4,'desc']],
                "iDisplayStart": 0,
                "iDisplayLength": 10,
                "sAjaxSource": Routing.generate('BoomBackBundle_boom_index', {  _format: 'json'}),
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
                    {
                        "sName": "date_created",
                        "bSearchable": false,
                        "bSortable": true,
                        "fnCreatedCell": function (nTd,val)
                        {
                            $(nTd).empty().text(formatDate(new Date(val)));
                        }
                    },
                    {
                        "sName": "status",
                        "bSearchable": false,
                        "bSortable": true,
                        "fnCreatedCell": function (nTd,val)
                        {
                            /*
                                const STATUS_DRAFT = 0;
                                const STATUS_REVIEW = 1;
                                const STATUS_PUBLIC = 2;
                                const STATUS_PRIVATE = 3;
                                const STATUS_DELETE = 4;
                                const STATUS_BLOCK = 5;
                             */
                            var text = '';
                            switch(val)
                            {
                                case 0:
                                    text = 'DRAFT';
                                    break;
                                case 1:
                                    text = 'REVIEW';
                                    break;
                                case 2:
                                    text = 'PUBLIC';
                                    break;
                                case 3:
                                    text = 'PRIVATE';
                                    break;
                                case 4:
                                    text = 'DELETE';
                                    break;
                                case 5:
                                    text = 'BLOCK';
                                    break;
                                default:
                            }

                            $(nTd).empty().text(text);
                        }

                    },
                    null,
                    {     // fifth column (Edit link)
                        "sName": "featured",
                        "bSearchable": false,
                        "bSortable": true,
                        "fnCreatedCell": function (nTd,val,obj)
                        {
                            var op = false,
                            featB = feat.clone();
                            $(nTd).empty();

                            if(val != ''){
                                featB.text(formatDate(new Date(val)));
                            }else{
                                featB.text('No');
                            }
                            featB.click(function(e){
                                e.preventDefault();
                                if(op === true){
                                    return false
                                }else{
                                    op = true;
                                }
                                featB.fadeOut();
                                $.ajax({
                                    url: Routing.generate('BoomBackBundle_boom_feature',{id: obj[0]}),
                                    dataType: 'json',
                                    success: function(response){
                                        featB.text(formatDate(new Date(response)));
                                        featB.fadeIn();
                                        op = false;
                                    },
                                    error: function(){
                                        featB.fadeIn();
                                        op = false;
                                    }
                                })
                            })
                            $(nTd).append(featB);

                        }
                    },
                    {     // fifth column (Edit link)
                        "sName": "action_id",
                        "bSearchable": false,
                        "bSortable": false,
                        "fnCreatedCell": function (nTd,val)
                        {
                            var prevB = prev.clone();
                            var edB = ed.clone();
                            var delB = del.clone();
                            var viewB = view.clone();

                            prevB.attr(
                            'href',
                            Routing.generate('BoomBackBundle_boom_preview', { id: val })
                        )
                            .attr('target','_blank');
                            edB.attr(
                            'href',
                            Routing.generate('BoomBackBundle_boom_edit', { id: val })
                        );
                            delB.attr(
                            'href',
                            Routing.generate('BoomBackBundle_boom_delete', { id: val })
                        );
                            viewB.attr(
                            'href',
                            Routing.generate('BoomBackBundle_boom_show', { id: val })
                        );

                            $(nTd).empty().append(edB);
                        }
                    }
                ]
            } );
        } );
    })(document,jQuery);
</script>