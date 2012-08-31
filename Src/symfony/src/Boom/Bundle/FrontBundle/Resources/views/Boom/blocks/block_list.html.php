<?php
if (!isset($list)) {
    $list = array();
}
?>
<div class="boomer">
    <h3 class="title-flag"><span><?php echo $view->escape($title); ?></span></h3>
    <ul class="list-grid">
        <?php
        foreach ($list as $element):
            $elementUrl = $view['router']->generate(
                    'BoomFrontBundle_boom_show', array(
                'category_slug' => $element['category']['slug'],
                'slug' => $element['slug']
                    )
            );
            ?>
            <li>
                <img src="<?php echo $element['image']['path'] ?>" width="158px" height="90px" >
                <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                <p class="boom-ti">
                    <a href="<?php echo $elementUrl ?>" class="boom-moar">
                        <?php echo $view->escape($element['title']) ?>
                    </a>
                </p>
                <a href="<?php echo $elementUrl ?>" class="boom-moar">Por <?php echo $element['user']['username'] ?>.</a>
                <p><date><?php echo $element['datepublished']->format('D, d M y') ?></date></p>
            </li>
        <?php endforeach; ?>

        <a href="<?php echo $more_url ?>"><span class="moar">ver más</span></a>
    </ul>
</div>