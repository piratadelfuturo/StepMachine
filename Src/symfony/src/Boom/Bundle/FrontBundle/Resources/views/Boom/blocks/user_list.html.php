<ul class="list cf">
    <?php foreach ($list as $element): ?>
        <li class="boom on">
            <?php
            $image =  isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],158,90) : 'http://placekitten.com/158/90';

            ?>
            <img src="<?php echo $image ?>" width="158px" height="90px">
            <div class="boom-info usr-bm-list">
                <span class="sm-flag <?php echo $view->escape($element['category']['slug']) ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                <p class="boom-ti">
                    <?php
                    $elementUrl = $view['router']->generate(
                            'BoomFrontBundle_boom_show', array(
                        'category_slug' => $element['category']['slug'],
                        'slug' => $element['slug']
                            )
                    );
                    $editUrl = $view['router']->generate(
                      'BoomFrontBundle_boom_edit', array(
                        'category_slug' => $element['category']['slug'],
                        'slug' => $element['slug']
                      )
                    );
                    ?>
                    <a href="<?php echo $elementUrl ?>"><?php echo $view->escape($element['title']) ?></a>
                </p>
                <a href="<?php echo $elementUrl ?>" class="boom-moar">Leer Boom</a>
                <?php if($view['security']->isGranted('ROLE_USER') == true && $app->getUser()->getId() == $element['user']['id']):?>
                <a href="<?php echo $editUrl ?>" class="boom-moar">Editar Boom</a>
                <?php endif; ?>
            </div>
            <p class="boom-info-mas">Publicado el <date><?php echo $view->escape($view['boom_front']->getLocaleFormatDate($element['datepublished'], 'EEE, d MMM, yyyy' )) ?></date> - <span><?php echo count($element['children']) ?></span> modificaciones</p>
    </li>
<?php endforeach; ?>
</ul>
