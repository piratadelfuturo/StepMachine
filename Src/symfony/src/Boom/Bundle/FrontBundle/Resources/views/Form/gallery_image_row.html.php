<li>
    <a target="_blank">
        <img id="<?php echo $parameters['id'] . '_img' ?>"src="<?php echo $data['image']['path'] === null ? '' : $view['boom_image']->getBoomImageUrl($data['image']['path'], 116, 116) ?>" />
    </a>
    <?php echo $view['form']->widget($form['image']) ?>
    <?php echo $view['form']->widget($form['position']) ?>
</li>