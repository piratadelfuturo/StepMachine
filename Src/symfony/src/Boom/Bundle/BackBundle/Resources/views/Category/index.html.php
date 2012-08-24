<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>Categories</h1>
    <table id="boomTable" class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Título</th>
                <th>Posición</th>
                <th>Principal</th>
                <th>Booms total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    (function(document,$){

        var ed = $(document.createElement('a'))
        .attr('title','Editar')
        .addClass('btn i_pencil small nt');

        var del = $(document.createElement('a'))
        .attr('title','Borrar')
        .addClass('btn i_trashcan small nt');

        var view = $(document.createElement('a'))
        .attr('title','Ver')
        .addClass('btn i_list_images small nt');

        $(document).ready(function() {
            $('#boomTable.datatable').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "bDeferRender": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart": 0,
                "iDisplayLength": 10,
                "sAjaxSource": Routing.generate('BoomBackBundle_category_index', {  _format: 'json'}),
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    {     // fifth column (Edit link)
                        "sName": "actionId",
                        "bSearchable": false,
                        "bSortable": false,
                        "fnCreatedCell": function (nTd,val)
                        {
                            var edB = ed.clone();
                            var delB = del.clone();
                            var viewB = view.clone();

                            edB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_category_edit', { id: val })
                            );
                            delB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_category_delete', { id: val })
                            );
                            viewB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_category_show', { id: val })
                            );

                            $(nTd).empty().append(viewB,edB,delB);
                        }
                    }
                ]
            } );
        } );
    })(document,jQuery);
</script>