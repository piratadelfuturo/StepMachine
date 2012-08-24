<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$sidebar = $view->render(
        'BoomFrontBundle:Boom:blocks/userOrder.html.php',
        array(
            'entity' => $entity
        )
        );
$canonical_url = $view['router']->generate(
                    'BoomFrontBundle_slug_show', array(
                'slug' => $entity['maincategory']['slug'] . '/' . $entity['slug']
                    ),
                    true
            );

$view['slots']->set('sidebar_top',$sidebar);
$view['slots']->set('canonical_url',$canonical_url);

?>

<div class="musica" id="single-boom">
        <h3 class="title-flag <?php echo $category['slug'] ?>">
            <span><?php echo $view->escape($category['name']) ?></span>
        </h3>
        <img src="http://placehold.it/680x382">
        <div class="boom-info">
          <h2><?php echo $view->escape($entity['title']) ?></h2>
          <p><?php echo $view['bbcode']->filter($entity['summary'],'default') ?></p>
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
          <img src="http://placehold.it/85x85">
          <span>
            <h3>Publicado por <a rel="author" href="#"><?php echo $entity['user']['username']?></a></h3>
            <p>Phillip k. Dick es un escritor de California. Su literatura está influenciada por la narrativa policiaca de Raymond Chandler y los textos futuristas de William Gibson. K. Dick es quizá el autor más adaptado al cine...<a class="ver-moar" href="#">Leer más</a></p>
          </span>
        </div>
        <div class="booms">
          <ul>
            <?php
            $elements = array_reverse($entity['elements']->toArray());
            foreach($elements as $element): ?>
            <li class="boom on">
              <div class="place-info">
                <span class="place">
                    <?php echo $element['position'] ?>
                </span>
                <img src="http://placehold.it/151x86" height="87px" width="151px">
                <p class="boom-ti">
                    <?php echo $element['title'] ?>
                </p>
              </div>
              <div class="boom-content">
                <?php $content = $element['content'] === null ?'':$element['content'];  ?>
                <?php echo $view['bbcode']->filter($content,'default') ?>
                <div class="comments">FB COMMENTS</div>
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

 
