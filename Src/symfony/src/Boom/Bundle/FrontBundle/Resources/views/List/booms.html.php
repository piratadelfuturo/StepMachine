<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<h3><?php echo $view->escape(isset($page_title) ? $page_title : $entity['name']) ?></h3>
<?php echo $view->render('BoomFrontBundle:Boom:blocks/list.html.php', array(
            'list'  => $list
                ));
?>
