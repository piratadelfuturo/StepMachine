<ul class="list cf">
    <?php foreach ($list as $element): ?>
        <li class="boom on">
            <img src="http://escenaelectoral.dev/content/boom-img/1c0b5f95/158_90.jpeg" width="158px" height="90px">
            <div class="boom-info">
                <span class="sm-flag <?php echo $view->escape($element['category']['slug']) ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                <p class="boom-ti">
                    <?php
                    $elementUrl = $view['router']->generate(
                            'BoomFrontBundle_boom_show', array(
                        'category_slug' => $element['category']['slug'],
                        'slug' => $element['slug']
                            )
                    );
                    ?>
                    <a href="<?php echo $elementUrl ?>" class="boom-moar"><?php echo $view->escape($element['title']) ?></a>
                </p>
                <a href="<?php echo $elementUrl ?>" class="boom-moar">Leer Boom</a>
            </div>
            <p class="boom-info-mas">Publicado el <date><?php echo $element['datecreated']->format('D, d M y') ?></date> - <span><?php echo count($element['children']) ?></span> modificaciones</p>
    </li>
<?php endforeach; ?>
</ul>