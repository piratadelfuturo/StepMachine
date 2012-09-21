<div id="main-car">
    <a href="#" class="car-btn prev">prev</a>
    <a href="#" class="car-btn next">next</a>
    <?php
    $position = 0;
    if(!isset($list) || ($list === null || empty($list))){
        $list = array();
    }
    foreach ($list as $element):
        $position++;
        $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],680,382) : 'http://placekitten.com/g/680/382'?>
        <div class="slide <?php echo $position == 1 ? 'active' : '' ?> cf">
            <div class="img-container">
                <img src="<?php echo $image ?>" class="main-img" alt="<?php echo $view->escape($element['title']) ?>"/>
            </div>
            <h2><?php echo $view->escape($element['title']) ?></h2>
            <p><?php echo $view->escape($element['summary']) ?></p>
        </div>
    <?php endforeach; ?>
    <div id="carousel">
        <ul>
            <?php foreach ($list as $element): ?>
            <?php $image = isset($element['image']['path']) ? $view['boom_image']->getBoomImageUrl($element['image']['path'],158,90) : 'http://placekitten.com/g/158/90'?>
                <li>
                    <a href="<?php echo $element['url'] ?>">
                        <p><?php echo $view->escape($element['title']) ?></p>
                        <img src="<?php echo $image ?>" alt="<?php echo $view->escape($element['title']) ?>" />
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
