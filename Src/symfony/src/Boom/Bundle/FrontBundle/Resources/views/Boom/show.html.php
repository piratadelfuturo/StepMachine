<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$sidebar = $view->render(
        'BoomFrontBundle:Boom:blocks/userOrder.html.php', array(
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
    'url'      => $fb_boom_graph_data['url'],
    'text'    => $fb_boom_graph_data['title'],
    'related'  => '7_boom',
    'counturl' => $fb_boom_graph_data['url'],
    'hashtags' => $category['slug']
);

$twitterUrl = 'https://twitter.com/share?'.http_build_query($twitter);

$favUrl = $view['router']->generate('BoomFrontBundle_boom_fav',array('slug'=>$entity['slug']));

$view['slots']->set('sidebar_top', $sidebar);
$view['slots']->set('fb_boom_graph_data', $fb_boom_graph_data);
?>
<div class="musica single-boom">
    <div class="boom-main">
        <h3 class="title-flag <?php echo $category['slug'] ?>">
            <span><?php echo $view->escape($category['name']) ?></span>
        </h3>
        <img src="<?php echo $view['boom_image']->getBoomImageUrl($entity['image']['path']) ?>">
    </div>
    <div class="boom-else">
        <div class="boom-info">
            <h2><?php echo $view->escape($entity['title']) ?></h2>
            <p><?php echo $view->escape($entity['summary']); ?></p>
            <a class="boom-moar" href="#">Publicado el <date><?php echo $entity['datepublished']->format('D, d M y') ?></date></a>
        </div>
        <div class="social cf">
            <p>Comparte:</p>
            <div class="fb-like" data-href="<?php $fb_boom_graph_data['url'] ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
            <a href="#" class="btn-fb">facebook</a>
            <a href="<?php echo $twitterUrl ?>" target="_blank" class="btn-tw">twitter</a>
            <a href="<?php echo $favUrl ?>" target="_blank" class="btn-fav">Marcar como favorito:</a>
        </div>
        <div class="autor cf">
            <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>" class="autor-thumb"><img src="<?php echo $entity['user']['imagepath'] ?>"></a>
            <h3>Publicado por <a rel="author" href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])) ?>"><?php echo $view->escape($entity['user']['username']) ?></a></h3>
        </div>
        <div class="booms">
            <ul>
                <?php
                $elements = array_reverse($entity['elements']->toArray());
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
                            <span class="place">
                                <?php echo $element['position'] ?>
                            </span>
                            <div class="float-container cf">

                                <img src="<?php echo $elementImage; ?>" height="87px" width="153px" />
                                <p class="boom-ti"><?php echo $view->escape($element['title']) ?></p>
                            </div>
                        </div>
                        <div class="boom-content">
                            <div class="boom-text">
                                <p><?php echo $view['bbcode']->filter((string) $elementContent, 'default') ?></p>
                            </div>
                            <div class="comments">
                                <div class="fb-comments" data-href="<?php echo $fb_boom_graph_data['url'] ?>" data-num-posts="2" data-width="648"></div>
                            </div>
                        </div>
                        <span class="tab"><a href=""><span>TAB</span></a></span>
                    </li>
                <?php endforeach; ?>
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
            <div class="social cf">
                <p>Comparte:</p>
                <div class="fb-like" data-href="<?php $fb_boom_graph_data['url'] ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
                <a href="#" class="btn-fb" >facebook</a>
                <a href="<?php echo $twitterUrl ?>" class="btn-tw" >twitter</a>
                <a href="<?php echo $favUrl ?>" target="_blank" class="btn-fav" >Marcar como favorito:</a>
            </div>
        </div>
    </div>
</div>
