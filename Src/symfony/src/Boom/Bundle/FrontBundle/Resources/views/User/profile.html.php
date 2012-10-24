<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['slots']->set('layout_container_css_class','colaboradores'); ?>
USUARIO
BOOMS
<?php if ($total > $limit):
    $pagination = $view['boom_pagination']->paginationValues($page,$total);
    var_dump($pagination);
endif;
?>
