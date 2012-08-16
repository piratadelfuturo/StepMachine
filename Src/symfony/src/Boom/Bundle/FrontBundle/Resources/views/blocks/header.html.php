<?php
    $nav = array(
        array(
            'route' => 'BoomFrontBundle_category_index',
            'slug' => 'musica',
            'name' => 'Música'
            ),
        array(
            'route' => 'BoomFrontBundle_category_index',
            'slug' => 'sexo',
            'name' => 'Sexo'
            ),
        array(
            'route' => 'BoomFrontBundle_category_index',
            'slug' => 'cine',
            'name' => 'Cine'
            ),
        array(
            'route' => 'BoomFrontBundle_category_index',
            'slug' => 'tecnologia',
            'name' => 'Tecnología'
            ),
        array(
            'route' => 'BoomFrontBundle_category_index',
            'slug' => 'lucky-7',
            'name' => 'Lucky 7'
            )
    );
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
            <?php foreach($nav as $el): ?>
            <a href="<?php echo $view['router']->generate($el['route'],array('slug'=> $el['slug'])) ?>"><?php echo $view->escape($el['name']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</div>
