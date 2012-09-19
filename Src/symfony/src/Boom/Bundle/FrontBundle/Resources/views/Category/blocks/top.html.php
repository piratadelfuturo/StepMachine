<div id="cat-car">
    <a href="#" class="car-btn prev">prev</a>
    <a href="#" class="car-btn next">next</a>
    <h3 class="title-flag"><span><?php echo $view->escape($category['name']) ?></span></h3>
    <ul>
        <?php
        $position = 0;
        if (!isset($list) || ($list === null || empty($list))) {
            $list = array();
        }

        foreach ($list as $element):
            $position++;
            ?>
            <?php $image = isset($element['image']) ? $element['image']['path'] : 'http://placekitten.com/680/382' ?>
            <li class="<?php echo $position == 1 ? 'active' : ''; ?>">
                <img src="<?php echo $image ?>">
                <div class="boom-info">
                    <h2><?php echo $view->escape($element['title']) ?></h2>
                    <p><?php echo $view->escape($element['summary']) ?></p>
                    <?php if ($element['boom'] !== NULL): ?>
                        <?php if ($element['boom']['user'] !== NULL): ?>
                        <a href="#" class="boom-moar">Por <?php echo $view->escape($element['boom']['user']['username']) ?>.</a>
                        <?php endif; ?>
                        <date><?php echo $element['boom']['datepublished']->format('D, d M y'); ?></date>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>