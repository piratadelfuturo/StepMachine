<section>
    <section>
      <?php echo $view['form']->label($form, $label,$label_attr) ?>
    </section>
    <div>
      <?php echo $view['form']->errors($form) ?>
      <?php echo $view['form']->widget($form, $parameters) ?>
    </div>
</section>
