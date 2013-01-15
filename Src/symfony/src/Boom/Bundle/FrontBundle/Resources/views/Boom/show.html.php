<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$sidebar = $view->render(
        'BoomFrontBundle:Boom:blocks/user_order.html.php', array(
    'entity' => $entity
        )
);
$fb_boom_graph_data = array();
$fb_boom_graph_data['title'] = $entity['title'];
$fb_boom_graph_data['type'] = 'seven_boom_mx:boom';
$fb_boom_graph_data['image'] = $view['boom_image']->getBoomImageUrl($entity['image']['path']);
$fb_boom_graph_data['url'] = $view['router']->generate(
        'BoomFrontBundle_boom_show', array(
    'category_slug' => $entity['category']['slug'],
    'slug' => $entity['slug']
        ), true
);

$view['slots']->set('title', $entity['title']);
$view['slots']->set('description', $entity['summary']);

$twitter = array(
    'url' => $fb_boom_graph_data['url'],
    'text' => $fb_boom_graph_data['title'],
    'related' => '7_boom',
    'counturl' => $fb_boom_graph_data['url'],
    'via' => '7_boom'
);

$twitterUrl = 'https://twitter.com/share?' . http_build_query($twitter);

$favUrl = $view['router']->generate('BoomFrontBundle_boom_favstatus', array('slug' => $entity['slug']));
$twUrl = $view['router']->generate(
        'BoomFrontBundle_boom_twit_count', array(
    'slug' => $entity['slug'],
    'category_slug' => $entity['category']['slug']
        )
);
$editUrl = null;
if ($view['security']->isGranted('ROLE_USER') == true && $entity['user']['id'] == $app->getUser()->getId()) {
    $editUrl = $view['router']->generate('BoomFrontBundle_boom_edit', array('slug' => $entity['slug']));
}

$view['slots']->set('sidebar_top', $sidebar);
$view['slots']->set('fb_boom_graph_data', $fb_boom_graph_data);

