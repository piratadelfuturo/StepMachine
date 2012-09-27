"use strict";
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

            var target = maincar.find("#car-thumbs li:eq(" + index + "), .slide-container div.slide:eq(" + index + ")"),
            thumbs = target.closest("#car-thumbs").find("li");

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

        $("#car-thumbs a").click(function(){
            var index = $("#car-thumbs a").index(this);
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

        //usr-booms selector
        var onSelector = $('#usr-booms .botones'),
        arrow = onSelector.children('span.arrow');

        onSelector.children('a').click(function() {

            var pos = $(this).position(),
            wd = $(this).innerWidth() / 2,
            sum = parseInt(pos.left + wd - 9),
            onCont = onSelector.parents('#usr-booms').find('div.dyna-content.on');
            if($(this).hasClass('on')){
                arrow.css('left', sum);
                return false;
            }else{
                $(this).toggleClass('on');
                $(this).siblings('a').toggleClass('on');
                onCont.fadeOut(300, function() {
                    $(this).toggleClass('on').siblings().toggleClass('on').fadeIn(300)
                });
                arrow.css('left', sum);
            }

            return false;

        });

        //DRAGnDROP boomies
        $("#boom_bundle_frontbundle_boomtype_elements.sort-elements").dragsort({
            dragSelector: '#boom_bundle_frontbundle_boomtype_elements .boomie .place',
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

        var order = {};

        //DRAGnDROP widgt
        $("#usr-booms .dyna-content > .drag-booms").dragsort({
            dragSelector: '.drag-booms li',
            dragEnd: function(){
                $(this).siblings().each(function(index){
                    $(this).children(".pos").html(index+1);
                    order[$(this).attr('original-position')] = {
                        'original'  : $(this).attr('original-position'),
                        'final'     : index+1
                    };
                });

                $.ajax({
                    url: $(this).parent().attr('reorder-url'),
                    data: order,
                    type: 'POST',
                    statusCode:{
                        200: function(data){
                            console.log(data);
                        },
                        302:function(){

                        }
                    }
                });
            },
            dragBetween: false,
            placeHolderTemplate: "<li class='empty'></li>"
        });
    });
})(document,jQuery);


/*
     * FB Login
     */

(function(window, document, $ ){
    window.onFbInit = function(){
        if(!!FB){
            $("a#fb-login-check").click(function(){
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
        }
    }
})(window,document,jQuery);
