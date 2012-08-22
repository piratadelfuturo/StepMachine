<footer>
    <div id="f-cont">
        <ul>
            <li class="about">
                <h3><a href="#">Sobre 7Boom</a></h3>
                <p>Bacon ipsum dolor sit amet shankle pastrami t-bone, short ribs jowl ham tongue venison pork belly spare ribs tail. Hamburger flank ribeye, cow </p>
                <a href="#" id="fb-btn">facebook</a>
                <a href="#" id="tw-btn">twitter</a>
            </li>
            <li class="contact">
                <h3><a href="#">Tu marca en 7Boom</a></h3>
                <p>Bacon ipsum dolor sit amet shankle pastrami t-bone, short ribs <a href="#" >+ INFO</a></p>
                <p>Contacto</p>
                <p><a href="mailto:7boom@7boom.com">7BOOM@7BOOM.com</a></p>
            </li>
            <li class="newsletter">
                <h3><a href="#">Recibe nuestro newsletter</a></h3>
                <form>
                    <input type="text" name="fullname" placeholder="Nombre completo"/>
                    <input type="text" name="email" placeholder="Correo electrónico"/>
                    <input type="submit" value="ENVIAR"/>
                </form>
            </li>
        </ul>
    </div>
    <p id="copyright">Copyright © 2012 · All Rights Reserved · info@7boom.mx</p>
    <script type="text/javascript">
        (function(window){
            var logout = function(response,FBLogin){
                if((response.status == 'unknown' || response == true ) && FBLogin == true){
                    window.location.href = "<?php echo $view['router']->generate('BoomFrontBundle_logout') ?>";
                }

            }

            window.FBLogin = <?php echo $view['security']->isGranted('ROLE_FACEBOOK') ? 'true' : 'false'; ?>;

            window.onFbInit = function(response) {
                if (typeof(FB) != 'undefined' && FB != null ) {
                    FB.getLoginStatus(function(response){
                        //if(console&&response)console.log('init1',response,window.FBLogin);
                        logout(response,window.FBLogin);
                    });


                    FB.Event.subscribe('auth.statusChange', function(response) {
                        //if(console&&response)console.log('status',response,window.FBLogin);
                        if (!response.session || !response.authResponse) {
                            var FBLogin = function(){
                                if(response.status == 'connected' && window.FBLogin == false){
                                    window.location.href = "<?php echo $view['router']->generate('BoomFrontBundle_login_check_fb',array('_remember_me'=>'on')) ?>";
                                }else{
                                    logout(response,window.FBLogin);
                                }
                            }
                            setTimeout( FBLogin , 500);
                        } else {
                            logout(true,true);
                        }
                    });
                }
            }
        })(window);

    </script>
</footer>