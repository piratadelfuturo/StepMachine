<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$sidebar = $view->render(
        'BoomFrontBundle:Boom:blocks/userOrder.html.php', array(
    'entity' => $entity
        )
);
$fb_boom_graph_data = array();
$fb_boom_graph_data['title'] = $entity['title'];
$fb_boom_graph_data['image'] = $view['boom_image']->getBoomImageUrl($entity['image']['path']);
$fb_boom_graph_data['url'] = $view['router']->generate(
        'BoomFrontBundle_boom_show', array(
    'category_slug' => $entity['category']['slug'],
    'slug' => $entity['slug']
        ), true
);

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
      <p><?php echo $view['bbcode']->filter((string) $entity['summary'], 'default') ?></p>
      <a class="boom-moar" href="#">Publicado el <date>fecha </date></a>
    </div>
    <div class="social cf">
      <p>Comparte:</p>
      <a href="#" class="btn-fb">facebook</a>
      <a href="#" class="btn-tw">twitter</a>
      <a href="#" class="btn-fav">Marcar como favorito:</a>
    </div>
    <div class="autor cf">
        <a href="#" class="autor-thumb"><img src="http://placekitten.com/85/87" alt="Placeholder" /></a>
        <div class="txt-container">
          <h3>Publicado por <a rel="author" href="#"><?php echo $entity['user']['username'] ?></a></h3>
          <p>Phillip k. Dick es un escritor de California. Su literatura está influenciada por la narrativa policiaca de Raymond Chandler y los textos futuristas de William Gibson. K. Dick es quizá el autor más adaptado al cine...<a class="ver-moar" href="#">Leer más</a></p>
        </div>
    </div>
    <div class="booms">
      <ul>
      <?php
        $elements = array_reverse($entity['elements']->toArray());
        foreach ($elements as $element):
      ?>
        <li class="boom">
          <div class="boom-info cf">
            <span class="place">
              <?php echo $element['position'] ?>
            </span>
            <div class="float-container cf">
            <?php if(isset($element['image']['path'])){ ?>
              <img src="<?php echo $view['boom_image']->getBoomImageUrl($element['image']['path']); ?>" height="87px" width="151px" />
            <?php } ?>
              <p class="boom-ti"><?php echo $element['title'] ?></p>
            </div>
          </div>
          <div class="boom-content">
            <div class="boom-text">
              <p><?php $content = $element['content'] === null ? '' : $element['content']; ?></p>
              <p><?php echo $view['bbcode']->filter((string) $content, 'default') ?></p>
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
      <?php $tags = array_reverse($entity['tags']->toArray());
        $numTags = count($tags);
        $ind = 0;
        foreach ($tags as $tag):?>
          <a href="<?php echo $view['router']->generate('BoomFrontBundle_list_tag',array('slug' => $tag['slug'])); ?>"><?php echo  $view->escape($tag['name']) ?></a><?php  echo $coma = (++$ind != $numTags) ? ',' : '.';?>
        <?php endforeach ?>
      </p>
      </div>
      <div class="social cf">
        <p>Comparte:</p>
        <a href="#" class="btn-fb">facebook</a>
        <a href="#" class="btn-tw">twitter</a>
        <a href="#" class="btn-fav">Marcar como favorito:</a>
      </div>
    </div>
  </div>
</div>

