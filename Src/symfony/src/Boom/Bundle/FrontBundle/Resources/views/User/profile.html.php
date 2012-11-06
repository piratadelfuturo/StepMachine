<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->set('layout_container_css_class', 'colaboradores');
?>
<div class="profile">
    <div class="author-profile">
        <h3 class="title-flag">Perfil</h3>
        <div class="author-info cf" follow-url="<?php echo $view['router']->generate('BoomFrontBundle_activity_follow_check', array('username' => $entity['username'])); ?>" >
            <img src="<?php echo $view['boom_image']->getProfileImageUrl($entity['imagepath'],array(150,150)) ?>" height="147px" width="147px" >
            <h4><?php echo $view->escape($entity['firstname'] . ' ' . $entity['lastname']) ?></h4><p class="boom-n">(<?php echo $entity['booms']->count() ?> Booms)</p>
            <ul class="author-links">
                <?php if (!is_null($entity['facebookId']) || !empty($entity['facebookId'])): ?>
                    <li><a href="http://facebook.com/<?php echo $entity['facebookId'] ?>" target="_blank" class="btn-fb">facebook</a><a href="http://facebook.com/<?php echo $entity['facebookId'] ?>" target="_blank" ><?php echo $view->escape($entity['firstname'] . ' ' . $entity['lastname']) ?></a></li>
                <?php endif; ?>
                <?php if (!is_null($entity['twitterId']) || !empty($entity['twitterId'])): ?>
                    <!-- <li><a href="#" class="btn-tw">twitter</a><a href="#">@PhillipKDick</a></li> -->
                <?php endif; ?>

            </ul>
            <p class="author-bio"><?php echo $view->escape($entity['bio']) ?></p>
        </div>
    </div>
</div>
<?php
echo $view->render(
        'BoomFrontBundle:List:user.html.php', array(
    'list' => $list,
    'total' => $total,
    'page' => $page
        )
);
echo $view['boom_pagination']->renderPaginationBlock($app->getRequest()->get('_route'), $app->getRequest()->get('_route_params'), $total, $page);
?>

