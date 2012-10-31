<?php
if (!isset($list)) {
    $list = array();
}
?>
<div class="boomer top-semanal">
    <h3 class="title-flag"><span><?php echo $view->escape($title); ?></span></h3>
    <ul>
        <?php
        $position = 1;
        foreach ($list as $element):
            $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'], 158, 90) : 'http://placekitten.com/120/75';
            ?>
            <li class="boom">
                <span class="place"><?php echo $position ?></span>
                <a href="<?php echo $element['url'] ?>"><img src="<?php echo $image ?>"></a>
                <div class="boom-info">
                    <?php if ($element['boom'] !== null): ?>
                        <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                    <?php endif; ?>
                    <p class="boom-ti"><a href="<?php echo $element['url'] ?>"><?php echo $view->escape($element['title']) ?></a></p>
                    <?php if ($element['boom'] !== null): ?>
                        <?php
                        $userUrl = $view['router']->generate(
                        'BoomFrontBundle_user_profile', array('username' => $element['boom']['user']['username'])
                        );
                        ?>
                        <a href="<?php echo $userUrl ?>" class="boom-moar">Por <?php echo $view->escape($element['boom']['user']['name']) ?></a>
                        <date><?php echo $view->escape($view['boom_front']->getLocaleFormatDate($element['boom']['datepublished'], 'EEE, d MMM, yyyy' )) ?></date>
    <?php endif; ?>
                </div>
            </li>
            <?php
            $position++;
        endforeach;
        ?>
    </ul>
</div>
