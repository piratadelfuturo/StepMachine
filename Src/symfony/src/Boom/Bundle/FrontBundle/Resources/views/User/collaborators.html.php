<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['slots']->set('layout_container_css_class','colaboradores'); ?>

<div class="lista-colaboradores">
    <h2 class="title-flag"><span>Colaboradores</span></h2>
    <ul>
        <?php foreach ($list as $element): ?>
            <li class="colab">
                <img src="<?php echo $element['imagepath'] ?>" height="147px" width="147px" >
                <div class="colab-info">
                    <h3 class="colaborador"><?php echo $element['firstname'] . ' ' . $element['lastname'] ?></h3>
                    <a class="no-booms" href="#">(<?php echo $element['booms']->count() ?> Booms)</a>
                    <p><?php echo $element['bio'] ?></p>
                    <div class="usr-options">
                        <a href="<?php echo $view['router']->generate('BoomFrontBundle_activity_follow', array('username' => $element['username'])) ?>" class="boton"><span class="seguir">seguir</span></a>
                        <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_profile', array('username' => $element['username'])) ?>" class="boton"><span class="seguir">ver perfil</span></a>
                </div>
                </div>
            </li>
        <?php endforeach; ?>
        <?php
        if ($total > $limit):
            $pagination = $view['boom_pagination']->paginationValues($page,$total);
            ?>
            <li class="pags">
                <ul class="paginador">
                    <?php if ($pagination['page'] > 1): ?>
                        <li><a href="<?php echo $view['router']->generate('BoomFrontBundle_user_collaborators', array('page' => 1)); ?>"><span class="pagina-prev">prev</span></a></li>
                    <?php endif; ?>
                    <?php foreach($pagination['$pages'] as $page): ?>
                    <li><a href="<?php echo $view['router']->generate('BoomFrontBundle_user_collaborators', array('page' => $page)); ?>"><span class="pagina"><?php echo $pagination['page'] ?></span></a></li>
                    <?php endforeach; ?>
                    <?php if ($pagination['page'] == 1 || $pagination['page'] != $pagination['total_pages']): ?>
                        <li><a href="<?php echo $view['router']->generate('BoomFrontBundle_user_collaborators', array('page' => $pagination['total_pages'])); ?>"><span class="pagina-next">next</span></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php
        endif;
        ?>
    </ul>
</div>