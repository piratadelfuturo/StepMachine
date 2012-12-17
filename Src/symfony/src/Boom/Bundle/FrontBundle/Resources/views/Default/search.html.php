<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->start('top_two_col');
?>
<script>
    function hndlr(response) {
        if(response.items){
            var container = $("#booms-container");
            $.each(response.items,function(i){
                
            });
            .show();
        }
    }
</script>
<script src="<?php echo $url ?>?key=<?php echo $key ?>&cx=<?php echo $cx ?>&q=<?php echo urlencode($query) ?>&callback=hndlr">
</script>
<div id="booms-container" style="display:none">
    <h3 class="title-flag"></h3>
    <ul class="list cf">
        <li class="boom on">
            <img src="/content/boom-img/ee726227/158_90.jpeg" width="158px" height="90px">
            <div class="boom-info">
                <span class="sm-flag"></span>
                <p class="boom-ti">
                    <a href="/musica/los-mejores-discos-de-2012" class="boom-moar"></a>
                    <span></span>
                </p>
            </div>
        </li>
    </ul>
</div>