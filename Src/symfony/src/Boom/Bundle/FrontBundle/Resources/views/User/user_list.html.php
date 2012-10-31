<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->set('layout_container_css_class', 'colaboradores');
?>
<div class="lista-colaboradores">
    <h2 class="title-flag"><span><?php echo $view->escape(isset($page_title) ? $page_title : '' ) ?></span></h2>
    <ul>
        <?php foreach ($list as $element): ?>
            <li class="colab">
                <img src="<?php echo $element['imagepath'] ?>" height="147px" width="147px" >
                <div class="colab-info">
                    <h3 class="colaborador"><?php echo $element['firstname'] . ' ' . $element['lastname'] ?></h3>
                    <p><?php echo $view->escape($element['bio']) ?></p>
                </div>
                <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $element['username'])) ?>" class="boton">
                    <span class="seguir">ver perfil</span>
                </a>

            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php echo $view['boom_pagination']->renderPaginationBlock($app->getRequest()->get('_route'),$app->getRequest()->get('_route_params'),$total, $page); ?>
