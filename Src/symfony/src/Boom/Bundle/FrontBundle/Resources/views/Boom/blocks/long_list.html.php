<?php
if (!isset($list)) {
    $list = array();
}
?>
<div class="boomer ultimos">
    <h3 class="title-flag"><span>ultimos</span></h3>
    <ul class="list cf">
        <?php
        foreach ($list as $element):
            $elementUrl = $view['router']->generate(
                    'BoomFrontBundle_boom_show', array(
                'category_slug' => $element['category']['slug'], 'slug' => $element['slug']
                    )
            );
            $userUrl = $view['router']->generate(
                    'BoomFrontBundle_user_profile',
                    array('username' => $element['user']['username'])
                    );

            $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'], 158, 90) : 'http://placekitten.com/120/75';
            ?>
            <li class="boom">
                <a href="<?php echo $elementUrl ?>"><img src="<?php echo $image ?>" width="158px" height="90px" ></a>
                <div class="boom-info">
                    <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                    <p class="boom-ti">
                        <a href="<?php echo $elementUrl ?>" class="boom-moar">
                            <?php echo $view->escape($element['title']); ?>
                        </a>
                    </p>
                    <a href="<?php echo $userUrl ?>" class="boom-moar">
                        <?php echo $view->escape($element['user']['firstname'].' '.$element['user']['lastname']) ?>
                    </a>
                    <date><?php echo $view->escape($element['datecreated']->format('D, d M y')) ?></date>
                </div>
            </li>
        <?php endforeach; ?>
        <li><a href="<?php echo $more_url ?>" class="moar">ver más</a></li>
    </ul>
</div>
