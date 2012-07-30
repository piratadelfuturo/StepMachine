<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>DataTable</h1>

    <table id="boomTable" class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Date created</th>
                <th>NSFW</th>
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

        var prev = $(document.createElement('a'))
        .attr('title','Preview')
        .addClass('btn i_magnifying_glass small nt');

        $(document).ready(function() {
            $('#boomTable.datatable').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "bDeferRender": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart": 0,
                "iDisplayLength": 10,
                "sAjaxSource": '<?php echo $view['router']->generate('BoomBackBundle_boom_index', array('_format' => 'json')) ?>',
                "aoColumns": [
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
                            var prevB = prev.clone();
                            var edB = ed.clone();
                            var delB = del.clone();
                            var viewB = view.clone();

                            prevB.click(function(){
                                alert("hello");
                            });
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

                            $(nTd).empty().append(prevB,viewB,edB,delB);
                        }
                    }
                ]
            } );
        } );
    })(document,jQuery);
</script>