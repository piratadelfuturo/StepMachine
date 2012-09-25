(function(document,$){
    $.widget( "boom.boomAjaxUpload", {
        options: {
            done: function(){},
            submit: function(){},
            url: '/'
        },
        _create: function() {
            var _base = this,
            _this = $(_base.element),
            _parent = _this.parent();

            _this.fileupload({
                dataType: 'json',
                paramName: _this.attr('name'),
                url: _base.options.url,
                done: function (e, data) {
                    if(data.result.id){
                        _parent.children('input[type=hidden]').eq(0).val(data.result.id)
                        //_parent.children('img[id$=image_img]').eq(0).attr('src',data.result.path);
                    }
                    var callback = _base.options.done||function(){};
                    callback.apply(_this,arguments);
                },
                submit: function(e, data){
                    $(_this).fadeOut();
                    var callback = _base.options.submit||function(){};
                    callback.apply(_this,arguments);

                }
            });
        }
    });
})(document,jQuery);