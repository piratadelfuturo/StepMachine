<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['slots']->set('layout_container_css_class','category category-'.$category['slug']); ?>
<?php
    if( count($top['listelements']) > 0 ){
    echo $view->render('BoomFrontBundle:Category:blocks/top.html.php', array(
            'title'     => 'top semanal',
            'category'  => $category,
            'list'      => $top['listelements']
                ));
    }
?>

    <?php echo $view->render('BoomFrontBundle:Boom:blocks/block_list.html.php', array(
            'title'     => 'recomendados',
            'category'  => $category,
            'list'  => $featured,
            'more_url'  => $view['router']->generate(
                    'BoomFrontBundle_list_category_recommended',
                    array(
                        'slug' => $category['slug']))
                ));
?>

    <?php echo $view->render('BoomFrontBundle:Boom:blocks/long_list.html.php', array(
            'title'     => 'ÚLTIMOS',
            'category'  => $category,
            'list'  => $latest,
            'more_url'  => $view['router']->generate(
                    'BoomFrontBundle_list_category_latest',
                    array(
                        'slug' => $category['slug']))
                ));
?>
