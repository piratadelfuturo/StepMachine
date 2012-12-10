<div id="main-car" class="cat-car">
    <a href="#" class="car-btn prev">prev</a>
    <a href="#" class="car-btn next">next</a>
    <h3 class="title-flag"><span><?php echo $view->escape($category['name']) ?></span></h3>
    <div class="slide-container cf">
      <?php
        $position = 0;
        if (!isset($list) || ($list === null || empty($list))) {
            $list = array();
        }

        foreach ($list as $element):
            $position++;
            ?>
            <?php $image = isset($element['image']) ? $view['boom_image']->getBoomImageUrl($element['image']['path']) : 'http://placekitten.com/680/382' ?>
            <div class="slide <?php echo $position == 1 ? 'active' : ''; ?> cf">
              <a href="<?php echo $element['url'] ?>" class="img-container">
                <img src="<?php echo $image ?>" class="main-img" alt="<?php echo $view->escape($element['title']) ?>"/>
              </a>
              <div class="info-container">
                <h2><a href="<?php echo $element['url'] ?>"><?php echo $view->escape($element['title']) ?></a></h2>
                <p><?php echo $view->escape($element['summary']) ?></p>
                <?php if ($element['boom'] !== NULL): ?>
                  <?php if ($element['boom']['user'] !== NULL): ?>
                    <a href="#" class="boom-moar">Por <?php echo $view->escape($element['boom']['user']['name']) ?>.</a>
                  <?php endif; ?>
                  <date><?php echo $element['boom']['datepublished']->format('D, d M y'); ?></date>
                <?php endif; ?>
              </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
