<div id="main-car">
  <div class="car-nav">
    <a href="#" class="car-btn prev">prev</a>
    <a href="#" class="car-btn next">next</a>
  </div>
  <div class="slide-container cf">
    <?php
    $position = 0;
    if(!isset($list) || ($list === null || empty($list))){
        $list = array();
    }
    foreach ($list as $element):
        $position++;
        $image = isset($element['image']['path']) ? $element['image']['path'] : 'http://placehold.it/677x381'?>
    <div class="slide <?php echo $position == 1 ? 'active' : '' ?> cf">
        <a href="#" class="img-container">
            <img src="<?php echo $image ?>" class="main-img" alt="<?php echo $view->escape($element['title']) ?>"/>
        </a>
        <div class="info-container">
          <h2><?php echo $view->escape($element['title']) ?></h2>
          <p><?php echo $view->escape($element['summary']) ?></p>
        </div>
    </div>
    <?php endforeach; ?>
  </div>
  <div id="car-thumbs">
    <ul>
      <?php
        $position = 0;
        foreach ($list as $element):
          $position++;
      ?>
      <?php $image = isset($element['image']['path']) ? $element['image']['path'] : 'http://placehold.it/133x75'?>
        <li class="<?php echo $position == 1 ? 'active' : '' ?>" >
          <a href="<?php echo $element['url'] ?>">
            <p><?php echo $view->escape($element['title']) ?></p>
            <img src="http://placehold.it/133x75" alt="<?php echo $view->escape($element['title']) ?>" />
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
