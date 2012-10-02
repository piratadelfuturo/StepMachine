<div class="gal-car">
  <div class="car-nav">
    <a href="#" class="car-btn prev">prev</a>
    <a href="#" class="car-btn next">next</a>
  </div>
  <div class="slide-container cf">
    <?php
      $position = 0;
      $gallerySize = sizeof($entity['galleryimagerelations']);
      foreach ($entity['galleryimagerelations'] as $image):
            $position++;
    ?>
    <div class="slide <?php echo $position == 1 ? 'active' : '' ?> cf">
      <img src="<?php echo $view['boom_image']->getBoomImageUrl($image['image']['path'],590,380); ?>" />
    </div>
    <?php endforeach; ?>
  </div>
  <?php if ($gallerySize > 7):?>
  <div class="car-thumbs">
      <ul>
      <?php
      $position = 0;
      foreach ($entity['galleryimagerelations'] as $image):
          $position++;
      ?>
        <li class="<?php echo $position == 1 ? 'active' : '' ?>">
          <a href="# <?php //echo $element['url'] ?>">
            <img src="<?php echo $view['boom_image']->getBoomImageUrl($image['image']['path'],78,53); ?>"/>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif;?>
</div>



