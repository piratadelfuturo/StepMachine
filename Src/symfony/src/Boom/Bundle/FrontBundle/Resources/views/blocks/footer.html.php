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
        window.FBLogin = <?php echo $view['security']->isGranted('ROLE_FACEBOOK')? 'true':'false'; ?>;                
        
        window.onFbInit = function(response) {
            if (typeof(FB) != 'undefined' && FB != null ) {
                FB.getLoginStatus(function(response){});
                
                FB.logout(function(response) {
                    window.location.href = "<?php echo $view['router']->generate('BoomFrontBundle_logout') ?>";
                });
                
                FB.Event.subscribe('auth.statusChange', function(response) {
                    if (!response.session || !response.authResponse) {
                        var FBLogin = function(){
                            var resp = response;
                            if(resp.status == 'connected' && window.FBLogin == false){
                                window.location.href = "<?php echo $view['router']->generate('BoomFrontBundle_login_check_fb') ?>";
                            }
                        }
                        setTimeout( FBLogin , 500);                        
                    } else {
                        window.location.href = "<?php echo $view['router']->generate('BoomFrontBundle_logout') ?>";
                    }
                });
            }                        
           }
        })(window);
        
    </script>
</footer>