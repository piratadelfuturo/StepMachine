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
            $image = isset($element['image']['path']) ? $element['image']['path'] : 'http://placekitten.com/120/75';
            ?>
            <li class="boom">
                <span class="place"><?php echo $position ?></span>
                <img src="<?php echo $image ?>">
                <div class="boom-info">
                    <?php if ($element['boom'] !== null): ?>
                        <span class="sm-flag <?php echo $element['category']['slug'] ?>">,<?php echo $view->escape($element['category']['name']) ?></span>
                    <?php endif; ?>
                    <p class="boom-ti"><?php echo $view->escape($element['title']) ?></p>
                    <?php if ($element['boom'] !== null): ?>
                        <a href="<?php ?>" class="boom-moar">Por <?php echo $view->escape($element['boom']['user']['username']) ?></a>
                        <date><?php echo $element['boom']['publish_date']->format('D, d M y'); ?></date>
                    <?php endif; ?>
                </div>
            </li>
            <?php
            $position++;
        endforeach;
        ?>
    </ul>
</div>