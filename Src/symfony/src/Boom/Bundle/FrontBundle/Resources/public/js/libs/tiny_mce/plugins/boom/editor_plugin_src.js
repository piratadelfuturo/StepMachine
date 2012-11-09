/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
    var uploader_forms = {};

    tinymce.create('tinymce.plugins.BoomPlugin', {
        _galleryPreviewUrl: null,
        init : function(ed, url) {
            var t = this;
            t['_galleryPreviewUrl'] = $(ed.getElement()).attr('gallery-preview');
            ed.onBeforeSetContent.add(function(ed, o) {
                o.content = t['_bbcode2html'](o.content);
            });
            ed.onPostProcess.add(function(ed, o) {
                if (o.set){
                    o.content = t['_bbcode2html'](o.content);
                }
                if (o.get){
                    o.content = t['_html2bbcode'](o.content);
                }
            });

            ed.addCommand('boomVideo', function() {
                var videoForm, videoLabel, videoText;
                videoForm = $(document.createElement('form')).css({
                    height:'100%'
                });
                videoLabel = $(document.createElement('label')).text('Pega el iframe embed de Vimeo o Youtube:');
                videoText = $(document.createElement('textarea')).css({
                    resize:'none',
                    width:'100%',
                    height:'85%'
                });
                videoForm.append(videoLabel,videoText);
                var dialog = $(document.createElement('div'));
                dialog.dialog({
                    title:'Video',
                    autoOpen: false,
                    width: 680,
                    height: 200,
                    resizable: false,
                    modal: true,
                    buttons: {
                        'Insertar' : function(){
                            var wrap = $(document.createElement('div')).append(videoText.val());
                            var iframe = wrap.find('iframe',0);
                            var clean = $(document.createElement('div')).append(iframe);
                            var allowed = [
                                'http://www.youtube.com',
                                'https://www.youtube.com',
                                'http://player.vimeo.com',
                                'https://player.vimeo.com'
                            ],i=0;
                            for(i=0;i<=allowed.length-1;i++){
                                if(clean.html() !== '' && iframe.attr('src').indexOf(allowed[i]) == 0){
                                    ed.focus();
                                    ed.execCommand('mceInsertContent',false,clean.html());
                                    dialog.dialog( "close" )
                                    return true;
                                    break;
                                }
                            }
                            return false;
                        },
                        'Cerrar': function() {
                            dialog.dialog( "close" )
                            return true;
                        }
                    },
                    close:function(){
                        dialog.remove();
                        return true;
                    }
                });
                dialog.append(videoForm).dialog('open');
            });
            ed.addCommand('boomImage', function(flag,image_url) {
                var formImageUpload,inputImageUpload;
                if(uploader_forms[ed.id]){
                    formImageUpload = uploader_forms[ed.id]
                    inputImageUpload = formImageUpload.find('input[type=file]')
                }else{
                    formImageUpload = $(document.createElement('form')).attr('method','post')
                    .attr('id',ed.id+'_uploader').hide();
                    inputImageUpload = $(document.createElement('input')).attr({
                        'name':'files',
                        'type':'file',
                        'multiple':'multiple'
                    });
                    formImageUpload.append(inputImageUpload);
                    uploader_forms[ed.id] = formImageUpload;
                    var builtUrl = image_url+'?'+$.param(
                    {
                        path: inputImageUpload.attr('name'),
                        _format:'json',
                        w: 158,
                        h: 90
                    });
                    inputImageUpload.boomAjaxUpload({
                        url: builtUrl,
                        done: function(e, data){
                            if(data.result.id){
                                ed.execCommand('mceInsertContent',false,'<img src="'+data.result.path+'" />');
                            }
                        }
                    });
                    $(document).append(formImageUpload);
                }
                inputImageUpload.click();
            });


            ed.addCommand('boomGallery', function(flag,image_url,frameElement) {
                var form, formRoute = {},response,
                dialog = $(document.createElement('div')),
                node = image_url.iframe||ed.selection.getNode(),
                formUpload = $(document.createElement('form')).attr('method','post').hide(),
                inputUpload = $(document.createElement('input')).attr({
                    'name':'files',
                    'type':'file',
                    'multiple':'multiple'
                });
                formUpload.append(inputUpload);
                dialog.append(formUpload);
                formRoute['form'] = {};
                formRoute['form']['name'] = image_url['new'];
                formRoute['save'] = {};
                formRoute['save']['name'] = image_url['create'];
                if($(node).hasClass('gallery-preview') && $(node).attr('insert-id')){
                    formRoute['form']['name'] = image_url['edit'].replace('__id__',$(node).attr('insert-id'));
                    formRoute['save']['name'] = image_url['update'].replace('__id__',$(node).attr('insert-id'));
                }
                formRoute['image'] = image_url['image']+'?'+$.param(
                {
                    path: inputUpload.attr('name'),
                    _format:'json',
                    w: 116,
                    h: 116
                });

                dialog.dialog({
                    title:'Galería',
                    autoOpen: false,
                    width: 680,
                    height: 400,
                    resizable: false,
                    modal: true,
                    buttons: {
                        'Cerrar': function() {
                            dialog.dialog( "close" )
                        }
                    },
                    close:function(){
                        dialog.remove();
                    }
                });
                dialog.dialog('open');
                $.get(
                formRoute['form']['name'],
                function(data){
                    dialog.append(data);
                    form = dialog.find('form',0);
                    var buttons= {
                        'Borrar': function(){
                            ed.dom.remove(node);
                        },
                        'Agregar Imagen' : function(){
                            inputUpload.click();
                        },
                        'Guardar': function(){
                            $.post(
                            formRoute['save']['name'],
                            $(form).serialize(),
                            function(data){
                                tinymce.execCommand('mceSelectNode', false,node);
                                var html = '<iframe class="gallery-preview" insert-id="'+data.id+'" src="/gal/preview/'+data.id+'" scrolling=\"no\" height=\"405\" width=\"550\" frameborder=\"0\" ></iframe>';
                                if(image_url.iframe){
                                    image_url.iframe.contentDocument.location.reload(true);
                                }else{
                                    ed.selection.setContent(html);
                                }
                                dialog.dialog( "close" );
                            }
                        );
                        },
                        'Cancelar': function() {
                            dialog.dialog( "close" );
                        }
                    },list = form.find('ul',0);
                    dialog.dialog( "option","buttons",buttons);
                    list.sortable({
                        tolerance: 'pointer',
                        stop: function(event, ui){
                            var elements = $(ui.item).parent().find('input[type=hidden][id$=_position]');
                            elements.each(function(i){
                                $(this).val(i);
                            });
                        }
                    }).disableSelection();

                    inputUpload.boomAjaxUpload({
                        url: formRoute['image'],
                        done: function(e,data){
                            if(data.result.id){
                                var number = list.children().length;
                                var prototype = list.attr('data-prototype');
                                var transferElement = $(prototype.replace(/__name__/g, number));
                                transferElement.find('img',0).attr('src',data.result.path);
                                transferElement.find('input[type=hidden][id$=_image]',0).val(data.result.id);
                                transferElement.find('input[type=hidden][id$=_position]',0).val(number);
                                list.append(transferElement);
                            }
                        }
                    });
                });
            });

            ed.addCommand('boomLink', function() {
                var linkForm, linkLabel, linkText, node, buttons;
                linkForm = $(document.createElement('form')).css({
                    height:'100%'
                });
                linkLabel = $(document.createElement('label')).text('Inserta una liga hacia algun boom:');
                linkText = $(document.createElement('textarea')).css({
                    resize:'none',
                    width:'100%',
                    height:'85%'
                });
                linkForm.append(linkLabel,linkText);
                node = $(ed.selection.getNode());
                buttons = [
                    {
                        text: 'Insertar',
                        click: function(){
                            var value = linkText.val();
                            if(value.indexOf(window.location.protocol+'//'+window.location.hostname) == 0){
                                ed.focus();
                                ed.execCommand('mceInsertLink',false,value);
                                dialog.dialog( "close" )
                                return true;
                            }
                        }
                    },
                    {
                        text: 'Cerrar',
                        click: function() {
                            dialog.dialog( "close" )
                            return true;
                        }
                    }
                ];

                if(node.attr('href')){
                    linkText.val(node.attr('href'));
                    buttons.unshift({
                        text: 'Quitar',
                        click: function(){
                            ed.focus();
                            ed.formatter.remove('link');
                            dialog.dialog( "close" )
                            return true
                        }
                    });
                }
                var dialog = $(document.createElement('div'));
                dialog.dialog({
                    title:'Link',
                    autoOpen: false,
                    width: 500,
                    height: 200,
                    resizable: false,
                    modal: true,
                    buttons: buttons,
                    close:function(){
                        dialog.remove();
                        return true;
                    }
                });
                dialog.append(linkForm).dialog('open');
            });

        },
        getInfo : function() {
            return {
                longname : 'Boom Plugin',
                author : 'Brutus Content',
                authorurl : 'http://www.brutalcontent.com',
                infourl : 'http://www.brutalcontent.com',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        },
        // HTML -> BBCode in PunBB dialect
        _html2bbcode : function(s) {
            s = tinymce.trim(s);

            function rep(re, str) {
                s = s.replace(re, str);
            };

            // example: <strong> to [b]
            rep(/<div.*?class=\"gallery\".*?insert-id=\"(.*?)\".*?>.*?<\/div>/gi,"[gallery=\"$1\"][/gallery]");
            rep(/<iframe class=\"gallery-preview\" insert-id=\"(.*?)\".*?>.*?<\/iframe>/gi,"[gallery=\"$1\"][/gallery]");
            rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");
            rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
            rep(/<iframe.*?src=\"http:\/\/www.youtube.com\/embed\/(.*?)\".*?>.*?<\/iframe>/gi,"[youtube=\"$1\"][/youtube]");
            rep(/<iframe.*?src=\"https:\/\/www.youtube.com\/embed\/(.*?)\".*?>.*?<\/iframe>/gi,"[youtube=\"$1\"][/youtube]");
            rep(/<iframe.*?src=\"http:\/\/player.vimeo.com\/video\/(.*?)\".*?>.*?<\/iframe>/gi,"[vimeo=\"$1\"][/vimeo]");
            rep(/<iframe.*?src=\"https:\/\/player.vimeo.com\/video\/(.*?)\".*?>.*?<\/iframe>/gi,"[vimeo=\"$1\"][/vimeo]");
            rep(/<\/(strong|b)>/gi,"[/b]");
            rep(/<(strong|b)>/gi,"[b]");
            rep(/<\/(em|i)>/gi,"[/i]");
            rep(/<(em|i)>/gi,"[i]");
            rep(/<\/u>/gi,"[/u]");
            rep(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/gi,"[u]$1[/u]");
            rep(/<u>/gi,"[u]");
            rep(/<blockquote[^>]*>/gi,"[quote]");
            rep(/<\/blockquote>/gi,"[/quote]");
            rep(/<br \/>/gi,"\n");
            rep(/<br\/>/gi,"\n");
            rep(/<br>/gi,"\n");
            rep(/<p>/gi,"");
            rep(/<\/p>/gi,"\n");
            rep(/&nbsp;|\u00a0/gi," ");
            rep(/&quot;/gi,"\"");
            rep(/&lt;/gi,"<");
            rep(/&gt;/gi,">");
            rep(/&amp;/gi,"&");
            return s;
        },

        // BBCode -> HTML from PunBB dialect
        _bbcode2html : function(s) {
            s = tinymce.trim(s);

            function rep(re, str) {
                s = s.replace(re, str);
            };

            rep(/\n/gi,"<br/>");
            rep(/\[b\]/gi,"<strong>");
            rep(/\[\/b\]/gi,"</strong>");
            rep(/\[i\]/gi,"<em>");
            rep(/\[\/i\]/gi,"</em>");
            rep(/\[u\]/gi,"<u>");
            rep(/\[\/u\]/gi,"</u>");
            rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi,"<a href=\"$1\">$2</a>");
            rep(/\[url\](.*?)\[\/url\]/gi,"<a href=\"$1\">$1</a>");
            rep(/\[img\](.*?)\[\/img\]/gi,"<img src=\"$1\" />");
            rep(/\[youtube="([^\]]+)"\].*?\[\/youtube\]/gi,"<iframe class=\"ytplayer\" type=\"text/html\" width=\"640\" height=\"360\" src=\"https://www.youtube.com/embed/$1\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen><iframe/>");
            rep(/\[vimeo="([^\]]+)"\].*?\[\/vimeo\]/gi,"<iframe src=\"http:\/\/player.vimeo.com\/video\/$1\" width=\"500\" height=\"250\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
            rep(/\[gallery="([^\]]+)"\](.*?)\[\/gallery\]/gi,"<iframe class=\"gallery-preview\" insert-id=\"$1\" src=\""+this['_galleryPreviewUrl']+"/$1\" scrolling=\"no\" height=\"400\" width=\"700\" frameborder=\"0\" ></iframe>");
            rep(/\[gallery="([^\]]+)"\](.*?)\[\/gallery\]/gi,"<div class=\"gallery\" insert-id=\"$1\" ></div>");

            return s;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('boom', tinymce.plugins.BoomPlugin);


})();
