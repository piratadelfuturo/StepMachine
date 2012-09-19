<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>

<?php var_dump($csrf_token) ?>
<div class="user-login">

<?php if(isset($error)): ?>
  <div class="box-error"><?php echo $error; ?></div>
<?php endif; ?>

<pre>
</pre>


<form action="" method="post">
  <input type="hidden" name="_csrf_token" value="<?php echo $csrfToken ?>" />
  <input type="text" id="username" name="_username" value="<?php echo $lastUsername ?>" />
  <input type="password" id="password" name="_password" placeholder="Password" />

  <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
  <label for="remember_me">Recordar</label>
  <input type="submit" id="_submit" name="_submit" value="Enviar" />
</form>

</div>
