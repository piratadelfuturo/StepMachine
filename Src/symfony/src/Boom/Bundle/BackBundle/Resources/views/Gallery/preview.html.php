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
    </body>
</html>
