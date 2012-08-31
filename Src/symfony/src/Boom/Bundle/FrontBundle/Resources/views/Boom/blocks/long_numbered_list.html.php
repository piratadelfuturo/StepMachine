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
                $elementUrl = $view['router']->generate(
                    'BoomFrontBundle_boom_show', array(
                'category_slug' => $element['category']['slug'],
                        'slug' => $element['slug']
                    )
            );

            ?>
        <li class="boom">
            <span class="place"><?php echo $position ?></span>
            <img src="http://placehold.it/158x90">
            <div class="boom-info">
                <span class="sm-flag <?php echo $element['category']['slug'] ?>">,<?php echo $view->escape($element['category']['name']) ?></span>
                <p class="boom-ti"><?php echo $view->escape($element['title']) ?></p>
                <a href="#" class="boom-moar">Por <?php echo $view->escape($element['user']['username']) ?></a>
                <date><?php echo $element['user']->format('D, d M y'); ?></date>
            </div>
        </li>
        <?php
        $position++;
        endforeach;
        ?>
    </ul>
</div>