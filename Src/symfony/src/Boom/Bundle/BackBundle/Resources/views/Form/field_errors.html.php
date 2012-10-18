<?php var_dump($errors);?>
<?php if($errors):?>
<div class="alert info">
<?php echo $view['form']->block($form, 'form_errors') ?>
</div>
<?php endif; ?>