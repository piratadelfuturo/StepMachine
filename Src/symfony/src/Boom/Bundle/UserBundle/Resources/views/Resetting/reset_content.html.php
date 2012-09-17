<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<div class="pass-page">
  <h3 class="short-bar">Recuperar Password</h3>
  <p class="lab">Ok, ya vimos que no te gustó tu antigua contraseña, <br />
    ahora sólo escribe la nueva un par de veces.</p>
  <form action="<?php echo $view['router']->generate('fos_user_resetting_reset',array('token' => $token)); ?>"
      <?php echo $view['form']->enctype($form) ?> method="POST" class="fos_user_resetting_reset">
        <?php echo $view['form']->widget($form['_token']); ?>
      <div class="grad-border">
        <?php echo $view['form']->widget($form['new']['first'], array('attr' => array( 'class' => 'cp-new', 'placeholder' => 'Introduce tu nueva contraseña...' ) )); ?>
      </div>
      <div class="grad-border">
        <?php echo $view['form']->widget($form['new']['second'], array('attr' => array( 'class' => 'cp-confirm', 'placeholder' => 'Una vez más, para estar seguros...' ) )); ?>
      </div>
      <div>
          <input type="submit" value="Reset" />
      </div>
  </form>
</div>
