<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<div id="Pagination" class="pagination"></div>
<ul class="image-gallery">
    <?php /*
    foreach ($result as $image):
        ?>
        <li class="image-gallery-element" >
            <div class="image">
                <?php
                $thumb = explode('.', $image['path']);
                $ext = array_pop($thumb);
                $thumb = implode('.', $thumb);
                $thumb .= '/120_120.' . $ext;
                $thumb = $view['boom_image']->getBoomImagePath() . $thumb
                ?>
                <img src="/<?php echo $thumb ?>" />
            </div>
            <ul class="details">
                <li>
                    <strong>
                        Título:
                    </strong>
                    <span>
                        <?php echo $view->escape($image['title']) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Descripción:
                    </strong>
                    <span>
                        <?php echo $view->escape($image['description']) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Fecha:
                    </strong>
                    <span>
                        <?php echo $image['datecreated']->format(\DateTime::RFC822) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Original:
                    </strong>
                    <span>
                        <?php echo $view->escape($image['url']) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Usuario:
                    </strong>
                    <span>
                        <a href="<?php ?>">
                            <?php echo $view->escape($image['user']['username']) ?>
                        </a>
                    </span>
                </li>
            </ul>
            <ul class="actions">
                <li>
                    <a href="#" >Detalle</a>
                </li>
            </ul>
        </li>
    <?php endforeach; */?>
</ul>
<style type="text/css">
    .image-gallery{
        position:relative;
        padding:5px;
        list-style-type: none;
    }
    .image-gallery .image-gallery-element{
        position:relative;
        float:left;
        margin:5px;
        padding:5px;
    }
    .image-gallery .image-gallery-element .image{
        overflow:hidden;
        height: 120px;
        width:120px;
        margin: 3px auto;
        line-height: 120px;
        border: 1px solid #000;
        background: #CFCFCF;
        text-align: center;
    }

    .image-gallery .image-gallery-element ul{
        margin: 0px;
        padding: 0px;
        list-style-type: none;
    }

    .image-gallery .image-gallery-element .image img{
        line-height: 120px;
        margin: auto;
        vertical-align: middle;
    }

</style>
<script type="text/javascript">
(function(document,$){

    var total = null;

    var getInfo = function(page_index){
        var page_index = page_index || 0;

        $.ajax(
            Routing.generate(
                'BoomBackBundle_image_index',
                {
                    _format: 'json',
                    index: page_index,
                    limit: options.items_per_page
                }
            ),
            {
                success: function(response){
                    if(total == null){
                        total = response.total;
                        $("#Pagination").pagination(total, options);
                    }else{
                        $('.image-gallery').html(response.data[0]);
                    }
                    return true;
                }
            }
        );

        return false;
    }

    var options = {
		items_per_page:15,
		num_display_entries:10,
		current_page:0,
		num_edge_entries:0,
		link_to:"#",
		prev_text:"Prev",
		next_text:"Next",
		ellipse_text:"...",
		prev_show_always:true,
		next_show_always:true,
		callback: getInfo
	};


    // When document has loaded, initialize pagination and form
    $(document).ready(function(){
        getInfo(0);
    });
})(document,jQuery);

</script>