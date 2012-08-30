<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>Widgets</h1>
    <table id="boomTable" class="datatable">
        <thead>
            <tr>
                <th rowspan="2" >ID</th>
                <th rowspan="2" >Nombre</th>
                <th colspan="2" >Grupo</th>
                <th style="width:160px" rowspan="2" >Acciones</th>
            </tr>
            <tr>
                <th>Bloque</th>
                <th>Posición</th>
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

        var prev = $(document.createElement('a'))
        .attr('title','Preview')
        .addClass('btn i_magnifying_glass small nt');

        $(document).ready(function() {
            $('#boomTable.datatable').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "bDeferRender": true,
                "sPaginationType": "full_numbers",
                "aaSorting": [[0,'desc']],
                "iDisplayStart": 0,
                "iDisplayLength": 10,
                "sAjaxSource": Routing.generate('BoomBackBundle_widget_index', {  _format: 'json'}),
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
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

                            edB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_widget_edit', { id: val })
                            );
                            delB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_widget_delete', { id: val })
                            );

                            $(nTd).empty().append(edB,delB);
                        }
                    }
                ]
            } );
        } );
    })(document,jQuery);
</script>