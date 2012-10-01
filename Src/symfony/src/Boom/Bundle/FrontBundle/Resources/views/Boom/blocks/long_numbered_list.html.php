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
            $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],158,90) : 'http://placekitten.com/120/75';
            ?>
            <li class="boom">
                <span class="place"><?php echo $position ?></span>
                <a href="<?php echo $element['url']?>"><img src="<?php echo $image ?>"></a>
                <div class="boom-info">
                    <?php if ($element['boom'] !== null): ?>
                        <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                    <?php endif; ?>
                    <a href="<?php echo $element['url']?>"><p class="boom-ti"><?php echo $view->escape($element['title']) ?></p></a>
                    <?php if ($element['boom'] !== null): ?>
                        <a href="<?php ?>" class="boom-moar">Por <?php echo $view->escape($element['boom']['user']['username']) ?></a>
                        <date><?php echo $element['boom']['datepublished']->format('D, d M y'); ?></date>
                    <?php endif; ?>
                </div>
            </li>
            <?php
            $position++;
        endforeach;
        ?>
    </ul>
</div>
