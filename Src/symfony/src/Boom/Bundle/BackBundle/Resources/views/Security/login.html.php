<?php $view->extend('BoomBackBundle:Security:layout.html.php') ?>

<?php if ($error): ?>
    <div><?php echo $error->getMessage() ?></div>
<?php endif; ?>
<form action="<?php echo $view['router']->generate('BoomBackBundle_login_check') ?>" method="post" id="loginform">
    <input type="hidden" name="_csrf_token" value="<?php echo $csrf_token ?>" />
    <fieldset>
        <section><label for="username">Username</label>
            <div><input type="text" id="username" name="_username" value="<?php echo $last_username ?>" autofocus></div>
        </section>
        <section><label for="password">Password</label>
            <div><input type="password" id="password" name="_password"></div>
            <div><input type="checkbox" id="remember" name="_remember_me" value="on" ><label for="remember" class="checkbox">remember me</label></div>
        </section>
        <section>
            <div><button type="submit" class="fr submit">Login</button></div>
        </section>
    </fieldset>
</form>
