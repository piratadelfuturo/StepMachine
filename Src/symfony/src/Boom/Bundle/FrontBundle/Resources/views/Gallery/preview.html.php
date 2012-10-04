<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
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
