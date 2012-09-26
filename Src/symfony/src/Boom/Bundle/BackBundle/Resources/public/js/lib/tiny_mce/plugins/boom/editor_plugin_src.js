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

    tinymce.create('tinymce.plugins.BoomPlugin', {
        init : function(ed, url) {
            var t = this;
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
                var embedPrompt = $.prompt(
                    'Codigo embed de video', '',
                    function(txt){
                        ed.execCommand('mceInsertContent',false,txt);
                    } );
            });
            ed.addCommand('boomImage', function() {
                var dialog = $(document.createElement('div'));
                dialog.dialog({
                    title:'Agregar imagen',
                    autoOpen: false,
                    width: 500,
                    resizable: false,
                    modal: true,
                    buttons: {
                        'Cerrar': function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
                dialog.dialog('open');
                $.get(
                    Routing.generate('BoomBackBundle_image_ajax_new'),
                    function(data){
                        dialog.append(data);
                        dialog.find('input[type=file].ajax-image-uploader').each(function(i,e){
                            $(e).boomAjaxUpload({
                                url: Routing.generate(
                                    'BoomBackBundle_image_ajax_create',
                                    {
                                        _format: 'json',
                                        path: $(this).attr('name'),
                                        w: 158,
                                        h: 90
                                    }),
                                done: function(e, data){
                                    if(data.result.id){
                                        ed.execCommand('mceInsertContent',false,'<img src="'+data.result.path+'" />');
                                        dialog.dialog('close');
                                    }
                                }
                            });
                        });
                    });
            });

            ed.addCommand('boomGallery', function() {
                var form, formRoute = {},response,
                dialog = $(document.createElement('div')),
                node = ed.selection.getNode();
                formRoute['form'] = {};
                formRoute['form']['name'] = 'BoomBackBundle_gallery_ajax_new';
                formRoute['form']['vars'] = {};
                formRoute['save'] = {};
                formRoute['save']['name'] = 'BoomBackBundle_gallery_ajax_create';
                formRoute['save']['vars'] = {
                    '_format': 'json'
                };
                if($(node).hasClass('gallery') && $(node).attr('insert-id')){
                    formRoute['form']['name'] = 'BoomBackBundle_gallery_ajax_edit';
                    formRoute['form']['vars'] = {
                        'id' : $(node).attr('insert-id')
                        };
                    formRoute['save']['name'] = 'BoomBackBundle_gallery_ajax_update';
                    formRoute['save']['vars'] = {
                        'id' : $(node).attr('insert-id'),
                        '_format': 'json'
                    };
                }

                dialog.dialog({
                    title:'Galería',
                    autoOpen: false,
                    width: 500,
                    height: 500,
                    resizable: false,
                    modal: true,
                    buttons: {
                        'Cerrar': function() {
                            dialog.dialog( "close" )
                        }
                    }
                });
                dialog.dialog('open');

                $.get(
                    Routing.generate(formRoute['form']['name'],formRoute['form']['vars']),
                    function(data){
                        dialog.append(data);
                        form = dialog.find('form',0);
                        var buttons= {
                            'Agregar Imagen' : function(){
                                var fieldset = form.find('fieldset',0);
                                var number = fieldset.children().length;
                                var prototype = fieldset.attr('data-prototype');
                                var transferElement = $(prototype.replace(/__name__/g, number));
                                fieldset.append(transferElement);
                                var input = transferElement.find("input[type=file].ajax-image-uploader",0);
                                var img = input.siblings('img[id$=_img]').eq(0);
                                input.boomAjaxUpload({
                                    url: Routing.generate(
                                        'BoomBackBundle_image_ajax_create',
                                        {
                                            _format: 'json',
                                            path: input.attr('name'),
                                            w: 158,
                                            h: 90
                                        }),
                                    done: function(e,data){
                                        if(data.result.id){
                                            img.attr('src',data.result.path);
                                        }

                                    }
                                });
                            },
                            'Guardar': function(){
                                $.post(
                                    Routing.generate(formRoute['save']['name'],formRoute['save']['vars']),
                                    $(form).serialize(),
                                    function(data){
                                        var html = '<div class="gallery" insert-id="'+data.id+'"></div>';
                                        ed.execCommand('mceInsertContent',false,html);
                                        dialog.dialog( "close" );
                                    }
                                    );
                            },
                            'Cancelar': function() {
                                dialog.dialog( "close" );
                            }
                        }
                        dialog.dialog( "option","buttons",buttons);

                        form.find('input[type=file].ajax-image-uploader').each(function(i,e){
                            var img = $(e).siblings('img[id$=_img]').eq(0);
                            $(e).boomAjaxUpload({
                                url: Routing.generate(
                                    'BoomBackBundle_image_ajax_create',
                                    {
                                        _format: 'json',
                                        path: $(e).attr('name'),
                                        w: 158,
                                        h: 90
                                    }),
                                done: function(e, data){
                                    if(data.result.id){
                                        img.attr('src',data.result.path);
                                    }
                                }
                            });
                        });
                    });
            });

            ed.addCommand('boomLink', function() {
                $.prompt(
                    'Link hacia algun boom', '',
                    function(txt){
                        ed.execCommand('mceInsertLink',false, txt);
                    });
            });

            // Register example button
            ed.addButton('boom_video', {
                title : 'Agrega un video',
                cmd : 'boomVideo',
                image : url + '/img/glyphicons_008_film.png'
            });

            ed.addButton('boom_image', {
                title : 'Agrega un video',
                cmd : 'boomImage',
                image : url + '/img/glyphicons_011_camera.png'
            });

            ed.addButton('boom_gallery', {
                title : 'Agrega una galería',
                cmd : 'boomGallery',
                image : url + '/img/glyphicons_056_projector.png'
            });

            ed.addButton('boom_link', {
                title : 'Agrega un link a 7boom',
                cmd : 'boomLink',
                image : url + '/img/glyphicons_050_link.png'
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

        // Private methods

        // HTML -> BBCode in PunBB dialect
        _html2bbcode : function(s) {
            s = tinymce.trim(s);

            function rep(re, str) {
                s = s.replace(re, str);
            };

            // example: <strong> to [b]
            rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");
            rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
            rep(/<iframe.*?src=\"http:\/\/www.youtube.com\/embed\/(.*?)\".*?>(.*?)<\/iframe>/gi,"[youtube=\"$1\"][/youtube]");
            rep(/<iframe.*?src=\"http:\/\/player.vimeo.com\/video\/(.*?)\".*?>(.*?)<\/iframe>/gi,"[vimeo=\"$1\"][/vimeo]");
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

            rep(/\n/gi,"<br />");
            rep(/\[b\]/gi,"<strong>");
            rep(/\[\/b\]/gi,"</strong>");
            rep(/\[i\]/gi,"<em>");
            rep(/\[\/i\]/gi,"</em>");
            rep(/\[u\]/gi,"<u>");
            rep(/\[\/u\]/gi,"</u>");
            rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi,"<a href=\"$1\">$2</a>");
            rep(/\[url\](.*?)\[\/url\]/gi,"<a href=\"$1\">$1</a>");
            rep(/\[img\](.*?)\[\/img\]/gi,"<img src=\"$1\" />");
            rep(/\[youtube="([^\]]+)"\](.*?)\[\/youtube\]/gi,"<iframe class=\"ytplayer\" type=\"text/html\" width=\"640\" height=\"360\" src=\"https://www.youtube.com/embed/$1\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen><iframe/>");
            rep(/\[vimeo="([^\]]+)"\](.*?)\[\/vimeo\]/gi,"<iframe src=\"http:\/\/player.vimeo.com\/video\/$1\" width=\"500\" height=\"250\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");

            return s;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('boom', tinymce.plugins.BoomPlugin);


})();
