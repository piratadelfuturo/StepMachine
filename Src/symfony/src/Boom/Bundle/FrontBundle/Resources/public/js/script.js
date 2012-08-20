(function(document,$){

    $(document).ready(function(){
        var $dialog = $('<div></div>')
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

        var $user = $('#usr-cnt');
        var $userBox = $user.find("#usr-roll");
        if($userBox){
            var showCookie = $.cookie('userBoxDisplay');
            if(showCookie == null){
                showCookie = 'show';
            }

            var $handle = $user.find('a.mostrar');
            var $closeTab = $user.find('#close-tab')
            var $openTab = $user.find('#open-tab')

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
                    $closeTab.fadeOut('slow',function(){
                        $openTab.fadeIn('slow',function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    $userBox.slideDown('slow',function(){
                        counter.count();
                    });
                }else{
                    $openTab.show(0,function(){
                        $closeTab.hide(0,function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    $userBox.show(0,function(){
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
                    $openTab.fadeOut('slow',function(){
                        $closeTab.fadeIn('slow',function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    $userBox.slideUp('slow',function(){
                        counter.count();
                    });
                }else{
                    $openTab.hide(0,function(){
                        $closeTab.show(0,function(){
                            counter.count();
                        });
                        counter.count();
                    });
                    $userBox.hide(0,function(){
                        counter.count();
                    });
                }

            }

            $handle.click(function(){
                if(active){
                    return false;
                }
                if(openState){
                    close(true);
                }else{
                    open(true);
                }
                $(this).find('span').toggle();
                showCookie = showCookie == 'show' ? 'hide' : 'show';
                $.cookie('userBoxDisplay',showCookie);
                return false;
            });

            if(showCookie == 'hide'){
                close(false);
                $handle.find('span').toggle();
            }

        }

    });
})(document,jQuery);