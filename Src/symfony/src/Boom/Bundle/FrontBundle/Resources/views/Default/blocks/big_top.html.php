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
        $image = isset($element['image']['path']) ? $element['image']['path'] : 'http://placekitten.com/g/677/381'?>
        <div class="<?php echo $position == 1 ? 'active' : '' ?> cf">
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
            <?php $image = isset($element['image']['path']) ? $element['image']['path'] : 'http://placekitten.com/133/75'?>
                <li>
                    <a href="<?php echo $element['url'] ?>">
                        <p><?php echo $view->escape($element['title']) ?></p>
                        <img src="http://placekitten.com/133/75" alt="<?php echo $view->escape($element['title']) ?>" />
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
