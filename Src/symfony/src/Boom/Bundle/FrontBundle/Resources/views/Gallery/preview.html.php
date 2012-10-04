<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
      	<style type="text/css">
          .gal-car {
            width: 590px;
            margin: 0 34px;
            overflow-x: hidden;
            background: #000;
            position: relative;
            overflow: hidden;
          }

          .gal-car .slide {
            float: left;
            position: relative;
            margin-left: 0;
            height: 380px;
          }

          .gal-car div.slide.active {
            display: block;
            position: relative;
            z-index: 8;
          }

          .gal-car div.slide.r-to-l {
            position: relative;
            display: block;
            left: 0;
          }

          .gal-car div.slide.l-to-r {
            position: relative;
            display: block;
            left: 0;
          }

          .gal-car .slide img {
          }

          .gal-car .car-thumbs ul {
          }

          .gal-car .car-thumbs li {
            height: 53px;
            display: inline-block;
            width: 78px;
            margin: 2px 1px;
            border: none;
          }
          .gal-car .car-thumbs li:after {
            content: ' ';
            height: 5px;
            width: 82px;
            margin-left: -2px;
            background: #e35344;
            background: -moz-linear-gradient(left,  #e35344 0%, #faa635 100%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0%,#e35344), color-stop(100%,#faa635));
            background: -webkit-linear-gradient(left,  #e35344 0%,#faa635 100%);
            background: -o-linear-gradient(left,  #e35344 0%,#faa635 100%);
            background: -ms-linear-gradient(left,  #e35344 0%,#faa635 100%);
            background: linear-gradient(to right,  #e35344 0%,#faa635 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e35344', endColorstr='#faa635',GradientType=1 );
          }

          .gal-car .car-thumbs li:hover:after, .gal-car .car-thumbs li.active:after {
            display: block;
          }

          .gal-car .car-thumbs li img {
          }

          .gal-car .car-nav .car-btn {
            position: absolute;
            background: url('images/gal_button.png') no-repeat;
            width: 26px;
            height: 49px;
            top: 165px;
            display: block;
            overflow: hidden;
            text-indent: -9000px;
            z-index: 9;

          }

          .gal-car .car-nav .car-btn.next {
            right: 0;
           -webkit-transform: rotate(180deg);
           -moz-transform: rotate(180deg);
           -ms-transform: rotate(180deg);
           -o-transform: rotate(180deg);
           transform: rotate(180deg);
          }

        </style>

    </head>
    <body>
        <?php
        echo $view->render(
                'BoomFrontBundle:Gallery:inline.html.php', array(
            'entity' => $entity
                )
        );
        ?>
        <script type="text/javascript">
            window.onclick = function(){
                if(window.parent.parent.tinymce){
                    var urlObject = {
                            'image'     : "<?php echo $view['router']->generate('BoomFrontBundle_image_ajax_create')?>",
                            'new'       : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_new')?>",
                            'create'    : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_create')?>",
                            'edit'      : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_edit',array('id' => '__id__'))?>",
                            'update'    : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_update',array('id' => '__id__'))?>"

                    };
                    window.tinymce = window.parent.parent.tinymce;
                    tinymce.execCommand('mceSelectNode', false,window.frameElement);
                    tinymce.execCommand('boomGallery',false,urlObject);
                }
            }
        </script>
    </body>
</html>
