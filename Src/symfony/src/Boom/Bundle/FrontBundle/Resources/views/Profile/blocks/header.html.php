<?php
/* @var \Doctrine\Common\Collections\ArrayCollection $user['activities'] */
/* @var \Doctrine\Common\Collections\ArrayCollection $user['favorites'] */
$user = $app->getUser();
$categories = $view['boom_front']->getFeaturedCategories();
$activities = $view['boom_front']->getFollowedActivities($app->getUser());
?>
<div id="usr-cnt">
    <a href="#" class="mostrar"><span>Tu Panel</span></a>
    <div id="usr-box" class="hook">
        <div id="usr-bar">
            <ul id="close-tab">
                <li>
                    <?php if ($view['security']->isGranted('ROLE_USER') == true): ?>
                        Bienvenido <a href="<?php
                    echo $view['router']->generate(
                            'BoomFrontBundle_user_profile', array(
                        'username' => $user['username']
                            )
                    )
                        ?>">
                                          <?php echo $view->escape($user['name']); ?>
                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="<?php echo '' ?>">Cerrar Sesión</a>
                </li>
                <?php if (!empty($activities)): ?>
                    <li>
                        <ul id="user-activity-stream">
                            <?php
                            foreach ($activities as $activity):
                                $userUrl = $view['router']->generate(
                                        'BoomFrontBundle_user_profile', array('username' => $activity['user']['username'])
                                );
                                ?>
                                <li>
                                    <a href="<?php echo $userUrl ?>">
                                        <?php echo $activity['user']['name'] ?>
                                    </a>
                                    <?php echo $view->escape($activity['data']) ?>
                                    <?php
                                    if ($activity['boom'] !== null):
                                        $boomUrl = $view['router']->generate(
                                                'BoomFrontBundle_boom_show', array(
                                            'category_slug' => $activitiy['boom']['category']['slug'],
                                            'slug' => $activitiy['boom']['slug']
                                                )
                                        );
                                        ?>
                                        <a href="<?php $boomUrl ?>">boom >></a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

            <div id="open-tab" class="botones">
                <a href="#" class="on">Actividad</a>
                <a href="#">Favoritos</a>
                <span class="arrow">.</span>
            </div>
        </div>
        <div id="usr-roll">
            <div id="usm-pro">
                <div class="usm-info">
                    <div class="usr-pic">
                        <img src="<?php echo $view['boom_image']->getProfileImageUrl($user['imagepath'],array(150,150)) ?>" id="user-img" height="150px" width="150px"/>
                    </div>
                    <div class="usr-data">
                        <h3>¡Bienvenido...</br><span><?php echo $view->escape($user['firstname']); ?> !</span></h3>
                        <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $user['username'])) ?>" class="ver">Ver perfil</a>
                        <a href="<?php echo $view['router']->generate('BoomFrontBundle_profile_edit') ?>" class="ver">Editar Perfil</a>
                    </div>
                </div>
                <div id="filter">
                    <form id="usr-category-pref">
                        <p>Filtro por categoría:</p>
                        <ul class="cf">
                            <?php foreach ($categories as $category): ?>
                                <li class="<?php echo $category['a_slug'] ?>">
                                    <?php //echo $view['form']->widget(''); ?>
                                    <input id="cat-<?php echo $category['a_slug'] ?>" name="<?php $category['a_name'] ?>" type="checkbox" class="select" value="<?php echo $category['a_slug'] ?>" />
                                    <label><?php echo $category['a_name'] ?></label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </form>
                </div>
                <?php $followings = $user['following']->slice(0, 12); ?>
                <div class="boomers">
                    <?php if (count($followings) > 0): ?>
                        <p>Boomers que sigues:</p>
                        <ul>
                            <?php foreach ($followings as $following): ?>
                                <li><a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $following['username'])) ?>">
                                        <span>
                                            <img src="<?php echo $following['imagepath'] ?>" alt="<?php echo $following['username'] ?>" height="40px" width="40px"/>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="ver-mas-block">
                            <a class="ver-moar" href="<?php echo $view['router']->generate('BoomFrontBundle_profile_following'); ?> ">Ver Todos</a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <div id="rt-cont">
                <div id="rt-user-activities" class="on">
                    <?php if (count($activities) > 0): ?>
                        <ul>
                            <?php foreach ($activities as $activity): ?>
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
                            <a class="ver-moar" href="<?php echo $view['router']->generate('BoomFrontBundle_activity_list') ?> ">Ver Todos</a>
                        </div>
                    <?php else: ?>
                    <div class="no-content">
                      <p><strong>Parece que aun no tienes actividad en tu perfil</strong></p>
                      <p>Es hora de darle vida a tu perfil:</p>
                      <p><a href=""><strong>Crea tus propios booms</strong></a></p>
                      <p><a href=""><strong>Modifica nuestros destacados</strong></a></p>
                      <p><a href=""><strong>Invita a tus amigos</strong></a> y comparte tu opinión.</p>
                      <p>¡7Boom es tu sitio, diviértete! Es una orden.</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div id="rt-user-recommended" style="display:none">
                    <?php if ($user['favorites']->count() > 0): ?>
                        <ul>
                            <?php
                            foreach ($user['favorites']->slice(0, 7) as $element):
                                if (isset($element['image']['path'])):
                                    $elementImage = $view['boom_image']->getBoomImageUrl($element['image']['path'], 158, 90);
                                else:
                                    $elementImage = '';
                                endif;
                                $elementUrl = $view['router']->generate(
                                        'BoomFrontBundle_boom_show', array(
                                    'category_slug' => '',
                                    'slug' => ''
                                        )
                                );
                                ?>
                                <li class="boom-li">
                                    <img src="<?php echo $elementImage ?>" alt="placeholder"/>
                                    <div class="boom-info">
                                        <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $element['category']['name'] ?></span>
                                        <p class="boom-ti"><?php echo $element['title'] ?></p>
                                        <a href="<?php echo $elementUrl ?>" class="boom-moar">Leer Boom</a>
                                    </div>
                                    <ul class="boom-pub">
                                        <li class="pub-date">Publicado el<a href="<?php echo $elementUrl ?>"> <?php $element['datepublished'] ?></a></li>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="ver-mas-block">
                            <a class="ver-moar" href="<?php echo $view['router']->generate('BoomFrontBundle_profile_recommend') ?> ">Ver Todos</a>
                        </div>
                        <?php else: ?>
                        <div class="no-content">
                          <p><strong>Parece que aun no tienes favoritos</strong></p>
                          <p>¡7Boom es tu sitio, diviértete! Es una orden.</p>
                        </div>
                    <?php endif; ?>
                </div
            </div>
        </div>
    </div>
</div>
