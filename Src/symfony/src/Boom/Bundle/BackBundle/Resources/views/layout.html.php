<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">

        <title>Boombox - <?php $view['slots']->output('title', 'likes your luck') ?></title>

        <meta name="description" content="<?php $view['slots']->output('title', 'likes your luck') ?>">

        <!-- Google Font and style definitions -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/style.css') ?>">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/light/theme.css') ?>" id="themestyle">

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/ie.css') ?>">
        <![endif]-->

        <!-- Apple iOS and Android stuff -->
        <meta name="apple-mobile-web-app-capable" content="no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

        <!-- Apple iOS and Android stuff - don't remove! -->
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">

        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/fosjsrouting/js/router.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $view['router']->generate('fos_js_routing_js', array('callback' => 'fos.Router.setData')) ?>"></script>

        <!-- Use Google CDN for jQuery and jQuery UI -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script> -->

        <!-- Loading JS Files this way is not recommended! Merge them but keep their order -->

        <!-- some basic functions -->
        <?php
        $js = array(
            'js/lib/jquery-1.8.2.js',
            'js/lib/jquery-ui-1.8.23.custom.min.js',
            'js/lib/file_upload/js/jquery.iframe-transport.js',
            'js/lib/file_upload/js/jquery.fileupload.js',
            'js/lib/jquery.boomAjaxUpload.js',
            'js/lib/tiny_mce/tiny_mce.js',
            'js/lib/tiny_mce/jquery.tinymce.js',
            'js/jquery.pagination.js',
            'js/functions.js',
            'js/plugins.js',
            'js/editor.js',
            'js/calendar.js',
            'js/flot.js',
            'js/elfinder.js',
            'js/datatables.js',
            'js/wl_Alert.js',
            'js/wl_Autocomplete.js',
            'js/wl_Breadcrumb.js',
            'js/wl_Calendar.js',
            'js/wl_Chart.js',
            'js/wl_Color.js',
            'js/wl_Date.js',
            'js/wl_Editor.js',
            'js/wl_File.js',
            'js/wl_Dialog.js',
            'js/wl_Fileexplorer.js',
            'js/wl_Form.js',
            'js/wl_Gallery.js',
            'js/wl_Multiselect.js',
            'js/wl_Number.js',
            'js/wl_Password.js',
            'js/wl_Slider.js',
            'js/wl_Store.js',
            'js/wl_Time.js',
            'js/wl_Valid.js',
            'js/wl_Widget.js',
            'js/config.js',
            'js/script.js');
        foreach ($js as $jsUnit):
            ?>
            <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/' . $jsUnit); ?>"></script>
            <?php
        endforeach;
        ?>


    </head>
    <body>
        <?php echo $view->render('BoomBackBundle::blocks/pageOptions.html.php'); ?>

        <?php echo $view->render('BoomBackBundle::blocks/header.html.php'); ?>

        <?php echo $view->render('BoomBackBundle::blocks/nav.html.php'); ?>

        <section id="content">
            <div class="g12">
                <?php $view['slots']->output('_content') ?>
            </div>
        </section>
        <footer>brutalcontent.com 2012</footer>
    </body>
</html>