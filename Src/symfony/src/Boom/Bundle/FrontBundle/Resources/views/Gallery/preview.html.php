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
                    window.tinymce = window.parent.parent.tinymce;
                    tinymce.execCommand('mceSelectNode', false,window.frameElement);
                    tinymce.execCommand('boomGallery');
                }
            }
        </script>
    </body>
</html>
