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
    'hashtags' => $category['slug']
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
        <div class="social cf">
            <p>Comparte:</p>
            <div class="fb-share">
                <div class="fb-like-balloon"><div class="fb-like" data-href="<?php ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></div>
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
                                <p><?php echo $view['bbcode']->filter((string) $elementContent, 'default') ?></p>
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
            <div class="comments">
                <div class="fb-comments" data-href="<?php echo $fb_boom_graph_data['url'] ?>" data-num-posts="2" data-width="648"></div>
            </div>

        </div>
    </div>
</div>
