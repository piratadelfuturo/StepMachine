<ul class="list cf">
    <?php
    if(!isset($list)){
        $list = array();
    }
    foreach ($list as $element):
        $elementUrl = $view['router']->generate(
                'BoomFrontBundle_boom_show', array(
            'category_slug' => $element['category']['slug'], 'slug' => $element['slug']
                )
              );
    $image =  isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],158,90) : 'http://placekitten.com/158/90';
        ?>
        <li class="boom">
            <img src="<?php echo $image?>" width="158px" height="90px" >
            <div class="boom-info">
                <span class="sm-flag <?php echo $element['category']['slug'] ?>"><?php echo $view->escape($element['category']['name']) ?></span>
                <p class="boom-ti">
                    <a href="<?php echo $elementUrl ?>" class="boom-moar">
                        <?php echo $view->escape($element['title']); ?>
                    </a>
                </p>
                <a href="<?php echo $elementUrl ?>" class="boom-moar">
                    Por <?php
                    echo $view->escape(
                            !empty($element['user']['nickname']) || $element['user']['nickname'] == null ? $element['user']['username'] : $element['user']['nickname']
                    )
                    ?>
                </a>
                <date><?php echo $view->escape($element['datecreated']->format('D, d M y')) ?></date>
            </div>
        </li>
    <?php endforeach; ?>
    <?php if (isset($more_url)): ?>
        <a href="<?php echo $more_url ?>" class="moar">ver más</a>
    <?php endif; ?>
    <li class="pags">
      <ul class="paginador">
        <li><a href="#"><span class="pagina-prev">prev</span></a></li>
        <li><a href="#"><span class="pagina">1</span></a></li>
        <li><a href="#"><span class="pagina even">2</span></a></li>
        <li><a href="#"><span class="pagina">3</span></a></li>
        <li><a href="#"><span class="pagina even">4</span></a></li>
        <li><a href="#"><span class="pagina on">5</span></a></li>
        <li><a href="#"><span class="pagina even">60</span></a></li>
        <li><a href="#"><span class="pagina">70</span></a></li>
        <li><a href="#"><span class="pagina-next">next</span></a></li>
      </ul>
    </li>
</ul>
