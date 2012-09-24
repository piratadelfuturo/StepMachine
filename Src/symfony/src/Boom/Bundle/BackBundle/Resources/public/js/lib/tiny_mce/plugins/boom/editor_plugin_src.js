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
                    console.log(txt);
                    ed.execCommand('mceInsertContent',false,txt);
                    ed.execCommand('mceCodeEditor');
                } );
            });
            ed.addCommand('boomImage', function() {
                ed.execCommand('mceInsertContent',false,'<img alt="$img_title" src="$link/img/sadrzaj/$file" />');
            });
            ed.addCommand('boomGallery', function() {
                ed.execCommand('mceInsertContent',false,'<img alt="$img_title" src="$link/img/sadrzaj/$file" />');
            });

            // Register example button
            ed.addButton('boom_image', {
                title : 'Agrega un video',
                cmd : 'boomVideo',
                image : url + '/img/portuguese.gif'
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
            rep(/<iframe.*?src=\"http:\/\/www.youtube.com\/embed\/(.*?)\".*?>(.*?)<\/iframe>/gi,"[youtube=\"$1\"][/youtube]");
            rep(/<iframe.*?src=\"http:\/\/player.vimeo.com\/video\/(.*?)\".*?>(.*?)<\/iframe>/gi,"[vimeo=\"$1\"][/vimeo]");
            rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
            rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");

            return s;
        },

        // BBCode -> HTML from PunBB dialect
        _bbcode2html : function(s) {
            s = tinymce.trim(s);

            function rep(re, str) {
                s = s.replace(re, str);
            };

            // example: [b] to <strong>
            rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi,"<a href=\"$1\">$2</a>");
            rep(/\[url\](.*?)\[\/url\]/gi,"<a href=\"$1\">$1</a>");
            rep(/\[img\](.*?)\[\/img\]/gi,"<img src=\"$1\" />");
            rep(/\[youtube=([^\]]+)\](.*?)\[\/youtube\]/gi,"<iframe class=\"ytplayer\" type=\"text/html\" width=\"640\" height=\"360\" src=\"https://www.youtube.com/embed/$1\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen><iframe/>");
            rep(/\[vimeo=([^\]]+)\](.*?)\[\/vimeo\]/gi,"<iframe src=\"http:\/\/player.vimeo.com\/video\/$1\" width=\"500\" height=\"250\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");

            return s;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('boom', tinymce.plugins.BoomPlugin);


})();
