<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<ul class="image-gallery">
    <?php foreach ($result as $image): ?>
        <?php //var_dump($image); ?>
        <li class="image-gallery-element" >
            <div class="image">
                <img src="<?php echo $view->escape($image[0]['path']) ?>" width="80px" height="80px"/>
            </div>
            <ul class="details">
                <li>
                    <strong>
                        Título:
                    </strong>
                    <span>
                        <?php echo $view->escape($image[0]['title']) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Descripción:
                    </strong>
                    <span>
                        <?php echo $view->escape($image[0]['description']) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Fecha:
                    </strong>
                    <span>
                        <?php echo $image[0]['date_created']->format(\DateTime::RFC822) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Original:
                    </strong>
                    <span>
                        <?php echo $view->escape($image[0]['url']) ?>
                    </span>
                </li>
                <li>
                    <strong>
                        Usuario:
                    </strong>
                    <span>
                        <a href="<?php ?>">
                            <?php echo $view->escape($image['username']) ?>
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
    <?php endforeach; ?>
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
        border: 1px solid #000;
        overflow:hidden;
        height: 80px;
        width:80px;
        margin: 3px auto;
    }
    .image-gallery .image-gallery-element ul{
        list-style-type: none;
    }
</style>