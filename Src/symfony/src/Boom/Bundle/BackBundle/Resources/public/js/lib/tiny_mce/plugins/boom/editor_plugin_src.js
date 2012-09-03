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
            var t = this, dialect = ed.getParam('bbcode_dialect', 'punbb').toLowerCase();
            ed.onBeforeSetContent.add(function(ed, o) {
                o.content = t['_' + dialect + '_bbcode2html'](o.content);
            });
            ed.onPostProcess.add(function(ed, o) {
                if (o.set){
                    o.content = t['_' + dialect + '_bbcode2html'](o.content);
                }
                if (o.get){
                    o.content = t['_' + dialect + '_html2bbcode'](o.content);
                }
            });

            ed.addCommand('boomImage', function() {

                ed.execCommand('mceInsertContent',false,'<img alt="$img_title" src="$link/img/sadrzaj/$file" />');
                ed.execCommand('mceInsertContent',false,'<a href="http://www.sevenboom.com" >hello</a>');
                ed.execCommand('mceInsertContent',false,'<b>hello</b>');
                ed.execCommand('mceInsertContent',false,'mimimimimi');

                ed.execCommand('mceCodeEditor');
            });

            // Register example button
            ed.addButton('boom_image', {
                title : 'example.desc',
                cmd : 'boomImage',
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
        _punbb_html2bbcode : function(s) {
            s = tinymce.trim(s);

            function rep(re, str) {
                s = s.replace(re, str);
            };

            // example: <strong> to [b]
            rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
            rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");

            return s;
        },

        // BBCode -> HTML from PunBB dialect
        _punbb_bbcode2html : function(s) {
            s = tinymce.trim(s);

            function rep(re, str) {
                s = s.replace(re, str);
            };

            // example: [b] to <strong>
            rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi,"<a href=\"$1\">$2</a>");
            rep(/\[url\](.*?)\[\/url\]/gi,"<a href=\"$1\">$1</a>");
            rep(/\[img\](.*?)\[\/img\]/gi,"<img src=\"$1\" />");

            return s;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('boom', tinymce.plugins.BoomPlugin);
})();