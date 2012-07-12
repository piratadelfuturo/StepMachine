<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>7boom</title>
  <?php Asset::css(array('webfonts.css', 'style.css'), array(
      'media' => 'screen',
      'charse' => 'utf-8'
  ), 'layout.css', false); ?>
  <?php echo Asset::render('layout.css'); ?>
  <!--[if gte IE 9]>
    <style type="text/css">.gradient {filter: none;}</style>
  <![endif]-->
</head>
<body class="gradient">
  <div id="fb-root"></div>
  <header>
    <?php echo $view['header'];?>
  </header>
  <div id="container">
    <?php echo $view['user'];?>   
    <?php echo $view['content'];?>      
    <aside>
      <div class="banner1 sb-bloque">
        BANNER
      </div>
      <div class="fb-wdgt sb-bloque">
        <h3><span>facebook</span></h3>
        <div class="fb-like-box" data-href="http://www.facebook.com/negativeyouth" data-width="300" data-height="335" data-show-faces="true" data-border-color="aaabab" data-stream="false" data-header="false"></div>
      </div>
      <div class="tw-wdgt sb-bloque">
        <h3><span>twitter</span></h3>
      </div>
      <div class="colab-wdgt sb-bloque">
        <h3><span>colaboradores</span></h3>
        <ul>
          <li>
            <a href="#"><img src="http://placehold.it/60x60"/><h4 class="autor">Phillip K. Dick</h4><p class="last-boom">ultimo boom</p></a>
          </li>
          <li class="bgrey">
            <a href="#"><img src="http://placehold.it/60x60"/><h4 class="autor">Phillip K. Dick</h4><p class="last-boom">ultimo boom</p></a>
          </li>
          <li>
            <a href="#"><img src="http://placehold.it/60x60"/><h4 class="autor">Phillip K. Dick</h4><p class="last-boom">ultimo boom</p></a>
          </li>
          <li class="bgrey">
            <a href="#"><img src="http://placehold.it/60x60"/><h4 class="autor">Phillip K. Dick</h4><p class="last-boom">ultimo boom</p></a>
          </li>
          <li>
            <a href="#"><img src="http://placehold.it/60x60"/><h4 class="autor">Phillip K. Dick</h4><p class="last-boom">ultimo boom</p></a>
          </li>
        </ul>
        <a href="#"><span class="ver-all"><p>Ver todos<p></span></a>
      </div>
      <div class="diarios sb-bloque">
        <h3>
          <span>7 diarios<span>
        </h3>
        <h4>7 consejos para el apocalipsis</h4>
        <ul>
          <li>
            <span class="place">1</span>
            <p class="punto">que dios te agarre confesado</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
            </li>
          <li class="bgrey">
            <span class="place">2</span>
            <p class="punto">que dios te agarre confesado</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
          </li>
          <li>
            <span class="place">3</span>
            <p class="punto">que dios te agarre confesado</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
          </li>
          <li class="bgrey">
            <span class="place">4</span>
            <p class="punto">que dios te agarre confesado</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
          </li>
          <li>
            <span class="place">5</span>
            <p class="punto">MÁS VALE DECIR “AQUÍ CORRIÓ” QUE “AQUÍ MURIÓ”</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
            </li>
          <li class="bgrey">
            <span class="place">6</span>
            <p class="punto">que dios te agarre confesado</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
          </li>
          <li>
            <span class="place">7</span>
            <p class="punto">que dios te agarre confesado</p>
            <p class="excerpt">Record holder. Now Toyota Prius and URDB are</p>
          </li>
        </ul>
      </div>


    </aside>
  </div>
    <?php echo $view['footer'];?>
</body>
</html>