$next_boom = $view['boom_front']->getNextAvailableBoom($entity);
$prev_boom = $view['boom_front']->getPrevAvailableBoom($entity);
?>
<div class="<?php echo $category['slug'] ?> single-boom">
    <div class="boom-main">
        <h3 class="title-flag <?php echo $category['slug'] ?>">
            <span><?php echo $view->escape($category['name']) ?></span>
        </h3>
        <img src="<?php echo $view['boom_image']->getBoomImageUrl($entity['image']['path'], 680, 382) ?>">
    </div>
    <div class="boom-else">
        <div class="boom-info">
            <h2><?php echo $view->escape($entity['title']) ?></h2>
            <p><?php echo $view->escape($entity['summary']); ?></p>
            <a class="boom-moar" href="#">Publicado el <date><?php echo $view->escape($view['boom_front']->getLocaleFormatDate($entity['datepublished'], 'EEE, d MMM, yyyy')) ?></date></a>
        </div>
        <div class="autor cf">
          <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>" class="autor-thumb"><img src="<?php echo $view['boom_image']->getProfileImageUrl($entity['user']['imagepath'], array(150, 150)) ?>"></a>
          <h3>Publicado por <a rel="author" href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>"><?php echo $view->escape($entity['user']['name']) ?></a></h3>
        </div>
        <?php /*
        <div class="replies cf">
          <span class="reply-img"></span>
          <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>" class="autor-thumb reply"><img src="<?php echo $view['boom_image']->getProfileImageUrl($entity['user']['imagepath'], array(150, 150)) ?>"></a>
          <h3>Boomeado por: <span><a href="">Juanito Xun</a> y otros 15</span></h3>
        </div>
        */?>
        <div class="social cf">
            <p>Comparte:</p>
            <div class="fb-share">
                <div class="fb-like-balloon">
                <div class="fb-like" data-href="<?php ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
                </div>
                <a href="#" class="btn-fb">facebook</a>
            </div>
            <div class="tw-share" tw-count="<?php echo $twUrl ?>">
                <a href="<?php echo $twitterUrl ?>" target="_blank" class="btn-tw">twitter</a>
            </div>
            <a href="<?php echo $favUrl ?>" target="_blank" class="fav-placeholder"></a>
            <?php if ($editUrl !== null): ?>
                <a href="<?php echo $editUrl ?>" class="editar-boom-ph">EDITA TU BOOM</a>
            <?php endif; ?>
        </div>
        <div class="booms">
            <ul class="lista-booms">
                <?php
                $elements = array_reverse($entity['elements']->toArray());
                $boomieCount = count($elements);
                foreach ($elements as $element):
                    if (isset($element['image']['path'])):
                        $elementImage = $view['boom_image']->getBoomImageUrl($element['image']['path'], 158, 90);
                    else:
                        $elementImage = '';
                    endif;
                    $elementContent = $element['content'] === null ? '' : $element['content'];
                    ?>
                    <li class="boom">
                        <div class="boom-info cf">
                            <div class="place-container"></div>
                            <span class="place">
                                <?php echo $boomieCount ?>
                            </span>
                            <div class="float-container cf">
                                <?php if (isset($element['image']['path'])): ?>
                                    <img src="<?php echo $elementImage; ?>" height="87px" width="153px" />
                                <?php endif; ?>
                                <div class="text-position">
                                  <p class="boom-ti"><?php echo $view->escape($element['title']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="boom-content">
                            <div class="boom-text">
                                <p><?php echo $view['bbcode']->filter((string) strip_tags($elementContent), 'default') ?></p>
                            </div>
                            <?php /*
                            <div class="comments">
                                <div class="fb-comments" data-href="<?php echo $fb_boom_graph_data['url'] . '#' . $boomieCount ?>" data-num-posts="2" data-width="648"></div>
                            </div>
                             */?>
                        </div>
                        <?php //<span class="tab"><a href=""><span>TAB</span></a></span> ?>
                    </li>
                    <?php
                    $boomieCount--;
                endforeach;
                ?>
            </ul>
            <div class="boom-tags">
                <p>Tags:
                    <?php
                    $tags = array_reverse($entity['tags']->toArray());
                    $numTags = count($tags);
                    $ind = 0;
                    foreach ($tags as $tag):
                        ?>
                        <a href="<?php echo $view['router']->generate('BoomFrontBundle_list_tag', array('slug' => $tag['slug'])); ?>">
                            <?php echo $view->escape($tag['name']) ?></a>
                        <?php echo (++$ind != $numTags) ? ',' : '.'; ?>
                    <?php endforeach; ?>
                </p>
            </div>
            <div class="autor cf">
                <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>" class="autor-thumb"><img src="<?php echo $view['boom_image']->getProfileImageUrl($entity['user']['imagepath'], array(150, 150)) ?>"></a>
                <h3>Publicado por <a rel="author" href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>"><?php echo $view->escape($entity['user']['name']) ?></a></h3>
<!--                <p><?php // echo $view->escape($entity['user']['bio'])     ?>...<a class="ver-moar" href="<?php // echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username']))     ?>">Leer más</a></p> -->
            </div>
            <div class="social cf">
                <p>Comparte:</p>
                <div class="fb-share">
                    <div class="fb-like-balloon"><div class="fb-like" data-href="<?php ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></div>
                    <a href="#" class="btn-fb">facebook</a>
                    <?php echo!empty($fb_boom_likes) ? '<p>' . $fb_boom_likes . '</p>' : '' ?>
                </div>
                <div class="tw-share">
                    <a href="<?php echo $twitterUrl ?>" target="_blank" class="btn-tw">twitter</a>
                </div>
                <a href="<?php echo $favUrl ?>" target="_blank" class="fav-placeholder"></a>
                <?php if ($editUrl !== null): ?>
                    <a href="<?php echo $editUrl ?>" class="editar-boom-ph">EDITA TU BOOM</a>
                <?php endif; ?>
            </div>
            <?php
            /*
            <div class="respuestas-boom cf">
              <h3 class="reply-flag">Respuestas a este boom</h3>
              <ul class="cf">
              	<li>
              		<a href="" class="autor-thumb"><img src="http://graph.facebook.com/820795226/picture?type=large"/></a>
              		<div>
              		  <h4>
              		    <a href="">Carlos Solares</a>
              		  </h4>
              		  <p class="time-ago">Hace XX minutos.</p>
              		  <a class="ver-reply">&iexcl;CHECA SU OPINI&Oacute;N!</a>
                  </div>
              	</li>
              	<li>
              		<a href="" class="autor-thumb"><img src="http://graph.facebook.com/820795226/picture?type=large"/></a>
              		<div>
              		  <h4>
              		    <a href="">Carlos Solares</a>
              		  </h4>
              		  <p class="time-ago">Hace XX minutos.</p>
              		  <a class="ver-reply">&iexcl;CHECA SU OPINI&Oacute;N!</a>
                  </div>
              	</li>
              	<li>
              		<a href="" class="autor-thumb"><img src="http://graph.facebook.com/820795226/picture?type=large"/></a>
              		<div>
              		  <h4>
              		    <a href="">Carlos Solares</a>
              		  </h4>
              		  <p class="time-ago">Hace XX minutos.</p>
              		  <a class="ver-reply">&iexcl;CHECA SU OPINI&Oacute;N!</a>
                  </div>
              	</li>
              	<li>
              		<a href="" class="autor-thumb"><img src="http://graph.facebook.com/820795226/picture?type=large"/></a>
              		<div>
              		  <h4>
              		    <a href="">Carlos Solares</a>
              		  </h4>
              		  <p class="time-ago">Hace XX minutos.</p>
              		  <a class="ver-reply">&iexcl;CHECA SU OPINI&Oacute;N!</a>
                  </div>
              	</li>
              </ul>
              <a class="more-replies"></a>
            </div>
             */ ?>
            <?php
                $related_booms = $view['boom_front']->getRelatedBooms($entity);
                if(!empty($related_booms)):
            ?>
            <div class="boom-related respuestas-boom cf">
              <h3 class="reply-flag">Booms relacionados</h3>
              <ul class="cf list-grid">
                  <?php
                  foreach($related_booms as $related_boom):
                      $related_url = $view['router']->generate(
                              'BoomFrontBundle_boom_show',
                              array(
                                  'category_slug' => $related_boom['category']['slug'],
                                  'slug' => $related_boom['slug']
                              )
                              );
                        $related_userUrl = $view['router']->generate(
                'BoomFrontBundle_user_profile',array('username' => $related_boom['user']['username']));
                      ?>
                  <li>
                  <div>
                    <a href="<?php echo $related_url ?>"><img src="<?php echo $view['boom_image']->getBoomImageUrl($related_boom['image']['path'], 191, 108) ?>" alt="<?php $view->escape($related_boom['title']) ?>" width="191" height="108"></a>
                    <span class="sm-flag <?php echo $view->escape($related_boom['category']['slug']) ?>"><?php echo $view->escape($related_boom['category']['name']) ?></span>
                  </div>
                  <div>
                    <p class="boom-ti"><a href="<?php echo $related_url ?>" class="boom-moar"><?php echo $view->escape($view['boom_front']->ellipsis($related_boom['title'])) ?></a></p>
                    <a href="<?php echo $related_userUrl ?>" class="boom-moar">Por <?php echo $view->escape($related_boom['user']['name']) ?>.</a>
                    <p><date><?php echo $view->escape($view['boom_front']->getLocaleFormatDate($related_boom['datepublished'], 'EEE, d MMM, yyyy' )) ?></date></p>
                  </div>
              	</li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>
            <div class="pager cf">
              <?php if($prev_boom !== NULL): ?>
              <div class="prev-boom page-block">
                  <?php
                    $prev_url = $view['router']->generate(
                            'BoomFrontBundle_boom_show',
                                array(
                                    'category_slug' => $prev_boom['category']['slug'],
                                    'slug'          => $prev_boom['slug']
                                )
                            );
                  ?>
                <a href="<?php echo $prev_url ?>">Boom Anterior</a>
                <a href="<?php echo $prev_url ?>">
                    <img src="<?php echo $view['boom_image']->getBoomImageUrl($prev_boom['image']['path'], 130, 74) ?>" alt="<?php echo $view->escape($prev_boom['title']) ?>" width="130" height="74">
                </a>
              </div>
                <?php endif; ?>
                <?php if($next_boom !== NULL): ?>
              <div class="next-boom page-block">
                    <?php
                    $next_url = $view['router']->generate(
                            'BoomFrontBundle_boom_show',
                                array(
                                    'category_slug' => $next_boom['category']['slug'],
                                    'slug'          => $next_boom['slug']
                                )
                            );
                  ?>
                <a href="<?php echo $next_url ?>"><img src="<?php echo $view['boom_image']->getBoomImageUrl($next_boom['image']['path'], 130, 74) ?>" alt="<?php echo $view->escape($next_boom['title']) ?>" width="130" height="74"></a>
                <a href="<?php echo $next_url ?>">Siguiente Boom</a>
              </div>
            <?php endif; ?>
            </div>
            <div>
              <a id="widget-call">
              </a>
            </div>
            <div class="comments">
                <div class="fb-comments" data-href="<?php echo $fb_boom_graph_data['url'] ?>" data-num-posts="2" data-width="648"></div>
            </div>
        </div>
    </div>
</div>
