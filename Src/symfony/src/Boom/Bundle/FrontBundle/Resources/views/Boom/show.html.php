<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$sidebar = $view->render(
        'BoomFrontBundle:Boom:blocks/userOrder.html.php', array(
    'entity' => $entity
        )
);
$canonical_url = $view['router']->generate(
        'BoomFrontBundle_boom_show', array(
    'category_slug' => $entity['category']['slug'],
    'slug' => $entity['slug']
        ), true
);

$view['slots']->set('sidebar_top', $sidebar);
$view['slots']->set('canonical_url', $canonical_url);

?>

<div class="musica" id="single-boom">
    <div class="feat-img">
      <h3 class="title-flag <?php echo $category['slug'] ?>">
          <span><?php echo $view->escape($category['name']) ?></span>
      </h3>
      <img src="http://placekitten.com/680/382">
    </div>
    <div class="boom-info">
        <h2><?php echo $view->escape($entity['title']) ?></h2>
        <p><?php echo $view['bbcode']->filter((string) $entity['summary'], 'default') ?></p>
        <a class="boom-moar" href="#">Publicado el <date>fecha </date></a>
    </div>
    <div class="social">
        <span class="comparte">comparte:
            <a href="#"><span class="btn-fb">facebook</span></a>
            <a href="#"><span class="btn-tw">twitter</span></a>
        </span>
        <span class="fav">marcar como favorito:
            <a href="#"><span class="btn-fav">fav</span></a>
        </span>
    </div>
    <div class="autor">
        <img src="http://placekitten.com/85/85">
        <span>
            <h3>Publicado por <a rel="author" href="#"><?php echo $entity['user']['username'] ?></a></h3>
            <p>Phillip k. Dick es un escritor de California. Su literatura está influenciada por la narrativa policiaca de Raymond Chandler y los textos futuristas de William Gibson. K. Dick es quizá el autor más adaptado al cine...<a class="ver-moar" href="#">Leer más</a></p>

        </span>
    </div>
    <div class="booms">
        <ul>
<?php
$elements = array_reverse($entity['elements']->toArray());
foreach ($elements as $element):
    ?>
      <li class="boom">
                    <div class="place-info">
                        <span class="place">
    <?php echo $element['position'] ?>
                        </span>
                        <div class="b-info cf">
                          <img src="http://placekitten.com/151/86" height="87px" width="151px">
                          <p class="boom-ti">
      <?php echo $element['title'] ?>
                          </p>
                        </div>
                    </div>
                    <div class="boom-content">
    <?php $content = $element['content'] === null ? '' : $element['content']; ?>
                        <?php echo $view['bbcode']->filter((string) $content, 'default') ?>
                        <div class="comments"><div class="fb-comments" data-href="<?php echo $canonical_url ?>" data-num-posts="2" data-width="670"></div></div>
                    </div>
                    <span class="tab"><a href=""><span>TAB</span></a></span>
                </li>
<?php endforeach; ?>
        </ul>
        <div class="boom-tags"><p>Tags: <a href="#">Tag</a>, <a href="#">Tag</a>, <a href="#">Tag</a>, <a href="#">Tag</a>, <a href="#">Tag</a></p></div>
        <div class="social">
            <span class="comparte">comparte:
                <a href="#"><span class="btn-fb">facebook</span></a>
                <a href="#"><span class="btn-tw">twitter</span></a>
            </span>
            <span class="fav">marcar como favorito:
                <a href="#"><span class="btn-fav">fav</span></a>
            </span>
        </div>
        <div class="boom-nav">
            <a href="#"><span class="prv-boom">Boom Anterior</span></a>
            <a href="#"><span class="nxt-boom">Siguiente Boom</span></a>
        </div>
    </div>
</div>
