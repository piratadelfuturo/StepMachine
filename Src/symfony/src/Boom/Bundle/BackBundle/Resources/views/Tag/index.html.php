<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div class="g12">
    <h1>Tags</h1>
    <table id="boomTable" class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    (function(document,$){

        $(document).ready(function() {
            $('#boomTable.datatable').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "bDeferRender": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart": 0,
                "iDisplayLength": 10,
                "sAjaxSource": Routing.generate('BoomBackBundle_tag_index', {  _format: 'json'}),
                "aoColumns": [
                    null,
                    null,
                    null
                ]
            } );
        } );
    })(document,jQuery);
</script>