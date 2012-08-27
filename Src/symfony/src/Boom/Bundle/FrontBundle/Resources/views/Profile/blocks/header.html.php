<?php
$user = $app->getUser();
$categories = $view['boom_front']->getFeaturedCategories();
?>
<div id="usr-cnt">
    <a href="#" class="mostrar">
        <span style="display:none" >Mostrar</span>
        <span  >Ocultar</span>
    </a>
    <div id="usr-box">
        <div id="usr-bar">
            <ul id="close-tab">
                <li>
                    <?php if ($view['security']->isGranted('ROLE_USER') == true): ?>
                        Bienvenido <a href="#">
                            <?php echo $view->escape($user['username']); ?>
                        </a>
                    <?php endif; ?>
                </li>
                <li><a href="#">Fulano</a><span> ama este sitio.</span></li>
            </ul>
            <ul id="open-tab">
                <li class="on"><a href="#">Actividad</a><span>.</span></li>
                <li><a href="#">Recomendados</a><span>.</span></li>
            </ul>
        </div>
        <div id="usr-roll">
            <div id="usm-pro">
                <div class="usm-info">
                    <div class="usr-pic">
                        <img src="<?php echo $user['imagepath'] ?>" id="user-img" height="150px" width="150px"/>
                    </div>
                    <div class="usr-data">
                        <h3>¡Bienvenido...</br><span><?php echo $view->escape($user['firstname']); ?> !</span></h3>
                        <a href="#" class="ver">Ver perfil</a>
                        <a href="#" class="ver">Cambiar foto</a>
                    </div>
                </div>
                <div id="filter">
                    <form >
                        <p>Filtro por categoría:</p>
                        <ul>
                            <?php foreach ($categories as $category): ?>
                                <li class="<?php echo $category['a_slug'] ?>">
                                    <?php //echo $view['form']->widget(''); ?>
                                    <input id="cat-<?php echo $category['a_slug'] ?>" name="<?php $category['a_name'] ?>" type="checkbox" class="select" value="<?php echo $category['a_slug'] ?>" />
                                    <label><?php echo $category['a_name'] ?></label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="#" class="ver-moar">Ver todas</a>
                    </form>
                </div>
                <?php $followings = $user['following']->slice(0, 12); ?>
                <div class="boomers">
                    <?php if (count($followings) > 0): ?>
                        <p>Boomers que sigues:</p>
                        <ul>
                            <?php foreach ($followings as $following): ?>
                                <li><a href="#"><span><img src="http://placehold.it/40x40" alt="placeholder"/></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="ver-mas-block">
                            <a class="ver-moar" href="#">Ver Todos</a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <div id="rt-cont">
                <?php if($user['activities']->count() > 0): ?>
                <ul>
                    <?php foreach($user['activities'] as $activity): ?>
                    <li class="boom-li">
                        <img href="#" src="http://placehold.it/160x88" alt="placeholder"/>
                        <div class="boom-info">
                            <span class="sm-flag sexo">sexo</span>
                            <p class="boom-ti">Lorem ipsum dolor blabla bla bla</p>
                            <a href="#" class="boom-moar">Leer Boom</a>
                        </div>
                        <ul class="boom-pub">
                            <li class="pub-date">Publicado el<a href="#"> 20/04/2012</a></li>
                            <li class="seen"> - <span>420</span> veces visto</li>
                            <li class="comments"> - <a href="#"><span>10</span> comments</a></li>
                            <li class="mods"> - <a href="#"><span>3</span> modificaciones</a></li>
                        </ul>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="ver-mas-block">
                    <a class="ver-moar" href="#">Ver Todos</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>