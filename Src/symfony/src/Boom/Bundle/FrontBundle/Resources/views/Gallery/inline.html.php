<div id="main-car" class="gal-car">
  <div class="car-nav">
    <a href="#" class="gal-btn prev">prev</a>
    <a href="#" class="gal-btn next">next</a>
  </div>
  <div class="slide-container cf">
    <?php
      $position = 0;
      $gallerySize = sizeof($entity['galleryimagerelations']);
      foreach ($entity['galleryimagerelations'] as $image):
            $position++;
    ?>
    <div class="slide <?php echo $position == 1 ? 'active' : '' ?> cf">
      <img src="<?php echo $view['boom_image']->getBoomImageUrl($image['image']['path'],680,382); ?>" />
    </div>
    <?php endforeach; ?>
  </div>
  <?php if ($gallerySize > 7):?>
  <div class="gal-thumbs">
      <ul>
      <?php
        $position = 0;
      foreach ($entity['galleryimagerelations'] as $image):
          $position++;
      ?>
      <li class="<?php echo $position == 1 ? 'active' : '' ?>">
        <img src="<?php echo $view['boom_image']->getBoomImageUrl($image['image']['path'],133,75); ?>"/>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif;?>
</div>



