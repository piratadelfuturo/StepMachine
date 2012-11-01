<?php
$elements = array();
foreach ($entity['elements'] as $el) {
    $position = $el['communityposition'] == 0 ? $el['position'] : $el['communityposition'];
    $elements[$position] = $el;
}
$userElements = array();
$isOwner = false;
if ($view['security']->isGranted('ROLE_USER') == true && $entity['user']['id'] == $app->getUser()->getId()):
    $isOwner = true;
endif;
?>

<div id="usr-booms">
    <div class="shade">shade</div>
    <div class="botones">
        <a href="#" class="on" id="tendencia">Tendencias</a>
        <?php if (!$isOwner): ?>
            <span class="divider">divider</span>
            <a href="#" id="miboom">Mi Boom</a>
            <span class="arrow">Recomendados</span>
        <?php endif; ?>
    </div>
    <div class="big-container cf">
        <div class="dyna-content tend-cont on">
            <h3>Esto es lo que nuestros usuarios dicen: ¿estás de acuerdo? ¡Edítalo!</h3>
            <ul class="drag-booms">
                <?php
                foreach ($elements as $elementposition => $element):
                    $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'], 72, 72) : 'http://placekitten.com/72/72';
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
            <a href="<?php echo $view['router']->generate('BoomFrontBundle_boom_reorder', array('slug' => $entity['slug'], '_format' => 'json')); ?>" class="editalo">Guardar</a>
        </div>
        <?php if (!$isOwner): ?>
            <div class="dyna-content miboom-cont">
                <h3>Tú dices</h3>
                <?php
                $replyMessage = true;
                if ($view['security']->isGranted('ROLE_USER') == true):
                    $replyEntity = $view['boom_front']->getUserBoomReply($app->getUser(), $entity);
                    if ($replyEntity !== null && !empty($replyEntity)):
                        $replyMessage = false;
                        ?>
                        <ul class="drag-booms">
                            <?php
                            $myBoomPos = 1;
                            foreach ($replyEntity['elements'] as $element):
                                $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'], 72, 72) : 'http://placekitten.com/72/72';
                                ?>
                                <li>
                                    <p class="pos"><span><?php echo $myBoomPos++; ?></span></p>
                                    <img src="<?php echo $image ?>" height="72px" width="72px">
                                    <h4 class="boom-info">
                                        <span><?php echo $element['title'] ?></span>
                                    </h4>
                                </li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($replyMessage == true): ?>
                    <div class="boom-clean on">
                        <p>Aún no has editado <span>este boom.</span> Arrastra íconos, modifícalo, opina para que éste sea <span>tu boom.</span></p>
                        <a href="<?php echo $view['router']->generate('BoomFrontBundle_boom_reply', array('slug' => $entity['slug'])) ?>" target="_blank" class="editalo">¡Edítalo!</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
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
