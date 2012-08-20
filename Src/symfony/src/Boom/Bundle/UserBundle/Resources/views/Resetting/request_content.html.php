<form action="<?php echo $view['router']->generate('fos_user_resetting_send_email') ?>" method="POST" class="fos_user_resetting_request">
    <div>
        <?php if (isset($invalid_username)): ?>
            <p> Usuario no existe</p>
        <?php endif; ?>
        <?php if ($app->getUser() === null): ?>
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" />
        <?php endif; ?>
    </div>
    <div>
        <input type="submit" value="Reset password" />
    </div>
</form>
