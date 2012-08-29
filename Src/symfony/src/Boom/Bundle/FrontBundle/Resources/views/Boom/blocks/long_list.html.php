<?php
$categoryName = $categorySlug = null;
if (isset($category) && $category !== null) {
    $categorySlug = $category['slug'];
    $categoryName = $category['name'];
}
if (!isset($list)) {
    $list = array();
}
?>
<div class="boomer ultimos">
    <h3 class="title-flag"><span>ultimos</span></h3>
    <ul class="list">
        <?php
        foreach ($list as $element):
            if ($categorySlug === null):
                $categorySlug = $element['maincategory']['slug'];
                $categoryName = $element['maincategory']['name'];
            endif;
            $elementUrl = $view['router']->generate(
                    'BoomFrontBundle_slug_show', array(
                'slug' => $categorySlug . '/' . $element['slug']
                    )
            );
            ?>
            <li class="boom">
                <img src="<?php echo $element['image']['path'] ?>" width="158px" height="90px" >
                <div class="boom-info">
                    <span class="sm-flag <?php echo $categorySlug ?>"><?php echo $view->escape($categoryName) ?></span>
                    <p class="boom-ti">
                        <a href="<?php echo $elementUrl ?>" class="boom-moar">
                            <?php echo $view->escape($element['title']); ?>
                        </a>
                    </p>
                    <a href="<?php echo $elementUrl ?>" class="boom-moar">
                        <?php
                        echo $view->escape(
                                !empty($element['user']['nickname']) || $element['user']['nickname'] == null ? $element['user']['username'] : $element['user']['nickname']
                        )
                        ?>
                    </a>
                    <date><?php echo $view->escape($element['datecreated']->format('D, d M y')) ?></date>
                </div>
            </li>
        <?php endforeach; ?>
        <a href="<?php echo $more_url ?>"><span class="moar">ver más</span></a>
    </ul>
</div>