<?php
if ($view['security']->isGranted('ROLE_USER') == true):
    $user = $app->getUser();
endif;
?>

<div id="usr-cnt">
    <?php if ($view['security']->isGranted('ROLE_USER') == true): ?>
        <a href="#" class="mostrar">
            <span style="display:none" >Mostrar</span>
            <span  >Ocultar</span>
        </a>
    <?php endif; ?>
    <div id="usr-box">
        <div id="usr-bar">
            <?php if ($view['security']->isGranted('ROLE_USER') == true): ?>
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
            <?php else: ?>
                <ul>
                    <li><?php
            echo $view['facebook']->loginButton(
                    array(
                'autologoutlink' => true,
                'size' => 'large'
                    ), 'BoomFrontBundle::blocks/facebook/loginButton.html.php'
            )
                ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
        <?php if ($view['security']->isGranted('ROLE_USER') == true): ?>
            <div id="usr-roll">
                <div id="usm-pro">
                    <div class="usm-info">
                        <div class="usr-pic">
                            <img src="http://placehold.it/150x150" id="user-img"/>
                        </div>
                        <div class="usr-data">
                            <h3>¡Bienvenido...</br><span><?php echo $view->escape($user['firstname']); ?> !</span></h3>
                            <a href="#" class="ver">Ver perfil</a>
                            <a href="#" class="ver">Cambiar foto</a>
                        </div>
                    </div>
                    <div id="filter">
                        <p>Filtro por categoría:</p>
                        <ul>
                            <li class="sexo">
                                <input id="cat-sexo" name="Sexo" type="checkbox" class="select" value="sexo" tabindex="1" onchange="handleInput(this);" onmouseup="handleInput(this);"/>
                                <label>sexo</label>
                            </li>
                            <li class="cine">
                                <input id="cat-cine" name="Cine" type="checkbox" class="select" value="sexo" tabindex="1" onchange="handleInput(this);" onmouseup="handleInput(this);" />
                                <label>cine</label>
                            </li>
                            <li class="tecnologia">
                                <input id="cat-tecnologia" name="Tecnologia" type="checkbox" class="select" value="sexo" tabindex="1" onchange="handleInput(this);" onmouseup="handleInput(this);" checked="checked"/>
                                <label>tecnología</label>
                            </li>
                            <li class="lucky">
                                <input id="cat-lucky" name="Lucky7" type="checkbox" class="select" value="sexo" tabindex="1" onchange="handleInput(this);" onmouseup="handleInput(this);" checked="checked"/>
                                <label>lucky</label>
                            </li>
                            <li class="musica">
                                <input id="cat-musica" name="Música" type="checkbox" class="select" value="sexo" tabindex="1" onchange="handleInput(this);" onmouseup="handleInput(this);" checked="checked"/>
                                <label>música</label>
                            </li>
                        </ul>
                        <a href="#" class="ver-moar">Ver todas</a>
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
                        </div>

                    <?php endif; ?>
                </div>
                <div id="rt-cont">
                    <ul>
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
                        <li class="boom-li">
                            <img href="#" src="http://placehold.it/160x88" alt="placeholder"/>
                            <div class="boom-info">
                                <span class="sm-flag sexo">sexo</span>
                                <p class="boom-ti">Los 7 Lorem Ipsum más famosos de la vida, Lorem ipsum dolor sitbla</p>
                                <a href="#" class="boom-moar">Leer Boom</a>
                            </div>
                            <ul class="boom-pub">
                                <li class="pub-date">Publicado el<a href="#"> 20/04/2012</a></li>
                                <li class="seen"> - <span>420</span> veces visto</li>
                                <li class="comments"> - <a href="#"><span>10</span> comments</a></li>
                                <li class="mods"> - <a href="#"><span>3</span> modificaciones</a></li>
                            </ul>
                        </li>
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

                    </ul>
                    <div class="ver-mas-block">
                        <a class="ver-moar" href="#">Ver Todos</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>