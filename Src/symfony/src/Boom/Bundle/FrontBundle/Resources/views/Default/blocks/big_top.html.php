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
        $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],680,382) : 'http://placekitten.com/g/680/382'?>
    <div class="slide <?php echo $position == 1 ? 'active' : '' ?> cf">
        <a href="<?php echo $element['url'] ?>" class="img-container">
          <img src="<?php echo $image ?>" class="main-img" alt="<?php echo $view->escape($element['title']) ?>"/>
        </a>
        <div class="info-container">
          <h2><a href="<?php echo $element['url'] ?>"><?php echo $view->escape($element['title']) ?></a></h2>
          <p><?php echo $view->escape($element['summary']) ?></p>
        </div>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="car-thumbs">
    <ul>
      <?php
        $position = 0;
        foreach ($list as $element):
          $position++;
      ?>
      <?php $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],158,90) : 'http://placekitten.com/g/158/90'?>
      <li class="<?php echo $position == 1 ? 'active' : '' ?>">
        <p>
          <a href="# <?php //echo $element['url'] ?>">
            <?php echo $view->escape($element['title']) ?>
          </a>
        </p>
        <a href="# <?php //echo $element['url'] ?>">
          <img src="http://placehold.it/133x75" alt="<?php echo $view->escape($element['title']) ?>" />
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
