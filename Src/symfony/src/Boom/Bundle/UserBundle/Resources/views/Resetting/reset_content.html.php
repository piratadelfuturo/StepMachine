<form action="<?php echo $view['router']->generate('fos_user_resetting_reset',array('token' => $token)); ?>"
      <?php echo $view['form']->enctype($form) ?> method="POST" class="fos_user_resetting_reset">
    <?php echo $view['form']->widget($form) ?>
    <div>
        <input type="submit" value="Reset" />
    </div>
</form>
