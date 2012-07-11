<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php $view['slots']->output('title', 'Welcome!') ?></title>
  <meta name="description" content="">
  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">
  <link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" /> 
  <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('boom/css/style.css');?>">
  <?php $view['slots']->output('stylesheets') ?>
  <script src="<?php echo $view['assets']->getUrl('boom/js/libs/modernizr-2.5.3.min.js'); ?>"></script>
</head>
<body>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <header>
      <div id="head-permbox">
          <nav>
              <a href="#">Especiales</a>
              <a href="#">Colaboradores</a>
              <a href="#">CREA TU <strong>BOOM</strong></a>              
          </nav>
          <strong>
              Bienvenido
              <a>
                  Scott Pilgrim
              </a>
          </strong>
          <form>
              <input type="text" value="" />
              <input type="submit" />              
          </form>
          
      </div>
      <div id="head-menubox">
          <nav>
              <a href="#">Músico</a>
              <a href="#">Sexo</a>
              <a href="#">Cine</a>
              <a href="#">Tecnologia</a>
              <a href="#">Lucky 7</a>              
          </nav>
      </div>
      <div id="head-userbox">
          <a href="#" >Ocultar</a>
          <div>
              <div>
                  <img src="" alt="Scott Pilgrim"/>
                  <h1>Bienvenido
                  <a href="#">Scott Pilgrim</a></h1>
                  <a href="#" >Ver perfil</a>
                  <a href="#" >Cambiar foto</a>
                  <li></li>
                  </ul>
              </div>
              <div>
                  <h2>Filtro por categoría:</h2>
                  <form>
                      <div><input type="checkbox" value="" /> <label>Sexo</label></div>
                      <div><input type="checkbox" value="" /> <label>Tecnologia</label></div>
                      <div><input type="checkbox" value="" /> <label>Musica</label></div>
                      <div><input type="checkbox" value="" /> <label>Cine</label></div>
                      <div><input type="checkbox" value="" /> <label>Lucky 7</label></div>
                      <div>Ver todas</div>
                  </form>
              </div>
              <div>
                  <h2>Boomers que sigues:</h2>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>
                  <a href="#">
                      <img src="" />
                  </a>                  
              </div>
              <div>
              <ul>
                  <li>
                      <div>
                          <img src="" />
                          <div>
                            <strong>Sexo</strong>
                            <a href="" class="boom-link">
                                Los 7 Lorem Posum más famosos de la vida, Lorem ipsum dolor sit</a>
                            <a href="" class="boom-link-go">Boom</a>
                          </div>
                      </div>
                      <span>publicado el 23/03/2012 - 230 visitas - 10 comentarios - 3 rebooms</span>
                  </li>
              </ul>
                  <div><a href="">Ver todos ></a></div>
              </div>
          </div>
      </div>      
  </header>
  <div role="main">
    <?php $view['slots']->output('_content') ?>
      <div>
          <div id="homepage-carousel" class="full-width-page wide-carousel">
              <div>
                  <a href="">
                      <img src="" />
                      >
                  </a>
              </div>
              <ul>
                  <li>
                      <a href="">
                          <img src="" alt="Text" />
                      </a>
                      <a hef="">
                          <h1>
                              Los 7 mejores discos del 2011
                          </h1>
                          <p>
                              Lorem ipsum mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe mñe 
                          </p>
                      </a>
                  </li>
              </ul>
          </div>
          <div class="2col-container">
              <div class="left-col">
                  <div class="numbered-feature-list">
                      <h2>Top semanal</h2>
                      <ol>
                          <li>
                              <span>
                                   1
                              </span>
                              <a href="">
                                  <img src="" />
                              </a>
                              <div>
                                  <strong></strong>
                                  <h3><a href="">Los 7 lorem ipsum mas famosos de la vida</a></h3>
                                  <p><a href="">Por Juan Perez</a> 22 de enero 2011</p>
                              </div>
                              
                          </li>
                      </ol>
                  </div>
                <div class="block-feature-list">
                      <h2>Booms de usuarios</h2>
                      <ol>
                          <li>
                              <span>
                                   1
                              </span>
                              <a href="">
                                  <img src="" />
                              </a>
                              <div>
                                  <strong>Categoria</strong>
                                  <h3><a href="">Los 7 lorem ipsum mas famosos de la vida</a></h3>
                                  <p>
                                      <a href="">Por Juan Perez</a>
                                      <span>22 de enero 2011</span>
                                  </p>
                              </div>                              
                          </li>
                      </ol>
                  </div>

              </div>
              <div class="right-col">
                  
              </div>              
          </div>
      </div>
  </div>
  <footer>
      <div>
          <strong>Sobre boom</strong>
          <p>
              Algo Algo Algo Algo Algo 
          </p>
          
      </div>
      
      <div>
          <strong>Tu marca en 7Boom</strong>
          <p>
              Algo Algo Algo Algo Algo 
          </p>
          
      </div>
      <div>
        <strong>Recibe nuestro newsletter</strong>
          <form>
              <input type="text" />
              <input type="email" />
              <input type="submit" />
          </form>
      </div>
  </footer>


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <!-- scripts concatenated and minified via build script -->
  <script src="<?php echo $view['assets']->getUrl('boom/js/plugins.js'); ?>"></script>
  <script src="<?php echo $view['assets']->getUrl('boom/js/script.js'); ?>"></script>
  <?php $view['slots']->output('javascripts') ?>
  <!-- end scripts -->

</body>
</html>