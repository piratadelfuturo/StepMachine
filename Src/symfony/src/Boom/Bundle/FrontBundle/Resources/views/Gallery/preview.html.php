<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-Equiv="Cache-Control" Content="no-cache">
        <meta http-Equiv="Pragma" Content="no-cache">
        <meta http-Equiv="Expires" Content="0">
        <title>Preview galería</title>
        <script type="text/javascript">
                !function(e,t){if(typeof module!="undefined")module.exports=t();else if(typeof define=="function"&&typeof define.amd=="object")define(t);else this[e]=t()}("domready",function(e){function h(e){c=1;while(e=t.shift())e()}var t=[],n,r=false,i=document,s=i.documentElement,o=s.doScroll,u="DOMContentLoaded",a="addEventListener",f="onreadystatechange",l="readyState",c=/^loade|c/.test(i[l]);i[a]&&i[a](u,n=function(){i.removeEventListener(u,n,r);h()},r);o&&i.attachEvent(f,n=function(){if(/^c/.test(i[l])){i.detachEvent(f,n);h()}});return e=o?function(n){self!=top?c?n():t.push(n):function(){try{s.doScroll("left")}catch(t){return setTimeout(function(){e(n)},50)}n()}()}:function(e){c?e():t.push(e)}});
            function listen(evnt, elem, func) {
                if (elem.addEventListener)  // W3C DOM
                    elem.addEventListener(evnt,func,false);
                else if (elem.attachEvent) { // IE DOM
                    var r = elem.attachEvent("on"+evnt, func);
                    return r;
                }
            }
            var urlObject = {
                'image'     : "<?php echo $view['router']->generate('BoomFrontBundle_image_ajax_create') ?>",
                'new'       : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_new') ?>",
                'create'    : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_create') ?>",
                'edit'      : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_edit', array('id' => '__id__')) ?>",
                'update'    : "<?php echo $view['router']->generate('BoomFrontBundle_gallery_ajax_update', array('id' => '__id__')) ?>",
                'iframe'    : window.frameElement
            };

            domready(function(){
                if(window.parent.parent.tinymce){
                    window.tinymce = window.parent.parent.tinymce;
                    listen('click',window,function(){
                        if(window.tinymce){
                            tinymce.execCommand('mceSelectNode', false,window.frameElement);
                            tinymce.execCommand('boomGallery',false,urlObject);
                        }
                        return false;
                    });
                }

            })
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('/bundles/boomfront/css/gal-style.css'); ?>">
    </head>
    <body><?php echo $view->render('BoomFrontBundle:Gallery:inline.html.php', array('entity' => $entity)); ?></body>
</html>