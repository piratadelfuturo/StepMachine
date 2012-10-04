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
                    inputImageUpload.boomAjaxUpload({
                        url: Routing.generate(
                            'BoomBackBundle_image_ajax_create',
                            {
                                _format: 'json',
                                path: inputImageUpload.attr('name'),
                                w: 158,
                                h: 90
                            }),
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

            ed.addCommand('boomGallery', function() {
                var form, formRoute = {},response,
                dialog = $(document.createElement('div')),
                node = ed.selection.getNode(),
                formUpload = $(document.createElement('form')).attr('method','post').hide(),
                inputUpload = $(document.createElement('input')).attr({
                    'name':'files',
                    'type':'file',
                    'multiple':'multiple'
                });
                formUpload.append(inputUpload);
                dialog.append(formUpload);
                if(console.log){
                    console.log(node);
                }
                formRoute['form'] = {};
                formRoute['form']['name'] = 'BoomBackBundle_gallery_ajax_new';
                formRoute['form']['vars'] = {};
                formRoute['save'] = {};
                formRoute['save']['name'] = 'BoomBackBundle_gallery_ajax_create';
                formRoute['save']['vars'] = {
                    '_format': 'json'
                };
                if($(node).hasClass('gallery-preview') && $(node).attr('insert-id')){
                    formRoute['form']['name'] = 'BoomBackBundle_gallery_ajax_edit';
                    formRoute['form']['vars'] = {
                        'id' : $(node).attr('insert-id')
                    };
                    formRoute['save']['name'] = 'BoomBackBundle_gallery_ajax_update';
                    formRoute['save']['vars'] = {
                        'id' : $(node).attr('insert-id'),
                        '_format': 'json'
                    };
                    ed.dom.remove(node);
                }

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
                    Routing.generate(formRoute['form']['name'],formRoute['form']['vars']),
                    function(data){
                        dialog.append(data);
                        form = dialog.find('form',0);
                        var buttons= {
                            'Agregar Imagen' : function(){
                                formUpload.find('input[type=file]',0).click();
                            },
                            'Guardar': function(){
                                $.post(
                                    Routing.generate(formRoute['save']['name'],formRoute['save']['vars']),
                                    $(form).serialize(),
                                    function(data){
                                        var html = '<iframe class="gallery-preview" insert-id="'+data.id+'" src="'+Routing.generate('BoomFrontBundle_gallery_iframe_preview',{
                                            'id' : data.id
                                        })+'" scrolling=\"no\" height=\"400\" width=\"700\" frameborder=\"0\" ></iframe>';
                                        ed.execCommand('mceInsertContent',false,html);
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
                            url: Routing.generate(
                                'BoomBackBundle_image_ajax_create',
                                {
                                    _format: 'json',
                                    path: inputUpload.attr('name'),
                                    w: 116,
                                    h: 116
                                }),
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
            rep(/\[youtube="([^\]]+)"\].*?\[\/youtube\]/gi,"<iframe class=\"ytplayer\" type=\"text/html\" width=\"640\" height=\"360\" src=\"https://www.youtube.com/embed/$1\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen><iframe/>");
            rep(/\[vimeo="([^\]]+)"\].*?\[\/vimeo\]/gi,"<iframe src=\"http:\/\/player.vimeo.com\/video\/$1\" width=\"500\" height=\"250\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
            rep(/\[gallery="([^\]]+)"\](.*?)\[\/gallery\]/gi,"<iframe class=\"gallery-preview\" insert-id=\"$1\" src=\""+Routing.generate('BoomFrontBundle_gallery_iframe_preview')+"/$1\" scrolling=\"no\" height=\"400\" width=\"700\" frameborder=\"0\" ></iframe>");
            rep(/\[gallery="([^\]]+)"\](.*?)\[\/gallery\]/gi,"<div class=\"gallery\" insert-id=\"$1\" ></div>");

            return s;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('boom', tinymce.plugins.BoomPlugin);


})();
