<?php
$elements = array();
foreach ($entity['elements'] as $el) {
    $position = $el['communityposition'] == 0 ? $el['position'] : $el['communityposition'];
    $elements[$position] = $el;
}
$userElements = array();
//var_dump($view['boom_front']->getUserBoomOrder($app->getUser()->getId(),$entity['id']));
?>

<div id="usr-booms">
    <div class="shade">shade</div>
    <div class="botones">
        <a href="#" class="on" id="tendencia">Tendencias</a>
        <span class="divider">divider</span>
        <a href="#" id="miboom">Mi Boom</a>
        <span class="arrow">Recomendados</span>
    </div>
    <div class="big-container cf">
        <div class="dyna-content tend-cont on">
            <h3>Esto es lo que nuestros usuarios dicen: ¿estás de acuerdo? ¡Edítalo!</h3>
            <ul class="drag-booms" reorder-url="<?php echo $view['router']->generate(
                        'BoomFrontBundle_boom_reorder',
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
            <h3>Tú dices</h3>
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
            <div class="boom-clean on">
              <p>Aún no has editado <span>este boom.</span> Arrastra íconos, modifícalo, opina para que éste sea <span>tu boom.</span></p>
              <a href="#" class="editalo">¡Edítalo!</a>
            </div>
        </div>
    </div>
    <a href="#" class="editalo">Guardar</a>
    <div class="info-blocks">
      <div class="share-boom">
        <h3>¿Quieres compartir tu Boom?</h3>
        <form>
          <input type="checkbox" class="select twitter"><label for="twitter"><span>twitter</span></label>
          <input type="checkbox" class="select facebook"><label for="facebook"><span>facebook</span></label>
        </form>
       <a href="#" class="grey-btn">Compartir</a>
      </div>
      <div class="sign-in">
        <h3>¡Alto ahí!</h3>
        <p>Nos encantó cómo quedó tu boom, pero para guardarlo, compartir y usar todos nuestros ósom features, debes registrarte primero.</p>
        <a href="#" class="grey-btn">Regístrate</a>
      </div>
  </div>
</div>
