<?php
$categories = $view['boom_front']->getFeaturedCategories();
?>
<div id="hd-mn" class="gradient">
    <h1><a href="<?php echo $view['router']->generate('BoomFrontBundle_homepage'); ?>">7Boom</a></h1>
    <div id="link-block">
        <div id="top-bar" class="gradient">
            <ul id="mini-nav">
                <li><a href="#">Especiales</a></li>
                <li><a href="#">Colaboradores</a></li>
                <li><a href="#">CREA TU <span>boom</span></a></li>
            </ul>
            <div id="tb-rb">
                <form>
                    <input type="submit" name="sbm-src" value="Buscar"  />
                    <input type="text" name="src-box"/>
                </form>
            </div>
        </div>
        <nav class="gradient">
            <?php foreach ($categories as $el): ?>
                <a href="<?php echo $view['router']->generate('BoomFrontBundle_category_index', array('slug' => $el['a_slug'])) ?>"><?php echo $view->escape($el['a_name']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</div>
