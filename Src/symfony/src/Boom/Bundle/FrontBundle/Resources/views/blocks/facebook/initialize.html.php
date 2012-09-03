<div id="fb-root"></div>
<?php if (empty($async)) { ?>
<script type="text/javascript" src="http://connect.facebook.net/<?php echo $culture ?>/all.js"></script>
<?php } ?>
<script type="text/javascript">
<?php if (!empty($async)) { ?>
window.fbAsyncInit = function() {
<?php }?>
  FB.init(<?php echo json_encode(array(
    'appId'   => $appId,
    'xfbml'   => $xfbml,
    'status' =>  $status,
    'cookie'  => $cookie,
    'logging' => $logging)) ?>);
<?php if (!empty($async)): ?>
    <?php echo $fbAsyncInit ?>
  };
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/<?php echo $culture ?>/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
<?php endif; ?>
</script>
