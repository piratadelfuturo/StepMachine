<?php
$elements = array();
foreach ($entity['elements'] as $el) {
    $position = $el['communityposition'] == 0 ? $el['position'] : $el['communityposition'];
    $elements[$position] = $el;
}
?>

<div id="usr-booms">
    <div class="botones">
        <a href="#" class="on" id="tendencia">Tendencias</a>
        <span class="divider">divider</span>
        <a href="#" id="miboom">Mi Boom</a>
        <span class="arrow">Recomendados</span>
    </div>
    <div class="big-container cf">
        <div class="dyna-content tend-cont on">
            <h3>nuestros usuarios dicen</h3>
            <ul class="drag-booms" reorder-url="<?php echo $view['router']->generate(
                        'BoomFrontBundle_Boom_reorder',
                        array(
                            'slug' => $entity['slug'],
                            '_format' => 'json'
                        )
                    ); ?>">
                <?php foreach ($elements as $elementposition => $element): 
                      $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],72,72) : 'http://placekitten.com/72/72';
                        ?>
                    <li original-position="<?php echo $view->escape($element['position']) ?>">
                        <div class="balloon">
                            <p>arrastrar</p>
                        </div>
                        <p class="pos"><span><?php echo $view->escape($elementposition) ?></span></p>
                        <img src="<?php echo $image ?>">
                        <h4 class="boom-info">
                            <span><?php echo $view->escape($element['title']) ?></span>
                        </h4>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="dyna-content miboom-cont">
            <h3>Mi Boom</h3>
            <ul class="drag-booms">
                <li>
                    <div class="balloon">
                        <p>arrastrar</p>
                    </div>
                    <p class="pos"><span>1</span></p>
                    <img src="http://placehold.it/72x72">
                    <h4 class="boom-info">
                        <span>Sustituir este bloque por contenido real</span>
                    </h4>
                </li>
                <li>
                    <div class="balloon">
                        <p>arrastrar</p>
                    </div>
                    <p class="pos"><span>2</span></p>
                    <img src="http://placehold.it/72x72">
                    <h4 class="boom-info">
                        <span>Sustituir este bloque por contenido real</span>
                    </h4>
                </li>
                <li>
                    <div class="balloon">
                        <p>arrastrar</p>
                    </div>
                    <p class="pos"><span>3</span></p>
                    <img src="http://placehold.it/72x72">
                    <h4 class="boom-info">
                        <span>Sustituir este bloque por contenido real</span>
                    </h4>
                </li>

            </ul>
        </div>
    </div>
    <a href="#" id="editalo">¿Estás de acuerdo?<span>¡edítalo!</span></a>
</div>
