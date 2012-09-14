<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<div class="pass-page">
  <h3 class="short-bar">Recuperar Password</h3>
  <p class="lab">Ok, ya vimos que no te gustó tu antigua contraseña, <br />
    ahora sólo escribe la nueva un par de veces.</p>
  <form action="<?php echo $view['router']->generate('fos_user_resetting_reset',array('token' => $token)); ?>"
      <?php echo $view['form']->enctype($form) ?> method="POST" class="fos_user_resetting_reset">
      <div class="grad-border">
        <?php echo $view['form']->widget($form) ?>
      </div>

      <div>
          <input type="submit" value="Reset" />
      </div>
  </form>
</div>
