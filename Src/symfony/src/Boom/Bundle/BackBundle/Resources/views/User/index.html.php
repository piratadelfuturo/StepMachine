<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>Usuarios</h1>
    <table id="boomTable" class="datatable">
        <thead>
            <tr>
                <th style="width:40px">ID</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>E-mail</th>
                <th>Admin</th>
                <th>Colaborador</th>
                <th style="width:100px">Acciones</th>
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
                "sAjaxSource": Routing.generate('BoomBackBundle_user_index', {  _format: 'json'}),
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
                    null,
                    {     // fifth column (Edit link)
                        "sName": "roles",
                        "bSearchable": true,
                        "bSortable": false,
                        "fnCreatedCell": function (nTd,val)
                        {
                            var role;
                            if(val.indexOf('ROLE_ADMIN') == -1){
                                role = 'false';
                            }else{
                                role = 'true';
                            }

                            $(nTd).empty().text(role);
                        }
                    },
                    null,
                    {     // fifth column (Edit link)
                        "sName": "action_id",
                        "bSearchable": false,
                        "bSortable": false,
                        "fnCreatedCell": function (nTd,val)
                        {
                            var prevB = prev.clone();
                            var edB = ed.clone();
                            var viewB = view.clone();

                            prevB.click(function(){
                                alert("hello");
                            });
                            edB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_user_edit', { id: val })
                            );
                            viewB.attr(
                            'href',
                                Routing.generate('BoomBackBundle_user_show', { id: val })
                            );

                            $(nTd).empty().append(edB);
                        }
                    }
                ]
            } );
        } );
    })(document,jQuery);
</script>