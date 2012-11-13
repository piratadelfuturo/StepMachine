"use strict";
(function(document,$){
    $.ajaxSetup({
        complete: onRequestCompleted
    });
    function onRequestCompleted(xhr,textStatus) {
        if (xhr.status !== 200) {
        //return false;
        }
    }
})(document,jQuery);
(function(document,$){

    $(document).ready(function(){
        var dialog = $('<div></div>')
        .append()
        .dialog({
            autoOpen: false,
            title: 'Login',
            resizable: false,
            draggable: false,
            modal: true
        });

        $('#tb-rb a').click(function(ui,event){
            $dialog.dialog('open');
            return false;
        });

        /* GAL-CAR */

        //var galcar = $(".gal-car"),
        //gcanvas = galcar.find('.slide-container'),
        //gslides = galcar.find('div.slide');

        $.showSlideG = function( index ) {
            var current = typeof(index) == 'number' ? gslides.eq( index ) : gslides.filter('.active').next(),
            size = gslides.first().outerWidth();

            if( !current.length ) {
                index = 0;
            } else {
                index = gslides.index( current );
            }
            gcanvas.stop(true, true).animate({
                marginLeft: (size * (index) ) * -1
            });

            var target = galcar.find(".car-thumbs li:eq(" + index + "), .slide-container div.slide:eq(" + index + ")"),
            thumbs = target.closest(".car-thumbs").find("li");

            thumbs.removeClass('active');
            gslides.removeClass('active');
            target.addClass('active');

            return false;
        };

        $(".gal-car a.car-btn").click(function() {
            var galcar = $(this).parents("div.gal-car"),
            gcanvas = galcar.find('.slide-container'),
            gslides = galcar.find('div.slide');
            console.log(galcar);
            var btnNext = $(this).hasClass('next'),
            current = galcar.find("div.slide.active"),
            target  = btnNext ? current.next() : current.prev(),
            index   = 0;

            if ( !target.length && btnNext ) {
            } else if ( !target.length && !btnNext ) {
                index = gslides.length - 1;
            } else {
                index = gslides.index( target );
            }
            var current = typeof(index) == 'number' ? gslides.eq( index ) : gslides.filter('.active').next(),
            size = gslides.first().outerWidth();

            if( !current.length ) {
                index = 0;
            } else {
                index = gslides.index( current );
            }
            gcanvas.stop(true, true).animate({
                marginLeft: (size * (index) ) * -1
            });

            var target = galcar.find(".car-thumbs li:eq(" + index + "), .slide-container div.slide:eq(" + index + ")"),
            thumbs = target.closest(".car-thumbs").find("li");

            thumbs.removeClass('active');
            gslides.removeClass('active');
            target.addClass('active');

            return false;


        });



        $(".gal-car .car-thumbs li").click(function(){
            var galcar = $(this).parents("div.gal-car"),
            gcanvas = galcar.find('.slide-container'),
            gslides = galcar.find('div.slide');

            var index = $(this).parents("ul").find("li").index(this);
            console.log(index);
            var current = typeof(index) == 'number' ? gslides.eq( index ) : gslides.filter('.active').next(),
            size = gslides.first().outerWidth();

            if( !current.length ) {
                index = 0;
            } else {
                index = gslides.index( current );
            }
            gcanvas.stop(true, true).animate({
                marginLeft: (size * (index) ) * -1
            });

            var target = galcar.find(".car-thumbs li:eq(" + index + "), .slide-container div.slide:eq(" + index + ")"),
            thumbs = target.closest(".car-thumbs").find("li");

            thumbs.removeClass('active');
            gslides.removeClass('active');
            target.addClass('active');

            return false;
        });


        /* MAIN-CAR */
        var maincar = $("#main-car"),
        canvas = maincar.find('.slide-container'),
        slides = maincar.find('div.slide');

        $.showSlide = function( index ) {

            var current = typeof(index) == 'number' ? slides.eq( index ) : slides.filter('.active').next(),
            size = slides.first().outerWidth();

            if( !current.length ) {
                index = 0;
            } else {
                index = slides.index( current );
            }

            canvas.stop(true, true).animate({
                marginLeft: (size * (index) ) * -1
            });

            var target = maincar.find(".car-thumbs li:eq(" + index + "), .slide-container div.slide:eq(" + index + ")"),
            thumbs = target.closest(".car-thumbs").find("li");

            thumbs.removeClass('active');
            slides.removeClass('active');
            target.addClass('active');

            return false;

        };

        $.timer = window.setInterval(function(){
            $.showSlide();
        }, 5000);

        maincar.mouseenter(function(){
            window.clearInterval($.timer);
        });

        maincar.mouseleave(function(){
            $.timer = window.setInterval(function(){
                $.showSlide();
            }, 5000);
        });

        $(".car-thumbs li").click(function(){
            var index = $(".car-thumbs li").index(this);
            return $.showSlide(index);
        });

        $("#main-car a.car-btn").click(function() {

            var btnNext = $(this).hasClass('next'),
            current = maincar.find("div.slide.active"),
            target  = btnNext ? current.next() : current.prev(),
            index   = 0;

            if ( !target.length && btnNext ) {
            } else if ( !target.length && !btnNext ) {
                index = slides.length - 1;
            } else {
                index = slides.index( target );
            }

            return $.showSlide( index );

        });

        //BOOMIES
        $('li.boom:first-child').ready(function(){
            $('li.boom:first-child').addClass("on");
            return false;
        });
        $('span[class="tab"]').click(function(){
            if($(this).parent().hasClass("on")){
                $(this).parent().removeClass("on");
            }else{
                $(this).parent().addClass("on");
            }
            return false;
        });

        //Content Selector
        $.contentSelector = function( activeClick, index, activeContent ){

          var pos = activeClick.position(),
              wd = activeClick.innerWidth() / 2,
              sum = parseInt( pos.left + wd - 9 );

          activeClick.siblings('span.arrow').css('left', sum);
          activeClick.toggleClass('on').siblings('a').toggleClass('on');
          activeContent.fadeOut(300, function() {
              $(this).toggleClass('on').siblings('div').toggleClass('on').fadeIn(300);
          });

          return false;

        }

        $('div.botones a').click( function(){

          if( $(this).hasClass('on') ){
            return false;
          } else {
            var index = $(this).index(),
                activeClick = $(this);

            if( $(this).closest('.hook').attr('id') == 'usr-box' ) {
              var activeContent = $(this).parents('#usr-box').find('#rt-cont').children('.on');
            } else if( $(this).closest('.hook').attr('id') == 'usr-booms' ) {
              var activeContent = $(this).parents('#usr-booms').find('div.big-container .on');
            }

            return $.contentSelector( activeClick, index, activeContent );
          }

        });


        //DRAGnDROP boomies
        $("#front_boom_elements.sort-elements").dragsort({
            dragSelector: '#front_boom_elements .boomie .place',
            dragEnd: function(){
                $('.sort-elements').children().each(function(index){
                    $(this).find('.place').html(index+1);
                })
            },
            dragBetween: false,
            placeHolderTemplate: "<li class='empty'></li>"
        });

        var user = $('#usr-cnt');
        var userBox = user.find('#usr-roll');
        if(userBox){
            var showCookie = $.cookie('userBoxDisplay');
            if(showCookie == null){
                showCookie = 'show';
            }

            var handle = user.find('a.mostrar');
            var closeTab = user.find('#close-tab')
            var openTab = user.find('#open-tab')

            var openState   = true;
            var active = false;

            var countLaunch = function(count,callback){
                var self = this;
                self.counter = count;
                self.callback = callback;
                self.state = 0;

                self.count = function(){
                    self.state++;
                    if(self.state == self.counter){
                        self.callback.call();
                    }
                }
            };

            var open = function(animated){
                if(active){
                    return;
                }

                active = true;

                var counter = new countLaunch(3,function(){
                    active = false;
                    openState = true;
                });

                if(animated){
                    closeTab.fadeOut('slow',function(){
                        openTab.fadeIn('slow',function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    userBox.slideDown('slow',function(){
                        counter.count();
                    });
                }else{
                    openTab.show(0,function(){
                        $closeTab.hide(0,function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    userBox.show(0,function(){
                        counter.count();
                    });
                }

            }

            var close = function(animated){
                if(active){
                    return;
                }

                active = true;
                var counter = new countLaunch(3,function(){
                    active = false;
                    openState = false;
                });

                if(animated){
                    openTab.fadeOut('slow',function(){
                        closeTab.fadeIn('slow',function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    userBox.slideUp('slow',function(){
                        counter.count();
                    });
                }else{
                    openTab.hide(0,function(){
                        closeTab.show(0,function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    userBox.hide(0,function(){
                        counter.count();
                    });
                }

            }

            handle.click(function(){
                if(active){
                    return false;
                }
                if(openState){
                    close(true);
                    handle.removeClass('on');
                    userBox.removeClass('on');
                }else{
                    open(true);
                    handle.addClass('on');
                    userBox.addClass('on');
                }
                showCookie = showCookie == 'show' ? 'hide' : 'show';
                $.cookie('userBoxDisplay',showCookie);
                return false;
            });

            if(showCookie == 'hide'){
                close(false);
            }else{
                userBox.addClass('on');
                handle.addClass('on');
            }

        }
    });
})(document,jQuery);

(function(document,$){
    $(document).ready(function(){

        var data = {
            order:{}
        };
        var _root = $('#usr-booms'),
        _drag = $(".dyna-content.tend-cont > .drag-booms",_root),
        _dragBase = $(".dyna-content.tend-cont",_root),
        _editalo = $("> .editalo",_dragBase),
        op = false,
        _infoBlocks = $('.info-blocks',_root),
        _registerBlock = $('.sign-in',_infoBlocks),
        _shareBlock = $('.share-boom',_infoBlocks),
        _shareClose = $('.close-share',_infoBlocks)
        ;

        //DRAGnDROP widgt

        _drag.dragsort({
            dragSelector: '.drag-booms li',
            dragEnd: function(){
                if(op === true){
                    return false;
                }
                _editalo.removeClass('disabled');
                $(this).parent().children().each(function(index){
                    $(this).children(".pos").html(index+1);
                    data.order[$(this).attr('original-position')] = {
                        'original'  : $(this).attr('original-position'),
                        'final'     : index+1
                    };
                });
            },
            dragBetween: false,
            placeHolderTemplate: "<li class='empty'></li>"
        });

        _editalo.click(function(e){
            e.preventDefault();
            if(_editalo.hasClass('disabled') || op === true){
                return false;
            }
            _editalo.addClass('disabled');
            op = true;
            $.ajax({
                url: $(this).attr('href'),
                data: data,
                dataType:'json',
                type: 'POST',
                success: function(){
                    _infoBlocks.show(10,function(){
                        _shareBlock.animate({
                            bottom: '0'
                        })
                    });
                    op = false;
                    _editalo.removeClass('disabled');
                    _drag.dragsort("destroy");
                    _drag.find('div.balloon').remove();
                },
                error: function(response){
                    _infoBlocks.show(10,function(){
                        _registerBlock.animate({
                            bottom: '0'
                        });
                    });

                    op = false;
                    _editalo.removeClass('disabled');
                }
            });

        })

         _shareClose.click(function(e){
            if(_editalo.not('.disabled')){
              _shareBlock.animate({
                bottom: '-500px'
              });
            _editalo.addClass('disabled');
            return false;
            }
          }
         );

        $('.grey-btn',_registerBlock).click(function(e){
            e.preventDefault();
            $('a#fb-login-check').eq(0).click();
            return false;
        })

        $('.grey-btn',_shareBlock).click(function(e){
            e.preventDefault();
            console.log(!!$('.twitter',_shareBlock).attr('checked'));
            if(!!$('.twitter',_shareBlock).attr('checked')){
                var share = "https://twitter.com/share?text=Acabo de votar en 7boom&url="+window.location.href;
                window.open(share);
            }
            if(!!$('.facebook',_shareBlock).attr('checked')){
                console.log(window.location.href);
                var obj = {
                    method: 'feed',
                    link: window.location.href
                };
                FB.ui(
                    obj
                    );
            }
            _shareBlock.animate({
                bottom: '-500px'
            },500,function(){
                _infoBlocks.hide();
                _editalo.hide();
            });
            return false;
        })
   
        $('#mce-responses').click(function(){
          $(this).hide();
        });

    });
})(document,jQuery);


/**
 * FB Login
 */
(function(window, document, $ ){
    window.onFbInit = function(){
        if(!!FB){
            $(window).trigger("fbInit")
        }

    /*$(".btn-fb").click(function(e){
                e.preventDefault();
                FB.api('/me/og.likes',function(){
                    console.log(arguments);
                });
                return false;
            });*/
    }
    $(window).bind("fbInit",function(){
        $("a#fb-login-check").click(function(e){
            e.preventDefault();
            var _a = $(this);
            FB.login(function(response){
                if(response.status == 'connected'){
                    window.location = _a.attr('registration-url');
                }
            },{
                scope:_a.attr('scope')
            });
            return false;
        });
    })
})(window,document,jQuery);

/**
 * IMAGE UPLOAD
 */
(function(document,$){
    $(document).ready(function(){
        $('input[type=file].image-uploader').each(function(index,elem){
            var img = $(elem).siblings('img[id$=_img]').eq(0);
            $(elem).boomAjaxUpload({
                url: $(elem).attr('upload-path'),
                done:function(e, data){
                    if(data.result.id){
                        img.attr('src',data.result.path);
                    }
                }
            });
        });

    });
})(document,jQuery);
/**
 * follow
 */
(function(document,$){
    $(document).ready(function(){
        var profile = $('.author-profile .author-info').eq(0);
        if(profile.length > 0){
            $.ajax({
                url: profile.attr('follow-url'),
                dataTypeString:'json',
                success: function(response){
                    var resp = response;
                    var link = $(document.createElement('a')).addClass('seguir');
                    if(response.follow === true || response.follow === false){
                        link.text(response.follow === false ? 'seguir' : 'dejar de seguir');
                        link.attr('href','#');
                        link.click(function(e){
                            e.preventDefault();
                            link.fadeOut();
                            $.ajax({
                                url:resp.url,
                                type:'json',
                                success:function(r){
                                    resp = r;
                                    link.text(resp.follow === true ? 'dejar de seguir' : 'seguir');
                                    link.fadeIn();
                                },
                                error:function(){
                                    link.fadeIn();
                                }
                            });
                        })
                        profile.append(link);
                    }
                },
                error:function(a,s,d){
                    console.log(d);
                }
            });

        }
    });
})(document,jQuery);

(function(document,$){
    $(document).ready(function(){
        var tw = $('.tw-share');
        var url = tw.eq(0).attr('tw-count');
        if(url){
            $.ajax({
                url: url,
                success: function(response){
                    if(response.count){
                        console.log(response.count);
                        tw.each(function(){
                            var p = $(document.createElement('p')).text(response.count);
                            $(this).append(p);
                        });
                    }
                }
            });
        }
    });
})(document,jQuery);

(function(document,$){
    $(document).ready(function(){
        var social = $('.social.cf');
        var placeh = social.find('.fav-placeholder');
        var favTag = function(url){
            placeh.fadeOut();
            $.ajax({
                url: url ,
                success: function(response){
                    placeh.fadeIn();
                    if(response.text){
                        placeh.addClass('btn-fav').text(response.text);
                        if(response.fav === true){
                            placeh.addClass('active');
                        }else{
                            placeh.removeClass('active');
                        }
                        placeh.click(function(e){
                            e.preventDefault();
                            favTag(response.url);
                            return false;
                        })
                    }
                }
            });

        }
        if(placeh.length > 0){
            favTag(placeh.attr('href'));
        }
    });
})(document,jQuery);

(function(document,$){
    $(window).bind("fbInit",function(){
        FB.api('/'+window.location,function(response){
            if(response.likes){
                var p = $(document,createElement('p')).text(response.likes);
                $('.fb-share').append(p);
            }
        });
    });
})(document,jQuery);

(function(document,$){
    $(document).ready(function(){
        tinyMCE.init({
            theme : "advanced",
            mode : "specific_textareas",
            editor_selector : "boom-wysiwyg",
            width: "100%",
            plugins : "autoresize,boom",
            theme_advanced_buttons1 : "bold,italic,underline",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            invalid_elements: "span",
            valid_elements: "br,strong/b,i/em,blockquote/quote,"+
            "img[!src|alt|title|width|height|!insert-id],"+
            "a[*],p"+
            "div[!class<gallery|!insert-id],"+
            "ul,ol,li,table,tr,td,th,thead,tbody,iframe[*]",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_resizing : true,
            object_resizing : false,
            relative_urls : false,
            remove_script_host : false,
            add_unload_trigger : false,
            inline_styles : false,
            valid_children : "strong[br|em|#text],em[br|strong|#text]",
            theme_advanced_statusbar_location : 'none',
            force_br_newlines : true,
            force_p_newlines : false,
            forced_root_block : ''
        });

        $('.boom-wysiwyg').each(function(){
            var _this = $(this);
            var menu  = _this.parent().siblings('.wyswyg-menu').eq(0);
            var link  = menu.find('.hyperlink a',0);
            var photo = menu.find('.picture a',0);
            var video = menu.find('.video a',0);
            var gallery = menu.find('.gallery a',0);

            photo.click(function(e){
                e.preventDefault();
                tinymce.execInstanceCommand(_this.attr('id'),'boomImage',false,photo.attr('image-path'),true)
                return false;
            })
            link.click(function(e){
                e.preventDefault();
                tinymce.execInstanceCommand(_this.attr('id'),'boomLink',false,false,true);
                return false;
            });
            video.click(function(e){
                e.preventDefault();
                tinymce.execInstanceCommand(_this.attr('id'),'boomVideo',false,false,true);
                return false;
            });
            gallery.click(function(e){
                e.preventDefault();
                var urlObject = {
                    'new':gallery.attr('gallery-new-path'),
                    'create':gallery.attr('gallery-create-path'),
                    'edit':gallery.attr('gallery-edit-path'),
                    'update':gallery.attr('gallery-update-path'),
                    'image':gallery.attr('image-path')
                }
                tinymce.execInstanceCommand(_this.attr('id'),'boomGallery',false,urlObject,true)
                return false;
            });

        });

    });
})(document,jQuery);


/**MAILCHIMP**/

var fnames = new Array();var ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[0]='EMAIL';ftypes[0]='email';
try {
    var jqueryLoaded=jQuery;
    jqueryLoaded=true;
} catch(err) {
    var jqueryLoaded=false;
}
var head= document.getElementsByTagName('head')[0];
if (!jqueryLoaded) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
    head.appendChild(script);
    if (script.readyState && script.onload!==null){
        script.onreadystatechange= function () {
              if (this.readyState == 'complete') mce_preload_check();
        }    
    }
}
var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
head.appendChild(script);
var err_style = '';
try{
    err_style = mc_custom_error_style;
} catch(e){
    err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
}
var head= document.getElementsByTagName('head')[0];
var style= document.createElement('style');
style.type= 'text/css';
if (style.styleSheet) {
  style.styleSheet.cssText = err_style;
} else {
  style.appendChild(document.createTextNode(err_style));
}
head.appendChild(style);
setTimeout('mce_preload_check();', 250);

var mce_preload_checks = 0;
function mce_preload_check(){
    if (mce_preload_checks>40) return;
    mce_preload_checks++;
    try {
        var jqueryLoaded=jQuery;
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    try {
        var validatorLoaded=jQuery("#fake-form").validate({});
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    mce_init_form();
}
function mce_init_form(){
    jQuery(document).ready( function($) {
      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
      var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
      $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
      options = { url: 'http://7boom.us6.list-manage1.com/subscribe/post-json?u=8e9171246d53eebc71ca63890&id=ef91d2cbb8&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                    beforeSubmit: function(){
                        $('#mce_tmp_error_msg').remove();
                        $('.datefield','#mc_embed_signup').each(
                            function(){
                                var txt = 'filled';
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        var bday = false;
                                        if (fields.length == 2){
                                            bday = true;
                                            fields[2] = {'value':1970};//trick birthdays into having years
                                        }
                                    	if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
                                    		this.value = '';
									    } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
                                    		this.value = '';
									    } else {
									        if (/\[day\]/.test(fields[0].name)){
    	                                        this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
									        } else {
    	                                        this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
	                                        }
	                                    }
                                    });
                            });
                        return mce_validator.form();
                    }, 
                    success: mce_success_cb
                };
      $('#mc-embedded-subscribe-form').ajaxForm(options);
      /*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES
 */
jQuery.extend(jQuery.validator.messages, {
  required: "Este campo es obligatorio.",
  remote: "Por favor, rellena este campo.",
  email: "Por favor, escribe una dirección de correo válida",
  url: "Por favor, escribe una URL válida.",
  date: "Por favor, escribe una fecha válida.",
  dateISO: "Por favor, escribe una fecha (ISO) válida.",
  number: "Por favor, escribe un número entero válido.",
  digits: "Por favor, escribe sólo dígitos.",
  creditcard: "Por favor, escribe un número de tarjeta válido.",
  equalTo: "Por favor, escribe el mismo valor de nuevo.",
  accept: "Por favor, escribe un valor con una extensión aceptada.",
  maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
  minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
  rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
  range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
  max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
  min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
});
      
    });
}
function mce_success_cb(resp){
    $('#mce-success-response').hide();
    $('#mce-error-response').hide();
    if (resp.result=="success"){
        $('#mce-'+resp.result+'-response').show();
        $('#mce-'+resp.result+'-response').html(resp.msg);
        $('#mc-embedded-subscribe-form').each(function(){
            this.reset();
    	});
    } else {
        var index = -1;
        var msg;
        try {
            var parts = resp.msg.split(' - ',2);
            if (parts[1]==undefined){
                msg = resp.msg;
            } else {
                i = parseInt(parts[0]);
                if (i.toString() == parts[0]){
                    index = parts[0];
                    msg = parts[1];
                } else {
                    index = -1;
                    msg = resp.msg;
                }
            }
        } catch(e){
            index = -1;
            msg = resp.msg;
        }
        try{
            if (index== -1){
                $('#mce-'+resp.result+'-response').show();
                $('#mce-'+resp.result+'-response').html(msg);            
            } else {
                err_id = 'mce_tmp_error_msg';
                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
                
                var input_id = '#mc_embed_signup';
                var f = $(input_id);
                if (ftypes[index]=='address'){
                    input_id = '#mce-'+fnames[index]+'-addr1';
                    f = $(input_id).parent().parent().get(0);
                } else if (ftypes[index]=='date'){
                    input_id = '#mce-'+fnames[index]+'-month';
                    f = $(input_id).parent().parent().get(0);
                } else {
                    input_id = '#mce-'+fnames[index];
                    f = $().parent(input_id).get(0);
                }
                if (f){
                    $(f).append(html);
                    $(input_id).focus();
                } else {
                    $('#mce-'+resp.result+'-response').show();
                    $('#mce-'+resp.result+'-response').html(msg);
                }
            }
        } catch(e){
            $('#mce-'+resp.result+'-response').show();
            $('#mce-'+resp.result+'-response').html(msg);
        }
    }
    
}
