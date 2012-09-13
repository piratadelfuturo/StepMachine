<form action="<?php echo $view['router']->generate('fos_user_resetting_send_email') ?>" method="POST" class="fos_user_resetting_request pass-page">
    <div>
        <?php if (isset($invalid_username)): ?>
            <p class="lab">El nombre de usuario no existe</p>
        <?php endif; ?>
        <?php if ($app->getUser() === null): ?>
          <h3 class="short-bar">Recuperar Password</h3>
          <label for="username" class="lab">¿A quién quieres engañar? </br>
            Ah verdad, casi lloras. Todo estará bien, respira 7 veces,</br>
            escribe tu nombre de usuario y podrás recuperar tu contraseña de inmediato.</label>
          <div class="grad-border">
            <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" />
          </div>
          <?php else: ?>
          <p class="lab">Da click en el botón para cambiar tu contraseña.</p>
        <?php endif; ?>
    </div>
    <div class="sub-btn">
        <input type="submit" value="Enviar" />
    </div>
</form>
