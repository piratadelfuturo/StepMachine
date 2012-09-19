<section>
    <section>
      <?php echo $view['form']->label($form, $label,$label_attr) ?>
    </section>
    <div>
      <?php
      echo $view['form']->errors($form);
      //var_dump(get_defined_vars());
      //exit;
      ?>
      <img id="<?php echo $parameters['id'].'_img' ?>"src="<?php echo $data['path'] === null ? '' : $view['boom_image']->getBoomImageUrl($data['path'],158,90)?>" />
      <?php echo $view['form']->widget($form['id']) ?>
      <?php echo $view['form']->widget($form['file']) ?>
    </div>
</section>