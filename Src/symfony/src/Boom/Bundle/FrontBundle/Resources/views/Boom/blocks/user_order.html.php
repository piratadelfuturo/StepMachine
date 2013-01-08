<?php
$elements = array();
$elementCounter = 1;
foreach ($entity['elements'] as $el) {
    $position = $el['communityposition'] == 0 || $el['communityposition'] === null ? $elementCounter : $el['communityposition'];
    while(isset($elements[$position])){
        $position++;
    }
    $elements[$position] = $el;
    $elementCounter++;
}
$userElements = array();
$isOwner = false;
$replyEntity = null;
$isEditable = false;
$userOrderUrl = null;
if ($view['security']->isGranted('ROLE_USER') == true) {
    if ($entity['user']['id'] == $app->getUser()->getId()) {
        $isOwner = true;
    }
    $replyEntity = $view['boom_front']->getUserBoomReply($app->getUser(), $entity);
    $isEditable = true;
    if ($replyEntity === null) {
        $isEditable = false;
        $replyEntity = $view['boom_front']->getUserBoomOrder($app->getUser(), $entity);
    }
    $userOrderUrl = $view['router']->generate(
                'BoomFrontBundle_boom_show',
            array(
                'category_slug' => $entity['category']['slug'],
                'slug' => $entity['slug'],
                'username' => $app->getUser()->getUsername()
            ),true
            );
}
?>
<div id="usr-booms" class="hook">
    <div class="shade">shade</div>
    <div class="botones">
        <a href="#" class="on" id="tendencia">7boom dice</a>
        <?php if (!$isOwner): ?>
            <span class="divider">divider</span>
            <a href="#" id="miboom">Mi Boom</a>
            <span class="arrow">Recomendados</span>
        <?php endif; ?>
    </div>
    <div class="big-container cf">
        <div class="dyna-content tend-cont on">
            <h3>Esto es lo que nuestros usuarios dicen: ¿estás de acuerdo? ¡Reordénalo!</h3>
            <ul class="drag-booms">
                <?php
                $comunityPosition = 1;
                foreach ($elements as $elementposition => $element):
                    $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'], 72, 72) : '/bundles/boomfront/images/placeholder.jpg';
                    ?>
                    <li original-position="<?php echo $view->escape($element['position']) ?>">
                        <div class="balloon">
                            <p>arrastrar</p>
                        </div>
                        <p class="pos"><span><?php echo $view->escape($comunityPosition++) ?></span></p>
                        <img src="<?php echo $image ?>">
                        <h4 class="boom-info">
                            <span><?php echo $view->escape($element['title']) ?></span>
                        </h4>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php echo $view['router']->generate('BoomFrontBundle_boom_reorder', array('slug' => $entity['slug'], '_format' => 'json')); ?>" class="editalo send disabled" >Guardar</a>
        </div>
        <?php if (!$isOwner): ?>
            <div class="dyna-content miboom-cont">
                <h3>Tú dices</h3>
                <ul class="drag-booms">
                    <?php
                    $replyMessage = true;
                    if ($replyEntity !== null && !empty($replyEntity)):
                        $replyMessage = false;
                        $myBoomPos = 1;
                        foreach ($replyEntity['elements'] as $element):
                            $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'], 72, 72) : 'http://placekitten.com/72/72';
                            ?>
                            <li original-position="<?php echo $view->escape($element['position']) ?>">
                                <div class="balloon">
                                    <p>arrastrar</p>
                                </div>

                                <p class="pos"><span><?php echo $myBoomPos++; ?></span></p>
                                <img src="<?php echo $image ?>" height="72px" width="72px">
                                <h4 class="boom-info">
                                    <span><?php echo $element['title'] ?></span>
                                </h4>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
                <div class="boom-clean <?php echo $replyMessage ? '' : 'hidden' ?>">
                    <p>Aún no has editado <span>este boom.</span> Arrastra íconos, modifícalo, opina para que éste sea <span>tu boom.</span></p>
                </div>
                <?php
                    if($replyMessage == true || $isEditable == false){
                        $replyUrl = 'BoomFrontBundle_boom_reply';
                        $entityUrl = $entity['slug'];
                    }else{
                        $replyUrl = 'BoomFrontBundle_boom_edit';
                        $entityUrl = $replyEntity['slug'];
                    }
                ?>
                <a href="<?php echo $view['router']->generate($replyUrl, array('slug' => $entityUrl)); ?>" class="editalo send">¡Edítalo!</a>
                <a href="#" class="editalo reordenalo">¡Reordénalo!</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="info-blocks">
        <div class="share-boom">
            <h3>¿Quieres compartir tu Boom?</h3>
            <form>
                <input type="hidden" for="share_url" value="<?php echo $userOrderUrl !== null ? $userOrderUrl : '' ?>" />
                <input type="checkbox" class="select twitter" /><label for="twitter"><span>twitter</span></label>
                <input type="checkbox" class="select facebook" /><label for="facebook"><span>facebook</span></label>
            </form>
            <a href="#" class="grey-btn">Compartir</a>
            <a href="#" class="close-share">&#10005;</a>
        </div>
        <div class="sign-in">
            <h3>¡Alto ahí!</h3>
            <p>Nos encantó cómo quedó tu boom, pero para guardarlo, compartir y usar todos nuestros ósom features, debes registrarte primero.</p>
            <a href="#" class="fb-reg">Regístrate con Facebook</a>
            <a href="#" class="close-share">&#10005;</a>
        </div>
    </div>
</div>
