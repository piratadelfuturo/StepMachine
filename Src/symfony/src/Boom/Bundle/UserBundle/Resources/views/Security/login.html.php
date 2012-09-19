<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>

<div class="user-login pass-page">

<?php if(isset($error)): ?>
  <div class="box-error"><?php echo $error; ?></div>
<?php endif; ?>

<form action="login_check" method="post">
  <input type="hidden" name="_csrf_token" value="<?php echo $csrf_token ?>" />
  <div class="grad-border">
    <input type="text" id="username" name="_username" placeholder="Cuenta de usuario" value="<?php echo $last_username ?>" />
  </div>
  <div class="grad-border">
    <input type="password" id="password" name="_password" placeholder="Password" />
  </div>
  <div class="rem-container">
    <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
    <label for="remember_me" class="lab">Recordar contraseña</label>
  </div>
  <input type="submit" id="_submit" name="_submit" value="Enviar" />
</form>

</div>
