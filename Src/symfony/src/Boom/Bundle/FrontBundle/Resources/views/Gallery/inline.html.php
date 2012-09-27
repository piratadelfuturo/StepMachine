<ul>
    <?php foreach ($entity['galleryimagerelations'] as $image): ?>
        <li>
            <img src="<?php echo $view['boom_image']->getBoomImageUrl($image['image']['path'],158,90); ?>" />
        </li>
    <?php endforeach; ?>
</ul>