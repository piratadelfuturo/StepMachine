<ul class="list cf">
    <?php
    if(!isset($list)){
        $list = array();
    }
    foreach ($list as $element):
        $elementUrl = $view['router']->generate(
                'BoomFrontBundle_boom_show', array(
            'category_slug' => $element['category']['slug'], 'slug' => $element['slug']
                )
              );
        $userUrl = $view['router']->generate(
                'BoomFrontBundle_user_profile',array('username' => $element['user']['username']));

    $image =  isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],158,90) : 'http://placekitten.com/158/90';
    //Corta los títulos muy largos a 65 caracteres.
    $string = strip_tags( $view->escape( $element['title'] ) );

    if (strlen($string) > 95) {
        $stringCut = substr($string, 0, 95);
        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
    }
    ?>
        <li class="boom">
            <img src="<?php echo $image?>" width="158px" height="90px" >
            <div class="boom-info">
                <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                <p class="boom-ti">
                    <a href="<?php echo $elementUrl ?>" class="boom-moar">
                        <?php echo $string; ?>
                    </a>
                </p>
                <a href="<?php echo $userUrl ?>" class="boom-moar">
                    Por <?php echo $view->escape($element['user']['name']) ?>
                </a>
                <date><?php echo $view->escape($view['boom_front']->getLocaleFormatDate($element['datepublished'], 'EEE, d MMM, yyyy' )) ?></date>
            </div>
        </li>
    <?php endforeach; ?>
    <?php if (isset($more_url)): ?>
        <a href="<?php echo $more_url ?>" class="moar">ver más</a>
    <?php endif; ?>
</ul>
