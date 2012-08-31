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
<div class="boomer top-semanal">
    <h3 class="title-flag"><span><?php echo $view->escape($title); ?></span></h3>
    <ul>
    <?php
        $position = 1;
        foreach ($list as $element):
            if ($categorySlug === null):
                $categorySlug = $element['category']['slug'];
                $categoryName = $element['category']['name'];
            endif;
                $elementUrl = $view['router']->generate(
                    'BoomFrontBundle_slug_show', array(
                'slug' => $categorySlug . '/' . $element['slug']
                    )
            );

            ?>
        <li class="boom">
            <span class="place"><?php echo $position ?></span>
            <img src="http://placehold.it/158x90">
            <div class="boom-info">
                <span class="sm-flag cine">cine</span>
                <p class="boom-ti">Lorem ipsum dolor blabla bla bla</p>
                <a href="#" class="boom-moar">Por Juan Pérez.</a>
                <date>22 de enero 2011</date>
            </div>
        </li>
        <?php
        $position++;
        endforeach;
        ?>
    </ul>
</div>