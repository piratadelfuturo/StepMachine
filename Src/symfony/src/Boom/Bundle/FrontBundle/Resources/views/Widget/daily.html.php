<?php if(!empty($data)): ?>
<div class="diarios sb-bloque">
    <h3>
        <span>7 diarios</span>
    </h3>
    <h4><?php echo isset($data['name']) ? $data['name'] : ''?></h4>
    <ul>
        <?php
        if (isset($data['list'])):
            foreach ($data['list'] as $key => $element):
                $key++;
                ?>
                <li class="<?php echo $key % 2 == 0 ? 'bgray' : ''; ?>">
                    <span class="place"><?php echo $key ?></span>
                    <p class="punto"><?php echo $element['line_1']; ?></p>
                    <p class="excerpt"><?php echo $element['line_2'] ?></p>
                </li>
            <?php endforeach;
        endif;
        ?>
    </ul>
</div>
<?php endif; ?>
