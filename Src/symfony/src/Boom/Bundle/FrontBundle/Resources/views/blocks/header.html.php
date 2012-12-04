  <?php $categories = $view['boom_front']->getFeaturedCategories(); /*?>
  <div id="iframe-container" class="top-frame">
    <a href="#" class="welcome-img"><img src="/bundles/boomfront/images/banner.jpg" width="1024" height="120" alt="¿Perdido? Haz click para que voceemos a tu mamá"></a>
    <a href="#" class="close-frame">Cerrar</a>
  </div>*/
  ?>
  <div id="hd-mn" class="gradient">
    <h1>
      <a href="<?php echo $view['router']->generate('BoomFrontBundle_homepage'); ?>">7Boom</a>
    </h1>
    <div id="link-block">
        <div class="hd-social-list" >
            <p>Síguenos:</p>
            <p>
              <a class="fb" href="http://www.facebook.com/7BoomMex">Facebook</a>
            </p>
            <p>
              <a class="tw" href="http://www.twitter.com/7_boom">Twitter</a>
            </p>
        </div>
        <div id="top-bar" class="gradient">
            <ul id="mini-nav">
                <li>
                  <a href="<?php echo $view['router']->generate('BoomFrontBundle_boom_new'); ?>">CREA TU <span>boom</span></a>
                </li>
                <!-- <li><a href="#">Especiales</a></li> -->
                <li class="last">
                  <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_collaborators') ?>">Colaboradores</a>
                </li>
            </ul>
            <div id="tb-rb">
                <form>
                    <input type="submit" name="sbm-src" value="Buscar"  />
                    <input type="text" name="src-box"/>
                </form>
            </div>
        </div>
        <nav class="gradient">
          <div>
            <?php foreach ($categories as $el): ?>
                <a href="<?php echo $view['router']->generate(
                        'BoomFrontBundle_category_show',
                        array(
                            'slug' => $el['a_slug']
                            )) ?>">
                                <?php echo $view->escape($el['a_name']) ?>
                </a>
            <?php endforeach; ?>
          </div>
        </nav>
    </div>
  </div>
