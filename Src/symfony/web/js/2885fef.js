$(document).ready(function () {


	/*----------------------------------------------------------------------*/
	/* Parse the data from an data-attribute of DOM Elements
	/*----------------------------------------------------------------------*/


	$.parseData = function (data, returnArray) {
		if (/^\[(.*)\]$/.test(data)) { //array
			data = data.substr(1, data.length - 2).split(',');
		}
		if (returnArray && !$.isArray(data) && data != null) {
			data = Array(data);
		}
		return data;
	};
	
	/*----------------------------------------------------------------------*/
	/* Image Preloader
	/* http://engineeredweb.com/blog/09/12/preloading-images-jquery-and-javascript
	/*----------------------------------------------------------------------*/
	


	// Arguments are image paths relative to the current page.
	$.preload = function() {
		var cache = [],
			args_len = arguments.length;
		for (var i = args_len; i--;) {
			var cacheImage = document.createElement('img');
			cacheImage.src = arguments[i];
			cache.push(cacheImage);
		}
	};
	
	
	/*----------------------------------------------------------------------*/
	/* fadeInSlide by revaxarts.com
	/* Fades out a box and slide it up before it will get removed
	/*----------------------------------------------------------------------*/


	$.fn.fadeInSlide = function (speed, callback) {
		if ($.isFunction(speed)) callback = speed;
		if (!speed) speed = 200;
		if (!callback) callback = function () {};
		this.each(function () {

			var $this = $(this);
			$this.fadeTo(speed / 2, 1).slideDown(speed / 2, function () {
				callback();
			});
		});
		return this;
	};
	
	
	/*----------------------------------------------------------------------*/
	/* fadeOutSlide by revaxarts.com
	/* Fades out a box and slide it up before it will get removed
	/*----------------------------------------------------------------------*/


	$.fn.fadeOutSlide = function (speed, callback) {
		if ($.isFunction(speed)) callback = speed;
		if (!speed) speed = 200;
		if (!callback) callback = function () {};
		this.each(function () {

			var $this = $(this);
			$this.fadeTo(speed / 2, 0).slideUp(speed / 2, function () {
				$this.remove();
				callback();
			});
		});
		return this;
	};
	
	/*----------------------------------------------------------------------*/
	/* textFadeOut by revaxarts.com
	/* Fades out a box and slide it up before it will get removed
	/*----------------------------------------------------------------------*/


	$.fn.textFadeOut = function (text, delay, callback) {
		if (!text) return false;
		if ($.isFunction(delay)) callback = delay;
		if (!delay) delay = 2000;
		if (!callback) callback = function () {};
		this.each(function () {

			var $this = $(this);
			$this.stop().text(text).show().delay(delay).fadeOut(1000,function(){
				$this.text('').show();
				callback();
			})
		});
		return this;
	};
	
	/*----------------------------------------------------------------------*/
	/* leadingZero by revaxarts.com
	/* adds a leding zero if necessary
	/*----------------------------------------------------------------------*/
	
	
	$.leadingZero = function (value) {
		value = parseInt(value, 10);
		if(!isNaN(value)) {
			(value < 10) ? value = '0' + value : value;
		}
		return value;
	};


});
/*----------------------------------------------------------------------*/
/* jQuery UI Touch Punch 0.1.0
/* Copyright 2010, Dave Furfero
/* https://github.com/furf/jquery-ui-touch-punch
/* Extend the jQuery UI for iPad an iPhone
/* depends jquery.ui.widget.js, jquery.ui.mouse.js
/*----------------------------------------------------------------------*/


(function ($) {
	$.support.touch = typeof Touch === 'object';

	if (!$.support.touch) {
		return;
	}

	var mouseProto = $.ui.mouse.prototype,
		_mouseInit = mouseProto._mouseInit,
		_mouseDown = mouseProto._mouseDown,
		_mouseUp = mouseProto._mouseUp,

		mouseEvents = {
			touchstart: 'mousedown',
			touchmove: 'mousemove',
			touchend: 'mouseup'
		};

	function makeMouseEvent(event) {
		event.stopPropagation();
		var touch = event.originalEvent.changedTouches[0];
		return $.extend(event, {
			type: mouseEvents[event.type],
			which: 1,
			pageX: touch.pageX,
			pageY: touch.pageY,
			screenX: touch.screenX,
			screenY: touch.screenY,
			clientX: touch.clientX,
			clientY: touch.clientY
		});
	}

	mouseProto._mouseInit = function () {

		var self = this;

		self.element.bind('touchstart.' + self.widgetName, function (event) {
			return self._mouseDown(makeMouseEvent(event));
		});

		_mouseInit.call(self);
	};

	mouseProto._mouseDown = function (event) {


		var self = this,
			ret = _mouseDown.call(self, event);

		if (self.options.handle && !$(event.target).is(self.options.handle)) {
			mouseProto._mouseUp(event);
			return;
		}

		self._touchMoveDelegate = function (event) {
			return self._mouseMove(makeMouseEvent(event));
		};

		self._touchEndDelegate = function (event) {
			return self._mouseUp(makeMouseEvent(event));
		};

		$(document).bind('touchmove.' + self.widgetName, self._touchMoveDelegate).bind('touchend.' + self.widgetName, self._touchEndDelegate);

		return ret;
	};

	mouseProto._mouseUp = function (event) {

		var self = this;
		$(document).unbind('touchmove.' + self.widgetName, self._touchMoveDelegate).unbind('touchend.' + self.widgetName, self._touchEndDelegate);

		return _mouseUp.call(self, event);
	};
})(jQuery);


/*----------------------------------------------------------------------*/
/* jQuery MouseWheel Plugin by Brandon Aaron
/* Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
/*----------------------------------------------------------------------*/

(function($) {

var types = ['DOMMouseScroll', 'mousewheel'];

if ($.event.fixHooks) {
    for ( var i=types.length; i; ) {
        $.event.fixHooks[ types[--i] ] = $.event.mouseHooks;
    }
}

$.event.special.mousewheel = {
    setup: function() {
        if ( this.addEventListener ) {
            for ( var i=types.length; i; ) {
                this.addEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = handler;
        }
    },
    
    teardown: function() {
        if ( this.removeEventListener ) {
            for ( var i=types.length; i; ) {
                this.removeEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = null;
        }
    }
};

$.fn.extend({
    mousewheel: function(fn) {
        return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
    },
    
    unmousewheel: function(fn) {
        return this.unbind("mousewheel", fn);
    }
});


function handler(event) {
    var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
    event = $.event.fix(orgEvent);
    event.type = "mousewheel";
    
    // Old school scrollwheel delta
    if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
    if ( orgEvent.detail     ) { delta = -orgEvent.detail/3; }
    
    // New school multidimensional scroll (touchpads) deltas
    deltaY = delta;
    
    // Gecko
    if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
        deltaY = 0;
        deltaX = -1*delta;
    }
    
    // Webkit
    if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
    if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
    
    // Add event and delta to the front of the arguments
    args.unshift(event, delta, deltaX, deltaY);
    
    return ($.event.dispatch || $.event.handle).apply(this, args);
}

})(jQuery);


/*----------------------------------------------------------------------*/
/* jQuery Tipsy Plugin by Jason Frame https://twitter.com/jaz303 v 1.0.0a
/* http://onehackoranother.com/projects/jquery/tipsy/
/* (c) 2008-2010 jason frame [jason@onehackoranother.com]
/* releated under the MIT license
/*
/* !!! I did some modifications on that plugin! !!!
/*----------------------------------------------------------------------*/
	


(function ($) {
	function fixTitle($ele) {
		if ($ele.attr('title') || typeof ($ele.attr('original-title')) != 'string') {
			$ele.attr('original-title', $ele.attr('title') || '').removeAttr('title');
		}
	}

	function Tipsy(element, options) {
		this.$element = $(element);
		this.options = options;
		this.enabled = true;
		fixTitle(this.$element);
	}

	Tipsy.prototype = {
		show: function () {
			var title = this.getTitle();
			if (title && this.enabled) {
				var $tip = this.tip();

				$tip.find('.tipsy-inner')[this.options.html ? 'html' : 'text'](title);
				$tip[0].className = 'tipsy'; // reset classname in case of dynamic gravity
				$tip.remove().css({
					top: 0,
					left: 0,
					visibility: 'hidden',
					display: 'block'
				}).appendTo(this.options.appendTo);
				var pos = $.extend({}, this.$element.offset(), {
					width: this.$element[0].offsetWidth,
					height: this.$element[0].offsetHeight
				});
				if(this.options.appendTo != 'body')pos.top = pos.left = 0;
				
				var actualWidth = $tip[0].offsetWidth,
					actualHeight = $tip[0].offsetHeight;
				var gravity = (typeof this.options.gravity == 'function') ? this.options.gravity.call(this.$element[0]) : this.options.gravity;

				var tp;
				var mp;
				switch (gravity.charAt(0)) {
				case 'n':
					tp = {
						top: pos.top + pos.height + this.options.offset,
						left: pos.left + pos.width / 2 - actualWidth / 2
					};
					mp = {top:15,left:-actualWidth/2};
					break;
				case 's':
					tp = {
						top: pos.top - actualHeight - this.options.offset,
						left: pos.left + pos.width / 2 - actualWidth / 2
					};
					mp = {top:-actualHeight-15,left:-actualWidth/2};
					break;
				case 'e':
					tp = {
						top: pos.top + pos.height / 2 - actualHeight / 2,
						left: pos.left - actualWidth - this.options.offset
					};
					mp = {top:-actualHeight/2,left:-12-actualWidth};
					break;
				case 'w':
					tp = {
						top: pos.top + pos.height / 2 - actualHeight / 2,
						left: pos.left + pos.width + this.options.offset
					};
					mp = {top:-actualHeight/2,left:12};
					break;
				}
				if (gravity.length == 2) {
					if (gravity.charAt(1) == 'w') {
						//tp.left = pos.left + pos.width / 2 - 15;
						tp.left = pos.left - 5;
						mp.left += actualWidth/2-15;
					} else {
						//tp.left = pos.left + pos.width / 2 - actualWidth + 15;
						mp.left -= actualWidth/2-15;
						tp.left = pos.left + pos.width - actualWidth + 5;
					}
				}
				
				if(this.options.followMouse){
					$(document).bind('mousemove.tipsy',function(e){
						var x = e.pageX+mp.left, y = e.pageY+mp.top;
						$tip.css({
							left: x,
							top: y
						});
					});
				}
				
				$tip.css(tp).addClass('tipsy-' + gravity);
				if (this.options.fade) {
					$tip.stop().css({
						opacity: 0,
						display: 'block',
						visibility: 'visible'
					}).animate({
						opacity: this.options.opacity
					});
				} else {
					$tip.css({
						visibility: 'visible',
						opacity: this.options.opacity
					});
				}
			}
		},

		hide: function () {
			if(this.options.followMouse){
				$(document).unbind('mousemove.tipsy');
			}
			if (this.options.fade) {
				this.tip().stop().fadeOut(function () {
					$(this).remove();
				});
			} else {
				this.tip().remove();
			}
		},

		getTitle: function () {
			var title, $e = this.$element,
				o = this.options;
			fixTitle($e);
			if (typeof o.title == 'string') {
				title = $e.attr(o.title == 'title' ? 'original-title' : o.title);
			} else if (typeof o.title == 'function') {
				title = o.title.call($e[0]);
			}
			if(!title) title = o.fallback;
			title = ('' + title).replace(/(^\s*|\s*$)/, "");
			return title || o.fallback;
		},
		
		setTitel: function(title) {
			this.options.fallback = title;
		},

		tip: function () {
			if (!this.$tip) {
				this.$tip = $('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-outer"><div class="tipsy-inner"/></div></div>');
			}
			return this.$tip;
		},

		validate: function () {
			if (!this.$element[0].parentNode) {
				this.hide();
				this.$element = null;
				this.options = null;
			}
		},

		enable: function () {
			this.enabled = true;
		},
		disable: function () {
			this.enabled = false;
		},
		update: function () {
			var $tip = this.tip();
			$tip.find('.tipsy-inner')[this.options.html ? 'html' : 'text'](this.options.fallback);
		},
		toggleEnabled: function () {
			this.enabled = !this.enabled;
		}
	};

	$.fn.tipsy = function (options) {

		if (options === true) {
			return this.data('tipsy');
		} else if (typeof options == 'string') {
			return this.data('tipsy')[options](arguments[1], arguments[2]);
		}

		options = $.extend({}, $.fn.tipsy.defaults, options);

		function get(ele) {
			var tipsy = $.data(ele, 'tipsy');
			if (!tipsy) {
				tipsy = new Tipsy(ele, $.fn.tipsy.elementOptions(ele, options));
				$.data(ele, 'tipsy', tipsy);
			}
			return tipsy;
		}

		function enter() {
			var tipsy = get(this);
			tipsy.hoverState = 'in';
			if (options.delayIn == 0) {
				tipsy.show();
			} else {
				setTimeout(function () {
					if (tipsy.hoverState == 'in') tipsy.show();
				}, options.delayIn);
			}
		};

		function leave() {
			var tipsy = get(this);
			tipsy.hoverState = 'out';
			if (options.delayOut == 0) {
				tipsy.hide();
			} else {
				setTimeout(function () {
					if (tipsy.hoverState == 'out') tipsy.hide();
				}, options.delayOut);
			}
		};

		if (!options.live) this.each(function () {
			get(this);
		});
		if (options.trigger != 'manual') {
			var binder = options.live ? 'live' : 'bind',
				eventIn = options.trigger == 'hover' ? 'mouseenter' : 'focus',
				eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur';
			this[binder](eventIn+'.tipsy', enter)[binder](eventOut+'.tipsy', leave);
		}

		return this;

	};

	$.fn.tipsy.defaults = {
		delayIn: 0,
		delayOut: 0,
		fade: false,
		fallback: '',
		gravity: 'n',
		html: false,
		live: false,
		offset: 0,
		opacity: 0.8,
		//CUSTOM followMouse
		followMouse: false,
		appendTo: 'body',
		title: 'title',
		trigger: 'hover'
	};

	// Overwrite this method to provide options on a per-element basis.
	// For example, you could store the gravity in a 'tipsy-gravity' attribute:
	// return $.extend({}, options, {gravity: $(ele).attr('tipsy-gravity') || 'n' });
	// (remember - do not modify 'options' in place!)
	$.fn.tipsy.elementOptions = function (ele, options) {
		return $.metadata ? $.extend({}, options, $(ele).metadata()) : options;
	};

	$.fn.tipsy.autoNS = function () {
		return $(this).offset().top > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
	};

	$.fn.tipsy.autoWE = function () {
		return $(this).offset().left > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
	};

})(jQuery);


/*----------------------------------------------------------------------*/
/* jQuery Uniform v1.7.5
/* Copyright © 2009 Josh Pyles / Pixelmatrix Design LLC
/* http://pixelmatrixdesign.com
/* License: MIT License - http://www.opensource.org/licenses/mit-license.php
/*----------------------------------------------------------------------*/
	

(function($) {
  $.uniform = {
    options: {
      selectClass:   'selector',
      radioClass: 'radio',
      checkboxClass: 'checker',
      fileClass: 'uploader',
      filenameClass: 'filename',
      fileBtnClass: 'action',
      fileDefaultText: 'No file selected',
      fileBtnText: 'Choose File',
      checkedClass: 'checked',
      focusClass: 'focus',
      disabledClass: 'disabled',
      buttonClass: 'button',
      activeClass: 'active',
      hoverClass: 'hover',
      useID: true,
      idPrefix: 'uniform',
      resetSelector: false,
      autoHide: true
    },
    elements: []
  };

  if($.browser.msie && $.browser.version < 7){
    $.support.selectOpacity = false;
  }else{
    $.support.selectOpacity = true;
  }

  $.fn.uniform = function(options) {

    options = $.extend($.uniform.options, options);

    var el = this;
    //code for specifying a reset button
    if(options.resetSelector != false){
      $(options.resetSelector).mouseup(function(){
        function resetThis(){
          $.uniform.update(el);
        }
        setTimeout(resetThis, 10);
      });
    }
    
    function doInput(elem){
      $el = $(elem);
      $el.addClass($el.attr("type"));
      storeElement(elem);
    }
    
    function doTextarea(elem){
      $(elem).addClass("uniform");
      storeElement(elem);
    }
    
    function doButton(elem){
      var $el = $(elem);
      
      var divTag = $("<div>"),
          spanTag = $("<span>");
      
      divTag.addClass(options.buttonClass);
      
      if(options.useID && $el.attr("id") != "") divTag.attr("id", options.idPrefix+"-"+$el.attr("id"));
      
      var btnText;
      
      if($el.is("a") || $el.is("button")){
        btnText = $el.text();
      }else if($el.is(":submit") || $el.is(":reset") || $el.is("input[type=button]")){
        btnText = $el.attr("value");
      }
      
      btnText = btnText == "" ? $el.is(":reset") ? "Reset" : "Submit" : btnText;
      
      spanTag.html(btnText);
      
      $el.css("opacity", 0);
      $el.wrap(divTag);
      $el.wrap(spanTag);
      
      //redefine variables
      divTag = $el.closest("div");
      spanTag = $el.closest("span");
      
      if($el.is(":disabled")) divTag.addClass(options.disabledClass);
      
      divTag.bind({
        "mouseenter.uniform": function(){
          divTag.addClass(options.hoverClass);
        },
        "mouseleave.uniform": function(){
          divTag.removeClass(options.hoverClass);
          divTag.removeClass(options.activeClass);
        },
        "mousedown.uniform touchbegin.uniform": function(){
          divTag.addClass(options.activeClass);
        },
        "mouseup.uniform touchend.uniform": function(){
          divTag.removeClass(options.activeClass);
        },
        "click.uniform touchend.uniform": function(e){
          if($(e.target).is("span") || $(e.target).is("div")){    
            if(elem[0].dispatchEvent){
              var ev = document.createEvent('MouseEvents');
              ev.initEvent( 'click', true, true );
              elem[0].dispatchEvent(ev);
            }else{
              elem[0].click();
            }
          }
        }
      });
      
      elem.bind({
        "focus.uniform": function(){
          divTag.addClass(options.focusClass);
        },
        "blur.uniform": function(){
          divTag.removeClass(options.focusClass);
        }
      });
      
      $.uniform.noSelect(divTag);
      storeElement(elem);
      
    }

    function doSelect(elem){
      var $el = $(elem);
      
      var divTag = $('<div />'),
          spanTag = $('<span />');
      
      if(!$el.css("display") == "none" && options.autoHide){
        divTag.hide();
      }

      divTag.addClass(options.selectClass);

      if(options.useID && elem.attr("id") != ""){
        divTag.attr("id", options.idPrefix+"-"+elem.attr("id"));
      }
      
      var selected = elem.find(":selected:first");
      if(selected.length == 0){
        selected = elem.find("option:first");
      }
      spanTag.html(selected.html());
      
      elem.css('opacity', 0);
      elem.wrap(divTag);
      elem.before(spanTag);

      //redefine variables
      divTag = elem.parent("div");
      spanTag = elem.siblings("span");

      elem.bind({
        "change.uniform": function() {
          spanTag.text(elem.find(":selected").html());
          divTag.removeClass(options.activeClass);
        },
        "focus.uniform": function() {
          divTag.addClass(options.focusClass);
        },
        "blur.uniform": function() {
          divTag.removeClass(options.focusClass);
          divTag.removeClass(options.activeClass);
        },
        "mousedown.uniform touchbegin.uniform": function() {
          divTag.addClass(options.activeClass);
        },
        "mouseup.uniform touchend.uniform": function() {
          divTag.removeClass(options.activeClass);
        },
        "click.uniform touchend.uniform": function(){
          divTag.removeClass(options.activeClass);
        },
        "mouseenter.uniform": function() {
          divTag.addClass(options.hoverClass);
        },
        "mouseleave.uniform": function() {
          divTag.removeClass(options.hoverClass);
          divTag.removeClass(options.activeClass);
        },
        "keyup.uniform": function(){
          spanTag.text(elem.find(":selected").html());
        }
      });
      
      //handle disabled state
      if($(elem).attr("disabled")){
        //box is checked by default, check our box
        divTag.addClass(options.disabledClass);
      }
      $.uniform.noSelect(spanTag);
      
      storeElement(elem);

    }

    function doCheckbox(elem){
      var $el = $(elem);
      var divTag = $('<div />'),
          spanTag = $('<span />');
      
      if(!$el.css("display") == "none" && options.autoHide){
        divTag.hide();
      }
      
      divTag.addClass(options.checkboxClass);

      //assign the id of the element
      if(options.useID && elem.attr("id") != ""){
        divTag.attr("id", options.idPrefix+"-"+elem.attr("id"));
      }

      //wrap with the proper elements
      $(elem).wrap(divTag);
      $(elem).wrap(spanTag);

      //redefine variables
      spanTag = elem.parent();
      divTag = spanTag.parent();

      //hide normal input and add focus classes
      $(elem)
      .css("opacity", 0)
      .bind({
        "focus.uniform": function(){
          divTag.addClass(options.focusClass);
        },
        "blur.uniform": function(){
          divTag.removeClass(options.focusClass);
        },
        "click.uniform touchend.uniform": function(){
          if(!$(elem).attr("checked")){
            //box was just unchecked, uncheck span
            spanTag.removeClass(options.checkedClass);
          }else{
            //box was just checked, check span.
            spanTag.addClass(options.checkedClass);
          }
        },
        "mousedown.uniform touchbegin.uniform": function() {
          divTag.addClass(options.activeClass);
        },
        "mouseup.uniform touchend.uniform": function() {
          divTag.removeClass(options.activeClass);
        },
        "mouseenter.uniform": function() {
          divTag.addClass(options.hoverClass);
        },
        "mouseleave.uniform": function() {
          divTag.removeClass(options.hoverClass);
          divTag.removeClass(options.activeClass);
        }
      });
      
      //handle defaults
      if($(elem).attr("checked")){
        //box is checked by default, check our box
        spanTag.addClass(options.checkedClass);
      }

      //handle disabled state
      if($(elem).attr("disabled")){
        //box is checked by default, check our box
        divTag.addClass(options.disabledClass);
      }

      storeElement(elem);
    }

    function doRadio(elem){
      var $el = $(elem);
      
      var divTag = $('<div />'),
          spanTag = $('<span />');
          
      if(!$el.css("display") == "none" && options.autoHide){
        divTag.hide();
      }

      divTag.addClass(options.radioClass);

      if(options.useID && elem.attr("id") != ""){
        divTag.attr("id", options.idPrefix+"-"+elem.attr("id"));
      }

      //wrap with the proper elements
      $(elem).wrap(divTag);
      $(elem).wrap(spanTag);

      //redefine variables
      spanTag = elem.parent();
      divTag = spanTag.parent();

      //hide normal input and add focus classes
      $(elem)
      .css("opacity", 0)
      .bind({
        "focus.uniform": function(){
          divTag.addClass(options.focusClass);
        },
        "blur.uniform": function(){
          divTag.removeClass(options.focusClass);
        },
        "click.uniform touchend.uniform": function(){
          if(!$(elem).attr("checked")){
            //box was just unchecked, uncheck span
            spanTag.removeClass(options.checkedClass);
          }else{
            //box was just checked, check span
            var classes = options.radioClass.split(" ")[0];
            $("." + classes + " span." + options.checkedClass + ":has([name='" + $(elem).attr('name') + "'])").removeClass(options.checkedClass);
            spanTag.addClass(options.checkedClass);
          }
        },
        "mousedown.uniform touchend.uniform": function() {
          if(!$(elem).is(":disabled")){
            divTag.addClass(options.activeClass);
          }
        },
        "mouseup.uniform touchbegin.uniform": function() {
          divTag.removeClass(options.activeClass);
        },
        "mouseenter.uniform touchend.uniform": function() {
          divTag.addClass(options.hoverClass);
        },
        "mouseleave.uniform": function() {
          divTag.removeClass(options.hoverClass);
          divTag.removeClass(options.activeClass);
        }
      });

      //handle defaults
      if($(elem).attr("checked")){
        //box is checked by default, check span
        spanTag.addClass(options.checkedClass);
      }
      //handle disabled state
      if($(elem).attr("disabled")){
        //box is checked by default, check our box
        divTag.addClass(options.disabledClass);
      }

      storeElement(elem);

    }

    function doFile(elem){
      //sanitize input
      var $el = $(elem);

      var divTag = $('<div />'),
          filenameTag = $('<span>'+options.fileDefaultText+'</span>'),
          btnTag = $('<span>'+options.fileBtnText+'</span>');
      
      if(!$el.css("display") == "none" && options.autoHide){
        divTag.hide();
      }

      divTag.addClass(options.fileClass);
      filenameTag.addClass(options.filenameClass);
      btnTag.addClass(options.fileBtnClass);

      if(options.useID && $el.attr("id") != ""){
        divTag.attr("id", options.idPrefix+"-"+$el.attr("id"));
      }

      //wrap with the proper elements
      $el.wrap(divTag);
      $el.after(btnTag);
      $el.after(filenameTag);

      //redefine variables
      divTag = $el.closest("div");
      filenameTag = $el.siblings("."+options.filenameClass);
      btnTag = $el.siblings("."+options.fileBtnClass);

      //set the size
      if(!$el.attr("size")){
        var divWidth = divTag.width();
        //$el.css("width", divWidth);
        $el.attr("size", divWidth/10);
      }

      //actions
      var setFilename = function()
      {
        var filename = $el.val();
        if (filename === '')
        {
          filename = options.fileDefaultText;
        }
        else
        {
          filename = filename.split(/[\/\\]+/);
          filename = filename[(filename.length-1)];
        }
        filenameTag.text(filename);
      };

      // Account for input saved across refreshes
      setFilename();

      $el
      .css("opacity", 0)
      .bind({
        "focus.uniform": function(){
          divTag.addClass(options.focusClass);
        },
        "blur.uniform": function(){
          divTag.removeClass(options.focusClass);
        },
        "mousedown.uniform": function() {
          if(!$(elem).is(":disabled")){
            divTag.addClass(options.activeClass);
          }
        },
        "mouseup.uniform": function() {
          divTag.removeClass(options.activeClass);
        },
        "mouseenter.uniform": function() {
          divTag.addClass(options.hoverClass);
        },
        "mouseleave.uniform": function() {
          divTag.removeClass(options.hoverClass);
          divTag.removeClass(options.activeClass);
        }
      });

      // IE7 doesn't fire onChange until blur or second fire.
      if ($.browser.msie){
        // IE considers browser chrome blocking I/O, so it
        // suspends tiemouts until after the file has been selected.
        $el.bind('click.uniform.ie7', function() {
          setTimeout(setFilename, 0);
        });
      }else{
        // All other browsers behave properly
        $el.bind('change.uniform', setFilename);
      }

      //handle defaults
      if($el.attr("disabled")){
        //box is checked by default, check our box
        divTag.addClass(options.disabledClass);
      }
      
      $.uniform.noSelect(filenameTag);
      $.uniform.noSelect(btnTag);
      
      storeElement(elem);

    }
    
    $.uniform.restore = function(elem){
      if(elem == undefined){
        elem = $($.uniform.elements);
      }
      
      $(elem).each(function(){
        if($(this).is(":checkbox")){
          //unwrap from span and div
          $(this).unwrap().unwrap();
        }else if($(this).is("select")){
          //remove sibling span
          $(this).siblings("span").remove();
          //unwrap parent div
          $(this).unwrap();
        }else if($(this).is(":radio")){
          //unwrap from span and div
          $(this).unwrap().unwrap();
        }else if($(this).is(":file")){
          //remove sibling spans
          $(this).siblings("span").remove();
          //unwrap parent div
          $(this).unwrap();
        }else if($(this).is("button, :submit, :reset, a, input[type='button']")){
          //unwrap from span and div
          $(this).unwrap().unwrap();
        }
        
        //unbind events
        $(this).unbind(".uniform");
        
        //reset inline style
        $(this).css("opacity", "1");
        
        //remove item from list of uniformed elements
        var index = $.inArray($(elem), $.uniform.elements);
        $.uniform.elements.splice(index, 1);
      });
    };

    function storeElement(elem){
      //store this element in our global array
      elem = $(elem).get();
      if(elem.length > 1){
        $.each(elem, function(i, val){
          $.uniform.elements.push(val);
        });
      }else{
        $.uniform.elements.push(elem);
      }
    }
    
    //noSelect v1.0
    $.uniform.noSelect = function(elem) {
      function f() {
       return false;
      };
      $(elem).each(function() {
       this.onselectstart = this.ondragstart = f; // Webkit & IE
       $(this)
        .mousedown(f) // Webkit & Opera
        .css({ MozUserSelect: 'none' }); // Firefox
      });
     };

    $.uniform.update = function(elem){
      if(elem == undefined){
        elem = $($.uniform.elements);
      }
      //sanitize input
      elem = $(elem);

      elem.each(function(){
        //do to each item in the selector
        //function to reset all classes
        var $e = $(this);

        if($e.is("select")){
          //element is a select
          var spanTag = $e.siblings("span");
          var divTag = $e.parent("div");

          divTag.removeClass(options.hoverClass+" "+options.focusClass+" "+options.activeClass);

          //reset current selected text
          spanTag.html($e.find(":selected").html());

          if($e.is(":disabled")){
            divTag.addClass(options.disabledClass);
          }else{
            divTag.removeClass(options.disabledClass);
          }

        }else if($e.is(":checkbox")){
          //element is a checkbox
          var spanTag = $e.closest("span");
          var divTag = $e.closest("div");

          divTag.removeClass(options.hoverClass+" "+options.focusClass+" "+options.activeClass);
          spanTag.removeClass(options.checkedClass);

          if($e.is(":checked")){
            spanTag.addClass(options.checkedClass);
          }
          if($e.is(":disabled")){
            divTag.addClass(options.disabledClass);
          }else{
            divTag.removeClass(options.disabledClass);
          }

        }else if($e.is(":radio")){
          //element is a radio
          var spanTag = $e.closest("span");
          var divTag = $e.closest("div");

          divTag.removeClass(options.hoverClass+" "+options.focusClass+" "+options.activeClass);
          spanTag.removeClass(options.checkedClass);

          if($e.is(":checked")){
            spanTag.addClass(options.checkedClass);
          }

          if($e.is(":disabled")){
            divTag.addClass(options.disabledClass);
          }else{
            divTag.removeClass(options.disabledClass);
          }
        }else if($e.is(":file")){
          var divTag = $e.parent("div");
          var filenameTag = $e.siblings(options.filenameClass);
          btnTag = $e.siblings(options.fileBtnClass);

          divTag.removeClass(options.hoverClass+" "+options.focusClass+" "+options.activeClass);

          filenameTag.text($e.val());

          if($e.is(":disabled")){
            divTag.addClass(options.disabledClass);
          }else{
            divTag.removeClass(options.disabledClass);
          }
        }else if($e.is(":submit") || $e.is(":reset") || $e.is("button") || $e.is("a") || elem.is("input[type=button]")){
          var divTag = $e.closest("div");
          divTag.removeClass(options.hoverClass+" "+options.focusClass+" "+options.activeClass);
          
          if($e.is(":disabled")){
            divTag.addClass(options.disabledClass);
          }else{
            divTag.removeClass(options.disabledClass);
          }
          
        }
        
      });
    };

    return this.each(function() {
      if($.support.selectOpacity){
        var elem = $(this);

        if(elem.is("select")){
          //element is a select
          if(elem.attr("multiple") != true){
            //element is not a multi-select
            if(elem.attr("size") == undefined || elem.attr("size") <= 1){
              doSelect(elem);
            }
          }
        }else if(elem.is(":checkbox")){
          //element is a checkbox
          doCheckbox(elem);
        }else if(elem.is(":radio")){
          //element is a radio
          doRadio(elem);
        }else if(elem.is(":file")){
          //element is a file upload
          doFile(elem);
        }else if(elem.is(":text, :password, input[type='email']")){
          doInput(elem);
        }else if(elem.is("textarea")){
          doTextarea(elem);
        }else if(elem.is("a") || elem.is(":submit") || elem.is(":reset") || elem.is("button") || elem.is("input[type=button]")){
          doButton(elem);
        }
          
      }
    });
  };
})(jQuery);


/*----------------------------------------------------------------------*/
/* Elastic jQuery plugin v1.6.5
/* Copyright 2011, Jan Jarfalk
/* http://www.unwrongest.com
/* MIT License - http://www.opensource.org/licenses/mit-license.php
/*----------------------------------------------------------------------*/


(function(jQuery){ 
	jQuery.fn.extend({  
		elastic: function() {
		
			//	We will create a div clone of the textarea
			//	by copying these attributes from the textarea to the div.
			var mimics = [
				'paddingTop',
				'paddingRight',
				'paddingBottom',
				'paddingLeft',
				'fontSize',
				'lineHeight',
				'fontFamily',
				'width',
				'fontWeight'];
			
			return this.each( function() {
				
				// Elastic only works on textareas
				if ( this.type != 'textarea' ) {
					return false;
				}
				
				var $textarea	=	jQuery(this),
					$twin		=	jQuery('<div />').css({'position': 'absolute','display':'none','word-wrap':'break-word'}),
					lineHeight	=	parseInt($textarea.css('line-height'),10) || parseInt($textarea.css('font-size'),'10'),
					minheight	=	parseInt($textarea.css('height'),10) || lineHeight*3,
					maxheight	=	parseInt($textarea.css('max-height'),10) || Number.MAX_VALUE,
					goalheight	=	0,
					i 			=	0;
				
				// Opera returns max-height of -1 if not set
				if (maxheight < 0) { maxheight = Number.MAX_VALUE; }
					
				// Append the twin to the DOM
				// We are going to meassure the height of this, not the textarea.
				$twin.appendTo($textarea.parent());
				
				// Copy the essential styles (mimics) from the textarea to the twin
				var i = mimics.length;
				while(i--){
					$twin.css(mimics[i].toString(),$textarea.css(mimics[i].toString()));
				}
				
				
				// Sets a given height and overflow state on the textarea
				function setHeightAndOverflow(height, overflow){
					curratedHeight = Math.floor(parseInt(height,10));
					if($textarea.height() != curratedHeight){
						$textarea.css({'height': curratedHeight + 'px','overflow':overflow});
						
					}
				}
				
				
				// This function will update the height of the textarea if necessary 
				function update() {
					
					// Get curated content from the textarea.
					var textareaContent = $textarea.val().replace(/&/g,'&amp;').replace(/  /g, '&nbsp;').replace(/<|>/g, '&gt;').replace(/\n/g, '<br />');
					
					// Compare curated content with curated twin.
					var twinContent = $twin.html().replace(/<br>/ig,'<br />');
					
					if(textareaContent+'&nbsp;' != twinContent){
					
						// Add an extra white space so new rows are added when you are at the end of a row.
						$twin.html(textareaContent+'&nbsp;');
						
						// Change textarea height if twin plus the height of one line differs more than 3 pixel from textarea height
						if(Math.abs($twin.height() + lineHeight - $textarea.height()) > 3){
							
							var goalheight = $twin.height()+lineHeight;
							if(goalheight >= maxheight) {
								setHeightAndOverflow(maxheight,'auto');
							} else if(goalheight <= minheight) {
								setHeightAndOverflow(minheight,'hidden');
							} else {
								setHeightAndOverflow(goalheight,'hidden');
							}
							
						}
						
					}
					
				}
				
				// Hide scrollbars
				$textarea.css({'overflow':'hidden'});
				
				// Update textarea size on keyup, change, cut and paste
				$textarea.bind('keyup change cut paste', function(){
					update(); 
				});
				
				// Compact textarea on blur
				// Lets animate this....
				$textarea.bind('blur',function(){
					if($twin.height() < maxheight){
						if($twin.height() > minheight) {
							$textarea.height($twin.height());
						} else {
							$textarea.height(minheight);
						}
					}
				});
				
				// And this line is to catch the browser paste event
				$textarea.live('input paste',function(e){ setTimeout( update, 250); });				
				
				// Run update once when elastic is initialized
				update();
				
			});
			
		} 
	}); 
})(jQuery);	

/*----------------------------------------------------------------------*/
/* jQuery miniColors: A small color selector
/* Copyright 2011 Cory LaViska for A Beautiful Site, LLC.
/* http://abeautifulsite.net/blog/2011/02/jquery-minicolors-a-color-selector-for-input-controls/
/* Dual licensed under the MIT or GPL Version 2 licenses
/*----------------------------------------------------------------------*/



(function ($) {
	$.fn.miniColors = function (o, data) {


		var create = function (input, o, data) {

				//
				// Creates a new instance of the miniColors selector
				//
				// Determine initial color (defaults to white)
				var color = cleanHex(input.val());
				if (!color) color = 'FFFFFF';
				var hsb = hex2hsb(color);

				// Create trigger
				var trigger = $('<a class="miniColors-trigger" style="background-color: #' + color + '" href="#"></a>');
				trigger.insertAfter(input);

				// Add necessary attributes
				input.addClass('miniColors').attr('maxlength', 7).attr('autocomplete', 'off');

				// Set input data
				input.data('trigger', trigger);
				input.data('hsb', hsb);
				if (o.change) input.data('change', o.change);

				// Handle options
				if (o.readonly) input.attr('readonly', true);
				if (o.disabled) disable(input);

				// Show selector when trigger is clicked
				trigger.bind('click.miniColors', function (event) {
					event.preventDefault();
					input.trigger('focus');
				});

				// Show selector when input receives focus
				input.bind('focus.miniColors', function (event) {
					show(input);
				});

				// Hide on blur
				input.bind('blur.miniColors', function (event) {
					var hex = cleanHex(input.val());
					input.val(hex ? '#' + hex : '');
				});

				// Hide when tabbing out of the input
				input.bind('keydown.miniColors', function (event) {
					if (event.keyCode === 9) hide(input);
				});

				// Update when color is typed in
				input.bind('keyup.miniColors', function (event) {
					// Remove non-hex characters
					var filteredHex = input.val().replace(/[^A-F0-9#]/ig, '');
					input.val(filteredHex);
					if (!setColorFromInput(input)) {
						// Reset trigger color when color is invalid
						input.data('trigger').css('backgroundColor', '#FFF');
					}
				});

				// Handle pasting
				input.bind('paste.miniColors', function (event) {
					// Short pause to wait for paste to complete
					setTimeout(function () {
						input.trigger('keyup');
					}, 5);
				});

			};


		var destroy = function (input) {

				//
				// Destroys an active instance of the miniColors selector
				//
				hide();

				input = $(input);
				input.data('trigger').remove();
				input.removeAttr('autocomplete');
				input.removeData('trigger');
				input.removeData('selector');
				input.removeData('hsb');
				input.removeData('huePicker');
				input.removeData('colorPicker');
				input.removeData('mousebutton');
				input.removeData('moving');
				input.unbind('click.miniColors');
				input.unbind('focus.miniColors');
				input.unbind('blur.miniColors');
				input.unbind('keyup.miniColors');
				input.unbind('keydown.miniColors');
				input.unbind('paste.miniColors');
				$(document).unbind('mousedown.miniColors');
				$(document).unbind('mousemove.miniColors');

			};


		var enable = function (input) {

				//
				// Disables the input control and the selector
				//
				input.attr('disabled', false);
				input.data('trigger').css('opacity', 1);

			};


		var disable = function (input) {

				//
				// Disables the input control and the selector
				//
				hide(input);
				input.attr('disabled', true);
				input.data('trigger').css('opacity', .5);

			};


		var show = function (input) {

				//
				// Shows the miniColors selector
				//
				if (input.attr('disabled')) return false;

				// Hide all other instances 
				hide();

				// Generate the selector
				var selector = $('<div class="miniColors-selector"></div>');
				selector.append('<div class="miniColors-colors" style="background-color: #FFF;"><div class="miniColors-colorPicker"></div></div>');
				selector.append('<div class="miniColors-hues"><div class="miniColors-huePicker"></div></div>');
				selector.css({
					top: input.is(':visible') ? input.offset().top + input.outerHeight() : input.data('trigger').offset().top + input.data('trigger').outerHeight(),
					left: input.is(':visible') ? input.offset().left : input.data('trigger').offset().left,
					display: 'none'
				}).addClass(input.attr('class'));

				// Set background for colors
				var hsb = input.data('hsb');
				selector.find('.miniColors-colors').css('backgroundColor', '#' + hsb2hex({
					h: hsb.h,
					s: 100,
					b: 100
				}));

				// Set colorPicker position
				var colorPosition = input.data('colorPosition');
				if (!colorPosition) colorPosition = getColorPositionFromHSB(hsb);
				selector.find('.miniColors-colorPicker').css('top', colorPosition.y + 'px').css('left', colorPosition.x + 'px');

				// Set huePicker position
				var huePosition = input.data('huePosition');
				if (!huePosition) huePosition = getHuePositionFromHSB(hsb);
				selector.find('.miniColors-huePicker').css('top', huePosition.y + 'px');


				// Set input data
				input.data('selector', selector);
				input.data('huePicker', selector.find('.miniColors-huePicker'));
				input.data('colorPicker', selector.find('.miniColors-colorPicker'));
				input.data('mousebutton', 0);

				$('BODY').append(selector);
				selector.fadeIn(100);

				// Prevent text selection in IE
				selector.bind('selectstart', function () {
					return false;
				});

				$(document).bind('mousedown.miniColors', function (event) {
					input.data('mousebutton', 1);

					if ($(event.target).parents().andSelf().hasClass('miniColors-colors')) {
						event.preventDefault();
						input.data('moving', 'colors');
						moveColor(input, event);
					}

					if ($(event.target).parents().andSelf().hasClass('miniColors-hues')) {
						event.preventDefault();
						input.data('moving', 'hues');
						moveHue(input, event);
					}

					if ($(event.target).parents().andSelf().hasClass('miniColors-selector')) {
						event.preventDefault();
						return;
					}

					if ($(event.target).parents().andSelf().hasClass('miniColors')) return;

					hide(input);
				});

				$(document).bind('mouseup.miniColors', function (event) {
					input.data('mousebutton', 0);
					input.removeData('moving');
				});

				$(document).bind('mousemove.miniColors', function (event) {
					if (input.data('mousebutton') === 1) {
						if (input.data('moving') === 'colors') moveColor(input, event);
						if (input.data('moving') === 'hues') moveHue(input, event);
					}
				});

			};


		var hide = function (input) {

				//
				// Hides one or more miniColors selectors
				//
				// Hide all other instances if input isn't specified
				if (!input) input = '.miniColors';

				$(input).each(function () {
					var selector = $(this).data('selector');
					$(this).removeData('selector');
					$(selector).fadeOut(100, function () {
						$(this).remove();
					});
				});

				$(document).unbind('mousedown.miniColors');
				$(document).unbind('mousemove.miniColors');

			};


		var moveColor = function (input, event) {

				var colorPicker = input.data('colorPicker');

				colorPicker.hide();

				var position = {
					x: event.clientX - input.data('selector').find('.miniColors-colors').offset().left + $(document).scrollLeft() - 5,
					y: event.clientY - input.data('selector').find('.miniColors-colors').offset().top + $(document).scrollTop() - 5
				};

				if (position.x <= -5) position.x = -5;
				if (position.x >= 144) position.x = 144;
				if (position.y <= -5) position.y = -5;
				if (position.y >= 144) position.y = 144;
				input.data('colorPosition', position);
				colorPicker.css('left', position.x).css('top', position.y).show();

				// Calculate saturation
				var s = Math.round((position.x + 5) * .67);
				if (s < 0) s = 0;
				if (s > 100) s = 100;

				// Calculate brightness
				var b = 100 - Math.round((position.y + 5) * .67);
				if (b < 0) b = 0;
				if (b > 100) b = 100;

				// Update HSB values
				var hsb = input.data('hsb');
				hsb.s = s;
				hsb.b = b;

				// Set color
				setColor(input, hsb, true);

			};


		var moveHue = function (input, event) {

				var huePicker = input.data('huePicker');

				huePicker.hide();

				var position = {
					y: event.clientY - input.data('selector').find('.miniColors-colors').offset().top + $(document).scrollTop() - 1
				};

				if (position.y <= -1) position.y = -1;
				if (position.y >= 149) position.y = 149;
				input.data('huePosition', position);
				huePicker.css('top', position.y).show();

				// Calculate hue
				var h = Math.round((150 - position.y - 1) * 2.4);
				if (h < 0) h = 0;
				if (h > 360) h = 360;

				// Update HSB values
				var hsb = input.data('hsb');
				hsb.h = h;

				// Set color
				setColor(input, hsb, true);

			};


		var setColor = function (input, hsb, updateInputValue) {

				input.data('hsb', hsb);
				var hex = hsb2hex(hsb);
				if (updateInputValue) input.val('#' + hex);
				input.data('trigger').css('backgroundColor', '#' + hex);
				if (input.data('selector')) input.data('selector').find('.miniColors-colors').css('backgroundColor', '#' + hsb2hex({
					h: hsb.h,
					s: 100,
					b: 100
				}));

				if (input.data('change')) {
					input.data('change').call(input, '#' + hex, hsb2rgb(hsb));
				}

			};


		var setColorFromInput = function (input) {

				// Don't update if the hex color is invalid
				var hex = cleanHex(input.val());
				if (!hex) return false;

				// Get HSB equivalent
				var hsb = hex2hsb(hex);

				// If color is the same, no change required
				var currentHSB = input.data('hsb');
				if (hsb.h === currentHSB.h && hsb.s === currentHSB.s && hsb.b === currentHSB.b) return true;

				// Set colorPicker position
				var colorPosition = getColorPositionFromHSB(hsb);
				var colorPicker = $(input.data('colorPicker'));
				colorPicker.css('top', colorPosition.y + 'px').css('left', colorPosition.x + 'px');

				// Set huePosition position
				var huePosition = getHuePositionFromHSB(hsb);
				var huePicker = $(input.data('huePicker'));
				huePicker.css('top', huePosition.y + 'px');

				setColor(input, hsb, false);

				return true;

			};


		var getColorPositionFromHSB = function (hsb) {

				var x = Math.ceil(hsb.s / .67);
				if (x < 0) x = 0;
				if (x > 150) x = 150;

				var y = 150 - Math.ceil(hsb.b / .67);
				if (y < 0) y = 0;
				if (y > 150) y = 150;

				return {
					x: x - 5,
					y: y - 5
				};

			};


		var getHuePositionFromHSB = function (hsb) {

				var y = 150 - (hsb.h / 2.4);
				if (y < 0) h = 0;
				if (y > 150) h = 150;

				return {
					y: y - 1
				};

			};


		var cleanHex = function (hex) {

				//
				// Turns a dirty hex string into clean, 6-character hex color
				//
				hex = hex.replace(/[^A-Fa-f0-9]/, '');

				if (hex.length == 3) {
					hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
				}

				return hex.length === 6 ? hex : null;

			};


		var hsb2rgb = function (hsb) {
				var rgb = {};
				var h = Math.round(hsb.h);
				var s = Math.round(hsb.s * 255 / 100);
				var v = Math.round(hsb.b * 255 / 100);
				if (s == 0) {
					rgb.r = rgb.g = rgb.b = v;
				} else {
					var t1 = v;
					var t2 = (255 - s) * v / 255;
					var t3 = (t1 - t2) * (h % 60) / 60;
					if (h == 360) h = 0;
					if (h < 60) {
						rgb.r = t1;
						rgb.b = t2;
						rgb.g = t2 + t3;
					} else if (h < 120) {
						rgb.g = t1;
						rgb.b = t2;
						rgb.r = t1 - t3;
					} else if (h < 180) {
						rgb.g = t1;
						rgb.r = t2;
						rgb.b = t2 + t3;
					} else if (h < 240) {
						rgb.b = t1;
						rgb.r = t2;
						rgb.g = t1 - t3;
					} else if (h < 300) {
						rgb.b = t1;
						rgb.g = t2;
						rgb.r = t2 + t3;
					} else if (h < 360) {
						rgb.r = t1;
						rgb.g = t2;
						rgb.b = t1 - t3;
					} else {
						rgb.r = 0;
						rgb.g = 0;
						rgb.b = 0;
					}
				}
				return {
					r: Math.round(rgb.r),
					g: Math.round(rgb.g),
					b: Math.round(rgb.b)
				};
			};


		var rgb2hex = function (rgb) {

				var hex = [
				rgb.r.toString(16), rgb.g.toString(16), rgb.b.toString(16)];
				$.each(hex, function (nr, val) {
					if (val.length == 1) hex[nr] = '0' + val;
				});

				return hex.join('');
			};


		var hex2rgb = function (hex) {
				var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);

				return {
					r: hex >> 16,
					g: (hex & 0x00FF00) >> 8,
					b: (hex & 0x0000FF)
				};
			};


		var rgb2hsb = function (rgb) {
				var hsb = {
					h: 0,
					s: 0,
					b: 0
				};
				var min = Math.min(rgb.r, rgb.g, rgb.b);
				var max = Math.max(rgb.r, rgb.g, rgb.b);
				var delta = max - min;
				hsb.b = max;
				hsb.s = max != 0 ? 255 * delta / max : 0;
				if (hsb.s != 0) {
					if (rgb.r == max) {
						hsb.h = (rgb.g - rgb.b) / delta;
					} else if (rgb.g == max) {
						hsb.h = 2 + (rgb.b - rgb.r) / delta;
					} else {
						hsb.h = 4 + (rgb.r - rgb.g) / delta;
					}
				} else {
					hsb.h = -1;
				}
				hsb.h *= 60;
				if (hsb.h < 0) {
					hsb.h += 360;
				}
				hsb.s *= 100 / 255;
				hsb.b *= 100 / 255;
				return hsb;
			};


		var hex2hsb = function (hex) {
				var hsb = rgb2hsb(hex2rgb(hex));
				// Zero out hue marker for black, white, and grays (saturation === 0)
				if (hsb.s === 0) hsb.h = 360;
				return hsb;
			};


		var hsb2hex = function (hsb) {
				return rgb2hex(hsb2rgb(hsb));
			};


		//
		// Handle calls to $([selector]).miniColors()
		//
		switch (o) {

		case 'readonly':

			$(this).each(function () {
				$(this).attr('readonly', data);
			});

			return $(this);

			break;

		case 'disabled':

			$(this).each(function () {
				if (data) {
					disable($(this));
				} else {
					enable($(this));
				}
			});

			return $(this);

		case 'value':

			$(this).each(function () {
				if(typeof data !== 'string'){
					data = hsb2hex(data);
				}
				$(this).val(data).trigger('keyup');
			});

			return $(this);

			break;

		case 'destroy':

			$(this).each(function () {
				destroy($(this));
			});

			return $(this);

		default:

			if (!o) o = {};

			$(this).each(function () {

				// Must be called on an input element
				if ($(this)[0].tagName.toLowerCase() !== 'input') return;

				// If a trigger is present, the control was already created
				if ($(this).data('trigger')) return;

				// Create the control
				create($(this), o, data);

			});

			return $(this);

		}


	};

})(jQuery);



/*----------------------------------------------------------------------*/
/* 
/*----------------------------------------------------------------------*/



/*
 * jQuery Iframe Transport Plugin 1.2.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2011, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

/*jslint unparam: true */
/*global jQuery */

(function ($) {
    'use strict';

    // Helper variable to create unique names for the transport iframes:
    var counter = 0;

    // The iframe transport accepts three additional options:
    // options.fileInput: a jQuery collection of file input fields
    // options.paramName: the parameter name for the file form data,
    //  overrides the name property of the file input field(s)
    // options.formData: an array of objects with name and value properties,
    //  equivalent to the return data of .serializeArray(), e.g.:
    //  [{name: a, value: 1}, {name: b, value: 2}]
    $.ajaxTransport('iframe', function (options, originalOptions, jqXHR) {
        if (options.type === 'POST' || options.type === 'GET') {
            var form,
                iframe;
            return {
                send: function (headers, completeCallback) {
                    form = $('<form style="display:none;"></form>');
                    // javascript:false as initial iframe src
                    // prevents warning popups on HTTPS in IE6.
                    // IE versions below IE8 cannot set the name property of
                    // elements that have already been added to the DOM,
                    // so we set the name along with the iframe HTML markup:
                    iframe = $(
                        '<iframe src="javascript:false;" name="iframe-transport-' +
                            (counter += 1) + '"></iframe>'
                    ).bind('load', function () {
                        var fileInputClones;
                        iframe
                            .unbind('load')
                            .bind('load', function () {
                                var response;
                                // Wrap in a try/catch block to catch exceptions thrown
                                // when trying to access cross-domain iframe contents:
                                try {
                                    response = iframe.contents();
                                } catch (e) {
                                    response = $();
                                }
                                // The complete callback returns the
                                // iframe content document as response object:
                                completeCallback(
                                    200,
                                    'success',
                                    {'iframe': response}
                                );
                                // Fix for IE endless progress bar activity bug
                                // (happens on form submits to iframe targets):
                                $('<iframe src="javascript:false;"></iframe>')
                                    .appendTo(form);
                                form.remove();
                            });
                        form
                            .prop('target', iframe.prop('name'))
                            .prop('action', options.url)
                            .prop('method', options.type);
                        if (options.formData) {
                            $.each(options.formData, function (index, field) {
                                $('<input type="hidden"/>')
                                    .prop('name', field.name)
                                    .val(field.value)
                                    .appendTo(form);
                            });
                        }
                        if (options.fileInput && options.fileInput.length &&
                                options.type === 'POST') {
                            fileInputClones = options.fileInput.clone();
                            // Insert a clone for each file input field:
                            options.fileInput.after(function (index) {
                                return fileInputClones[index];
                            });
                            if (options.paramName) {
                                options.fileInput.each(function () {
                                    $(this).prop('name', options.paramName);
                                });
                            }
                            // Appending the file input fields to the hidden form
                            // removes them from their original location:
                            form
                                .append(options.fileInput)
                                .prop('enctype', 'multipart/form-data')
                                // enctype must be set as encoding for IE:
                                .prop('encoding', 'multipart/form-data');
                        }
                        form.submit();
                        // Insert the file input fields at their original location
                        // by replacing the clones with the originals:
                        if (fileInputClones && fileInputClones.length) {
                            options.fileInput.each(function (index, input) {
                                var clone = $(fileInputClones[index]);
                                $(input).prop('name', clone.prop('name'));
                                clone.replaceWith(input);
                            });
                        }
                    });
                    form.append(iframe).appendTo('body');
                },
                abort: function () {
                    if (iframe) {
                        // javascript:false as iframe src aborts the request
                        // and prevents warning popups on HTTPS in IE6.
                        // concat is used to avoid the "Script URL" JSLint error:
                        iframe
                            .unbind('load')
                            .prop('src', 'javascript'.concat(':false;'));
                    }
                    if (form) {
                        form.remove();
                    }
                }
            };
        }
    });

    // The iframe transport returns the iframe content document as response.
    // The following adds converters from iframe to text, json, html, and script:
    $.ajaxSetup({
        converters: {
            'iframe text': function (iframe) {
                return iframe.text();
            },
            'iframe json': function (iframe) {
                return $.parseJSON(iframe.text());
            },
            'iframe html': function (iframe) {
                return iframe.find('body').html();
            },
            'iframe script': function (iframe) {
                return $.globalEval(iframe.text());
            }
        }
    });

}(jQuery));


/*
 * jQuery File Upload Plugin 5.0.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://creativecommons.org/licenses/MIT/
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global document, XMLHttpRequestUpload, Blob, File, FormData, location, jQuery */

(function ($) {
    'use strict';

    // The fileupload widget listens for change events on file input fields
    // defined via fileInput setting and drop events of the given dropZone.
    // In addition to the default jQuery Widget methods, the fileupload widget
    // exposes the "add" and "send" methods, to add or directly send files
    // using the fileupload API.
    // By default, files added via file input selection, drag & drop or
    // "add" method are uploaded immediately, but it is possible to override
    // the "add" callback option to queue file uploads.
    $.widget('blueimp.fileupload', {
        
        options: {
            // The namespace used for event handler binding on the dropZone and
            // fileInput collections.
            // If not set, the name of the widget ("fileupload") is used.
            namespace: undefined,
            // The drop target collection, by the default the complete document.
            // Set to null or an empty collection to disable drag & drop support:
            dropZone: $(document),
            // The file input field collection, that is listened for change events.
            // If undefined, it is set to the file input fields inside
            // of the widget element on plugin initialization.
            // Set to null or an empty collection to disable the change listener.
            fileInput: undefined,
            // By default, the file input field is replaced with a clone after
            // each input field change event. This is required for iframe transport
            // queues and allows change events to be fired for the same file
            // selection, but can be disabled by setting the following option to false:
            replaceFileInput: true,
            // The parameter name for the file form data (the request argument name).
            // If undefined or empty, the name property of the file input field is
            // used, or "files[]" if the file input name property is also empty:
            paramName: undefined,
            // By default, each file of a selection is uploaded using an individual
            // request for XHR type uploads. Set to false to upload file
            // selections in one request each:
            singleFileUploads: true,
            // Set the following option to true to issue all file upload requests
            // in a sequential order:
            sequentialUploads: false,
            // Set the following option to true to force iframe transport uploads:
            forceIframeTransport: false,
            // By default, XHR file uploads are sent as multipart/form-data.
            // The iframe transport is always using multipart/form-data.
            // Set to false to enable non-multipart XHR uploads:
            multipart: true,
            // To upload large files in smaller chunks, set the following option
            // to a preferred maximum chunk size. If set to 0, null or undefined,
            // or the browser does not support the required Blob API, files will
            // be uploaded as a whole.
            maxChunkSize: undefined,
            // When a non-multipart upload or a chunked multipart upload has been
            // aborted, this option can be used to resume the upload by setting
            // it to the size of the already uploaded bytes. This option is most
            // useful when modifying the options object inside of the "add" or
            // "send" callbacks, as the options are cloned for each file upload.
            uploadedBytes: undefined,
            // By default, failed (abort or error) file uploads are removed from the
            // global progress calculation. Set the following option to false to
            // prevent recalculating the global progress data:
            recalculateProgress: true,
            
            // Additional form data to be sent along with the file uploads can be set
            // using this option, which accepts an array of objects with name and
            // value properties, a function returning such an array, a FormData
            // object (for XHR file uploads), or a simple object.
            // The form of the first fileInput is given as parameter to the function:
            formData: function (form) {
                return form.serializeArray();
            },
            
            // The add callback is invoked as soon as files are added to the fileupload
            // widget (via file input selection, drag & drop or add API call).
            // If the singleFileUploads option is enabled, this callback will be
            // called once for each file in the selection for XHR file uplaods, else
            // once for each file selection.
            // The upload starts when the submit method is invoked on the data parameter.
            // The data object contains a files property holding the added files
            // and allows to override plugin options as well as define ajax settings.
            // Listeners for this callback can also be bound the following way:
            // .bind('fileuploadadd', func);
            // data.submit() returns a Promise object and allows to attach additional
            // handlers using jQuery's Deferred callbacks:
            // data.submit().done(func).fail(func).always(func);
            add: function (e, data) {
                data.submit();
            },
            
            // Other callbacks:
            // Callback for the start of each file upload request:
            // send: function (e, data) {}, // .bind('fileuploadsend', func);
            // Callback for successful uploads:
            // done: function (e, data) {}, // .bind('fileuploaddone', func);
            // Callback for failed (abort or error) uploads:
            // fail: function (e, data) {}, // .bind('fileuploadfail', func);
            // Callback for completed (success, abort or error) requests:
            // always: function (e, data) {}, // .bind('fileuploadalways', func);
            // Callback for upload progress events:
            // progress: function (e, data) {}, // .bind('fileuploadprogress', func);
            // Callback for global upload progress events:
            // progressall: function (e, data) {}, // .bind('fileuploadprogressall', func);
            // Callback for uploads start, equivalent to the global ajaxStart event:
            // start: function (e) {}, // .bind('fileuploadstart', func);
            // Callback for uploads stop, equivalent to the global ajaxStop event:
            // stop: function (e) {}, // .bind('fileuploadstop', func);
            // Callback for change events of the fileInput collection:
            // change: function (e, data) {}, // .bind('fileuploadchange', func);
            // Callback for drop events of the dropZone collection:
            // drop: function (e, data) {}, // .bind('fileuploaddrop', func);
            // Callback for dragover events of the dropZone collection:
            // dragover: function (e) {}, // .bind('fileuploaddragover', func);
            
            // The plugin options are used as settings object for the ajax calls.
            // The following are jQuery ajax settings required for the file uploads:
            processData: false,
            contentType: false,
            cache: false
        },
        
        // A list of options that require a refresh after assigning a new value:
        _refreshOptionsList: ['namespace', 'dropZone', 'fileInput'],

        _isXHRUpload: function (options) {
            var undef = 'undefined';
            return !options.forceIframeTransport &&
                typeof XMLHttpRequestUpload !== undef && typeof File !== undef &&
                (!options.multipart || typeof FormData !== undef);
        },

        _getFormData: function (options) {
            var formData;
            if (typeof options.formData === 'function') {
                return options.formData(options.form);
            } else if ($.isArray(options.formData)) {
                return options.formData;
            } else if (options.formData) {
                formData = [];
                $.each(options.formData, function (name, value) {
                    formData.push({name: name, value: value});
                });
                return formData;
            }
            return [];
        },

        _getTotal: function (files) {
            var total = 0;
            $.each(files, function (index, file) {
                total += file.size || 1;
            });
            return total;
        },

        _onProgress: function (e, data) {
            if (e.lengthComputable) {
                var total = data.total || this._getTotal(data.files),
                    loaded = parseInt(
                        e.loaded / e.total * (data.chunkSize || total),
                        10
                    ) + (data.uploadedBytes || 0);
                this._loaded += loaded - (data.loaded || data.uploadedBytes || 0);
                data.lengthComputable = true;
                data.loaded = loaded;
                data.total = total;
                // Trigger a custom progress event with a total data property set
                // to the file size(s) of the current upload and a loaded data
                // property calculated accordingly:
                this._trigger('progress', e, data);
                // Trigger a global progress event for all current file uploads,
                // including ajax calls queued for sequential file uploads:
                this._trigger('progressall', e, {
                    lengthComputable: true,
                    loaded: this._loaded,
                    total: this._total
                });
            }
        },

        _initProgressListener: function (options) {
            var that = this,
                xhr = options.xhr ? options.xhr() : $.ajaxSettings.xhr();
            // Accesss to the native XHR object is required to add event listeners
            // for the upload progress event:
            if (xhr.upload && xhr.upload.addEventListener) {
                xhr.upload.addEventListener('progress', function (e) {
                    that._onProgress(e, options);
                }, false);
                options.xhr = function () {
                    return xhr;
                };
            }
        },

        _initXHRData: function (options) {
            var formData,
                file = options.files[0];
            if (!options.multipart || options.blob) {
                // For non-multipart uploads and chunked uploads,
                // file meta data is not part of the request body,
                // so we transmit this data as part of the HTTP headers.
                // For cross domain requests, these headers must be allowed
                // via Access-Control-Allow-Headers or removed using
                // the beforeSend callback:
                options.headers = $.extend(options.headers, {
                    'X-File-Name': file.name,
                    'X-File-Type': file.type,
                    'X-File-Size': file.size
                });
                if (!options.blob) {
                    // Non-chunked non-multipart upload:
                    options.contentType = file.type;
                    options.data = file;
                } else if (!options.multipart) {
                    // Chunked non-multipart upload:
                    options.contentType = 'application/octet-stream';
                    options.data = options.blob;
                }
            }
            if (options.multipart && typeof FormData !== 'undefined') {
                if (options.formData instanceof FormData) {
                    formData = options.formData;
                } else {
                    formData = new FormData();
                    $.each(this._getFormData(options), function (index, field) {
                        formData.append(field.name, field.value);
                    });
                }
                if (options.blob) {
                    formData.append(options.paramName, options.blob);
                } else {
                    $.each(options.files, function (index, file) {
                        // File objects are also Blob instances.
                        // This check allows the tests to run with
                        // dummy objects:
                        if (file instanceof Blob) {
                            formData.append(options.paramName, file);
                        }
                    });
                }
                options.data = formData;
            }
            // Blob reference is not needed anymore, free memory:
            options.blob = null;
        },
        
        _initIframeSettings: function (options) {
            // Setting the dataType to iframe enables the iframe transport:
            options.dataType = 'iframe ' + (options.dataType || '');
            // The iframe transport accepts a serialized array as form data:
            options.formData = this._getFormData(options);
        },
        
        _initDataSettings: function (options) {
            if (this._isXHRUpload(options)) {
                if (!this._chunkedUpload(options, true)) {
                    if (!options.data) {
                        this._initXHRData(options);
                    }
                    this._initProgressListener(options);
                }
            } else {
                this._initIframeSettings(options);
            }
        },
        
        _initFormSettings: function (options) {
            // Retrieve missing options from the input field and the
            // associated form, if available:
            if (!options.form || !options.form.length) {
                options.form = $(options.fileInput.prop('form'));
            }
            if (!options.paramName) {
                options.paramName = options.fileInput.prop('name') ||
                    'files[]';
            }
            if (!options.url) {
                options.url = options.form.prop('action') || location.href;
            }
            // The HTTP request method must be "POST" or "PUT":
            options.type = (options.type || options.form.prop('method') || '')
                .toUpperCase();
            if (options.type !== 'POST' && options.type !== 'PUT') {
                options.type = 'POST';
            }
        },
        
        _getAJAXSettings: function (data) {
            var options = $.extend({}, this.options, data);
            this._initFormSettings(options);
            this._initDataSettings(options);
            return options;
        },

        // Maps jqXHR callbacks to the equivalent
        // methods of the given Promise object:
        _enhancePromise: function (promise) {
            promise.success = promise.done;
            promise.error = promise.fail;
            promise.complete = promise.always;
            return promise;
        },

        // Creates and returns a Promise object enhanced with
        // the jqXHR methods abort, success, error and complete:
        _getXHRPromise: function (resolveOrReject, context, args) {
            var dfd = $.Deferred(),
                promise = dfd.promise();
            context = context || this.options.context || promise;
            if (resolveOrReject === true) {
                dfd.resolveWith(context, args);
            } else if (resolveOrReject === false) {
                dfd.rejectWith(context, args);
            }
            promise.abort = dfd.promise;
            return this._enhancePromise(promise);
        },

        // Uploads a file in multiple, sequential requests
        // by splitting the file up in multiple blob chunks.
        // If the second parameter is true, only tests if the file
        // should be uploaded in chunks, but does not invoke any
        // upload requests:
        _chunkedUpload: function (options, testOnly) {
            var that = this,
                file = options.files[0],
                fs = file.size,
                ub = options.uploadedBytes = options.uploadedBytes || 0,
                mcs = options.maxChunkSize || fs,
                // Use the Blob methods with the slice implementation
                // according to the W3C Blob API specification:
                slice = file.webkitSlice || file.mozSlice || file.slice,
                upload,
                n,
                jqXHR,
                pipe;
            if (!(this._isXHRUpload(options) && slice && (ub || mcs < fs)) ||
                    options.data) {
                return false;
            }
            if (testOnly) {
                return true;
            }
            if (ub >= fs) {
                file.error = 'uploadedBytes';
                return this._getXHRPromise(false);
            }
            // n is the number of blobs to upload,
            // calculated via filesize, uploaded bytes and max chunk size:
            n = Math.ceil((fs - ub) / mcs);
            // The chunk upload method accepting the chunk number as parameter:
            upload = function (i) {
                if (!i) {
                    return that._getXHRPromise(true);
                }
                // Upload the blobs in sequential order:
                return upload(i -= 1).pipe(function () {
                    // Clone the options object for each chunk upload:
                    var o = $.extend({}, options);
                    o.blob = slice.call(
                        file,
                        ub + i * mcs,
                        ub + (i + 1) * mcs
                    );
                    // Store the current chunk size, as the blob itself
                    // will be dereferenced after data processing:
                    o.chunkSize = o.blob.size;
                    // Process the upload data (the blob and potential form data):
                    that._initXHRData(o);
                    // Add progress listeners for this chunk upload:
                    that._initProgressListener(o);
                    jqXHR = ($.ajax(o) || that._getXHRPromise(false, o.context))
                        .done(function () {
                            // Create a progress event if upload is done and
                            // no progress event has been invoked for this chunk:
                            if (!o.loaded) {
                                that._onProgress($.Event('progress', {
                                    lengthComputable: true,
                                    loaded: o.chunkSize,
                                    total: o.chunkSize
                                }), o);
                            }
                            options.uploadedBytes = o.uploadedBytes
                                += o.chunkSize;
                        });
                    return jqXHR;
                });
            };
            // Return the piped Promise object, enhanced with an abort method,
            // which is delegated to the jqXHR object of the current upload,
            // and jqXHR callbacks mapped to the equivalent Promise methods:
            pipe = upload(n);
            pipe.abort = function () {
                return jqXHR.abort();
            };
            return this._enhancePromise(pipe);
        },

        _beforeSend: function (e, data) {
            if (this._active === 0) {
                // the start callback is triggered when an upload starts
                // and no other uploads are currently running,
                // equivalent to the global ajaxStart event:
                this._trigger('start');
            }
            this._active += 1;
            // Initialize the global progress values:
            this._loaded += data.uploadedBytes || 0;
            this._total += this._getTotal(data.files);
        },

        _onDone: function (result, textStatus, jqXHR, options) {
            if (!this._isXHRUpload(options)) {
                // Create a progress event for each iframe load:
                this._onProgress($.Event('progress', {
                    lengthComputable: true,
                    loaded: 1,
                    total: 1
                }), options);
            }
            options.result = result;
            options.textStatus = textStatus;
            options.jqXHR = jqXHR;
            this._trigger('done', null, options);
        },

        _onFail: function (jqXHR, textStatus, errorThrown, options) {
            options.jqXHR = jqXHR;
            options.textStatus = textStatus;
            options.errorThrown = errorThrown;
            this._trigger('fail', null, options);
            if (options.recalculateProgress) {
                // Remove the failed (error or abort) file upload from
                // the global progress calculation:
                this._loaded -= options.loaded || options.uploadedBytes || 0;
                this._total -= options.total || this._getTotal(options.files);
            }
        },

        _onAlways: function (result, textStatus, jqXHR, errorThrown, options) {
            this._active -= 1;
            options.result = result;
            options.textStatus = textStatus;
            options.jqXHR = jqXHR;
            options.errorThrown = errorThrown;
            this._trigger('always', null, options);
            if (this._active === 0) {
                // The stop callback is triggered when all uploads have
                // been completed, equivalent to the global ajaxStop event:
                this._trigger('stop');
                // Reset the global progress values:
                this._loaded = this._total = 0;
            }
        },

        _onSend: function (e, data) {
            var that = this,
                jqXHR,
                pipe,
                options = that._getAJAXSettings(data),
                send = function (resolve, args) {
                    jqXHR = jqXHR || (
                        (resolve !== false &&
                        that._trigger('send', e, options) !== false &&
                        (that._chunkedUpload(options) || $.ajax(options))) ||
                        that._getXHRPromise(false, options.context, args)
                    ).done(function (result, textStatus, jqXHR) {
                        that._onDone(result, textStatus, jqXHR, options);
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        that._onFail(jqXHR, textStatus, errorThrown, options);
                    }).always(function (a1, a2, a3) {
                        if (!a3 || typeof a3 === 'string') {
                            that._onAlways(undefined, a2, a1, a3, options);
                        } else {
                            that._onAlways(a1, a2, a3, undefined, options);
                        }
                    });
                    return jqXHR;
                };
            this._beforeSend(e, options);
            if (this.options.sequentialUploads) {
                // Return the piped Promise object, enhanced with an abort method,
                // which is delegated to the jqXHR object of the current upload,
                // and jqXHR callbacks mapped to the equivalent Promise methods:
                pipe = (this._sequence = this._sequence.pipe(send, send));
                pipe.abort = function () {
                    if (!jqXHR) {
                        return send(false, [undefined, 'abort', 'abort']);
                    }
                    return jqXHR.abort();
                };
                return this._enhancePromise(pipe);
            }
            return send();
        },
        
        _onAdd: function (e, data) {
            var that = this,
                result = true,
                options = $.extend({}, this.options, data);
            if (options.singleFileUploads && this._isXHRUpload(options)) {
                $.each(data.files, function (index, file) {
                    var newData = $.extend({}, data, {files: [file]});
                    newData.submit = function () {
                        return that._onSend(e, newData);
                    };
                    return (result = that._trigger('add', e, newData));
                });
                return result;
            } else if (data.files.length) {
                data = $.extend({}, data);
                data.submit = function () {
                    return that._onSend(e, data);
                };
                return this._trigger('add', e, data);
            }
        },
        
        // File Normalization for Gecko 1.9.1 (Firefox 3.5) support:
        _normalizeFile: function (index, file) {
            if (file.name === undefined && file.size === undefined) {
                file.name = file.fileName;
                file.size = file.fileSize;
            }
        },

        _replaceFileInput: function (input) {
            var inputClone = input.clone(true);
            $('<form></form>').append(inputClone)[0].reset();
            // Detaching allows to insert the fileInput on another form
            // without loosing the file input value:
            input.after(inputClone).detach();
            // Replace the original file input element in the fileInput
            // collection with the clone, which has been copied including
            // event handlers:
            this.options.fileInput = this.options.fileInput.map(function (i, el) {
                if (el === input[0]) {
                    return inputClone[0];
                }
                return el;
            });
        },
        
        _onChange: function (e) {
           var that = e.data.fileupload,
                data = {
                    files: $.each($.makeArray(e.target.files), that._normalizeFile),
                    fileInput: $(e.target),
                    form: $(e.target.form)
                };
            if (!data.files.length) {
                // If the files property is not available, the browser does not
                // support the File API and we add a pseudo File object with
                // the input value as name with path information removed:
                data.files = [{name: e.target.value.replace(/^.*\\/, '')}];
            }
            // Store the form reference as jQuery data for other event handlers,
            // as the form property is not available after replacing the file input: 
            if (data.form.length) {
                data.fileInput.data('blueimp.fileupload.form', data.form);
            } else {
                data.form = data.fileInput.data('blueimp.fileupload.form');
            }
            if (that.options.replaceFileInput) {
                that._replaceFileInput(data.fileInput);
            }
            if (that._trigger('change', e, data) === false ||
                    that._onAdd(e, data) === false) {
                return false;
            }
        },
        
        _onDrop: function (e) {
            var that = e.data.fileupload,
                dataTransfer = e.dataTransfer = e.originalEvent.dataTransfer,
                data = {
                    files: $.each(
                        $.makeArray(dataTransfer && dataTransfer.files),
                        that._normalizeFile
                    )
                };
            if (that._trigger('drop', e, data) === false ||
                    that._onAdd(e, data) === false) {
                return false;
            }
            e.preventDefault();
        },
        
        _onDragOver: function (e) {
            var that = e.data.fileupload,
                dataTransfer = e.dataTransfer = e.originalEvent.dataTransfer;
            if (that._trigger('dragover', e) === false) {
                return false;
            }
            if (dataTransfer) {
                dataTransfer.dropEffect = dataTransfer.effectAllowed = 'copy';
            }
            e.preventDefault();
        },
        
        _initEventHandlers: function () {
            var ns = this.options.namespace || this.name;
            this.options.dropZone
                .bind('dragover.' + ns, {fileupload: this}, this._onDragOver)
                .bind('drop.' + ns, {fileupload: this}, this._onDrop);
            this.options.fileInput
                .bind('change.' + ns, {fileupload: this}, this._onChange);
        },

        _destroyEventHandlers: function () {
         var ns = this.options.namespace || this.name;
            this.options.dropZone
                .unbind('dragover.' + ns, this._onDragOver)
                .unbind('drop.' + ns, this._onDrop);
            this.options.fileInput
                .unbind('change.' + ns, this._onChange);
        },
        
        _beforeSetOption: function (key, value) {
            //this._destroyEventHandlers();
        },
        
        _afterSetOption: function (key, value) {
            var options = this.options;
            if (!options.fileInput) {
                options.fileInput = $();
            }
            if (!options.dropZone) {
                options.dropZone = $();
            }
            this._initEventHandlers();
        },
        
        _setOption: function (key, value) {
            var refresh = $.inArray(key, this._refreshOptionsList) !== -1;
            if (refresh) {
                this._beforeSetOption(key, value);
            }
            $.Widget.prototype._setOption.call(this, key, value);
            if (refresh) {
                this._afterSetOption(key, value);
            }
        },

        _create: function () {
            var options = this.options;
            if (options.fileInput === undefined) {
                options.fileInput = this.element.is('input:file') ?
                    this.element : this.element.find('input:file');
            } else if (!options.fileInput) {
                options.fileInput = $();
            }
            if (!options.dropZone) {
                options.dropZone = $();
            }
            this._sequence = this._getXHRPromise(true);
            this._active = this._loaded = this._total = 0;
            this._initEventHandlers();
        },
        
        destroy: function () {
           // this._destroyEventHandlers();
            //$.Widget.prototype.destroy.call(this);
        },

        enable: function () {
            $.Widget.prototype.enable.call(this);
            this._initEventHandlers();
        },
        
        disable: function () {
           this._destroyEventHandlers();
            $.Widget.prototype.disable.call(this);
        },

        // This method is exposed to the widget API and allows adding files
        // using the fileupload API. The data parameter accepts an object which
        // must have a files property and can contain additional options:
        // .fileupload('add', {files: filesList});
        add: function (data) {
            if (!data || this.options.disabled) {
                return;
            }
            data.files = $.each($.makeArray(data.files), this._normalizeFile);
            this._onAdd(null, data);
        },
        
        // This method is exposed to the widget API and allows sending files
        // using the fileupload API. The data parameter accepts an object which
        // must have a files property and can contain additional options:
        // .fileupload('send', {files: filesList});
        // The method returns a Promise object for the file upload call.
        send: function (data) {
            if (data && !this.options.disabled) {
                data.files = $.each($.makeArray(data.files), this._normalizeFile);
                if (data.files.length) {
                    return this._onSend(null, data);
                }
            }
            return this._getXHRPromise(false, data && data.context);
        }
        
    });
    
}(jQuery));


/*
* FancyBox - jQuery Plugin
* Simple and fancy lightbox alternative
*
* Examples and documentation at: http://fancybox.net
* 
* Copyright (c) 2008 - 2010 Janis Skarnelis
* That said, it is hardly a one-person project. Many people have submitted bugs, code, and offered their advice freely. Their support is greatly appreciated.
* 
* Version: 1.3.4 (11/11/2010)
* Requires: jQuery v1.3+
*
* Dual licensed under the MIT and GPL licenses:
*   http://www.opensource.org/licenses/mit-license.php
*   http://www.gnu.org/licenses/gpl.html
*/

;(function(b){var m,t,u,f,D,j,E,n,z,A,q=0,e={},o=[],p=0,d={},l=[],G=null,v=new Image,J=/\.(jpg|gif|png|bmp|jpeg)(.*)?$/i,W=/[^\.]\.(swf)\s*$/i,K,L=1,y=0,s="",r,i,h=false,B=b.extend(b("<div/>")[0],{prop:0}),M=b.browser.msie&&b.browser.version<7&&!window.XMLHttpRequest,N=function(){t.hide();v.onerror=v.onload=null;G&&G.abort();m.empty()},O=function(){if(false===e.onError(o,q,e)){t.hide();h=false}else{e.titleShow=false;e.width="auto";e.height="auto";m.html('<p id="fancybox-error">The requested content cannot be loaded.<br />Please try again later.</p>');
F()}},I=function(){var a=o[q],c,g,k,C,P,w;N();e=b.extend({},b.fn.fancybox.defaults,typeof b(a).data("fancybox")=="undefined"?e:b(a).data("fancybox"));w=e.onStart(o,q,e);if(w===false)h=false;else{if(typeof w=="object")e=b.extend(e,w);k=e.title||(a.nodeName?b(a).attr("title"):a.title)||"";if(a.nodeName&&!e.orig)e.orig=b(a).children("img:first").length?b(a).children("img:first"):b(a);if(k===""&&e.orig&&e.titleFromAlt)k=e.orig.attr("alt");c=e.href||(a.nodeName?b(a).attr("href"):a.href)||null;if(/^(?:javascript)/i.test(c)||
c=="#")c=null;if(e.type){g=e.type;if(!c)c=e.content}else if(e.content)g="html";else if(c)g=c.match(J)?"image":c.match(W)?"swf":b(a).hasClass("iframe")?"iframe":c.indexOf("#")===0?"inline":"ajax";if(g){if(g=="inline"){a=c.substr(c.indexOf("#"));g=b(a).length>0?"inline":"ajax"}e.type=g;e.href=c;e.title=k;if(e.autoDimensions)if(e.type=="html"||e.type=="inline"||e.type=="ajax"){e.width="auto";e.height="auto"}else e.autoDimensions=false;if(e.modal){e.overlayShow=true;e.hideOnOverlayClick=false;e.hideOnContentClick=
false;e.enableEscapeButton=false;e.showCloseButton=false}e.padding=parseInt(e.padding,10);e.margin=parseInt(e.margin,10);m.css("padding",e.padding+e.margin);b(".fancybox-inline-tmp").unbind("fancybox-cancel").bind("fancybox-change",function(){b(this).replaceWith(j.children())});switch(g){case "html":m.html(e.content);F();break;case "inline":if(b(a).parent().is("#fancybox-content")===true){h=false;break}b('<div class="fancybox-inline-tmp" />').hide().insertBefore(b(a)).bind("fancybox-cleanup",function(){b(this).replaceWith(j.children())}).bind("fancybox-cancel",
function(){b(this).replaceWith(m.children())});b(a).appendTo(m);F();break;case "image":h=false;b.fancybox.showActivity();v=new Image;v.onerror=function(){O()};v.onload=function(){h=true;v.onerror=v.onload=null;e.width=v.width;e.height=v.height;b("<img />").attr({id:"fancybox-img",src:v.src,alt:e.title}).appendTo(m);Q()};v.src=c;break;case "swf":e.scrolling="no";C='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'+e.width+'" height="'+e.height+'"><param name="movie" value="'+c+
'"></param>';P="";b.each(e.swf,function(x,H){C+='<param name="'+x+'" value="'+H+'"></param>';P+=" "+x+'="'+H+'"'});C+='<embed src="'+c+'" type="application/x-shockwave-flash" width="'+e.width+'" height="'+e.height+'"'+P+"></embed></object>";m.html(C);F();break;case "ajax":h=false;b.fancybox.showActivity();e.ajax.win=e.ajax.success;G=b.ajax(b.extend({},e.ajax,{url:c,data:e.ajax.data||{},error:function(x){x.status>0&&O()},success:function(x,H,R){if((typeof R=="object"?R:G).status==200){if(typeof e.ajax.win==
"function"){w=e.ajax.win(c,x,H,R);if(w===false){t.hide();return}else if(typeof w=="string"||typeof w=="object")x=w}m.html(x);F()}}}));break;case "iframe":Q()}}else O()}},F=function(){var a=e.width,c=e.height;a=a.toString().indexOf("%")>-1?parseInt((b(window).width()-e.margin*2)*parseFloat(a)/100,10)+"px":a=="auto"?"auto":a+"px";c=c.toString().indexOf("%")>-1?parseInt((b(window).height()-e.margin*2)*parseFloat(c)/100,10)+"px":c=="auto"?"auto":c+"px";m.wrapInner('<div style="width:'+a+";height:"+c+
";overflow: "+(e.scrolling=="auto"?"auto":e.scrolling=="yes"?"scroll":"hidden")+';position:relative;"></div>');e.width=m.width();e.height=m.height();Q()},Q=function(){var a,c;t.hide();if(f.is(":visible")&&false===d.onCleanup(l,p,d)){b.event.trigger("fancybox-cancel");h=false}else{h=true;b(j.add(u)).unbind();b(window).unbind("resize.fb scroll.fb");b(document).unbind("keydown.fb");f.is(":visible")&&d.titlePosition!=="outside"&&f.css("height",f.height());l=o;p=q;d=e;if(d.overlayShow){u.css({"background-color":d.overlayColor,
opacity:d.overlayOpacity,cursor:d.hideOnOverlayClick?"pointer":"auto",height:b(document).height()});if(!u.is(":visible")){M&&b("select:not(#fancybox-tmp select)").filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one("fancybox-cleanup",function(){this.style.visibility="inherit"});u.show()}}else u.hide();i=X();s=d.title||"";y=0;n.empty().removeAttr("style").removeClass();if(d.titleShow!==false){if(b.isFunction(d.titleFormat))a=d.titleFormat(s,l,p,d);else a=s&&s.length?
d.titlePosition=="float"?'<table id="fancybox-title-float-wrap" cellpadding="0" cellspacing="0"><tr><td id="fancybox-title-float-left"></td><td id="fancybox-title-float-main">'+s+'</td><td id="fancybox-title-float-right"></td></tr></table>':'<div id="fancybox-title-'+d.titlePosition+'">'+s+"</div>":false;s=a;if(!(!s||s==="")){n.addClass("fancybox-title-"+d.titlePosition).html(s).appendTo("body").show();switch(d.titlePosition){case "inside":n.css({width:i.width-d.padding*2,marginLeft:d.padding,marginRight:d.padding});
y=n.outerHeight(true);n.appendTo(D);i.height+=y;break;case "over":n.css({marginLeft:d.padding,width:i.width-d.padding*2,bottom:d.padding}).appendTo(D);break;case "float":n.css("left",parseInt((n.width()-i.width-40)/2,10)*-1).appendTo(f);break;default:n.css({width:i.width-d.padding*2,paddingLeft:d.padding,paddingRight:d.padding}).appendTo(f)}}}n.hide();if(f.is(":visible")){b(E.add(z).add(A)).hide();a=f.position();r={top:a.top,left:a.left,width:f.width(),height:f.height()};c=r.width==i.width&&r.height==
i.height;j.fadeTo(d.changeFade,0.3,function(){var g=function(){j.html(m.contents()).fadeTo(d.changeFade,1,S)};b.event.trigger("fancybox-change");j.empty().removeAttr("filter").css({"border-width":d.padding,width:i.width-d.padding*2,height:e.autoDimensions?"auto":i.height-y-d.padding*2});if(c)g();else{B.prop=0;b(B).animate({prop:1},{duration:d.changeSpeed,easing:d.easingChange,step:T,complete:g})}})}else{f.removeAttr("style");j.css("border-width",d.padding);if(d.transitionIn=="elastic"){r=V();j.html(m.contents());
f.show();if(d.opacity)i.opacity=0;B.prop=0;b(B).animate({prop:1},{duration:d.speedIn,easing:d.easingIn,step:T,complete:S})}else{d.titlePosition=="inside"&&y>0&&n.show();j.css({width:i.width-d.padding*2,height:e.autoDimensions?"auto":i.height-y-d.padding*2}).html(m.contents());f.css(i).fadeIn(d.transitionIn=="none"?0:d.speedIn,S)}}}},Y=function(){if(d.enableEscapeButton||d.enableKeyboardNav)b(document).bind("keydown.fb",function(a){if(a.keyCode==27&&d.enableEscapeButton){a.preventDefault();b.fancybox.close()}else if((a.keyCode==
37||a.keyCode==39)&&d.enableKeyboardNav&&a.target.tagName!=="INPUT"&&a.target.tagName!=="TEXTAREA"&&a.target.tagName!=="SELECT"){a.preventDefault();b.fancybox[a.keyCode==37?"prev":"next"]()}});if(d.showNavArrows){if(d.cyclic&&l.length>1||p!==0)z.show();if(d.cyclic&&l.length>1||p!=l.length-1)A.show()}else{z.hide();A.hide()}},S=function(){if(!b.support.opacity){j.get(0).style.removeAttribute("filter");f.get(0).style.removeAttribute("filter")}e.autoDimensions&&j.css("height","auto");f.css("height","auto");
s&&s.length&&n.show();d.showCloseButton&&E.show();Y();d.hideOnContentClick&&j.bind("click",b.fancybox.close);d.hideOnOverlayClick&&u.bind("click",b.fancybox.close);b(window).bind("resize.fb",b.fancybox.resize);d.centerOnScroll&&b(window).bind("scroll.fb",b.fancybox.center);if(d.type=="iframe")b('<iframe id="fancybox-frame" name="fancybox-frame'+(new Date).getTime()+'" frameborder="0" hspace="0" '+(b.browser.msie?'allowtransparency="true""':"")+' scrolling="'+e.scrolling+'" src="'+d.href+'"></iframe>').appendTo(j);
f.show();h=false;b.fancybox.center();d.onComplete(l,p,d);var a,c;if(l.length-1>p){a=l[p+1].href;if(typeof a!=="undefined"&&a.match(J)){c=new Image;c.src=a}}if(p>0){a=l[p-1].href;if(typeof a!=="undefined"&&a.match(J)){c=new Image;c.src=a}}},T=function(a){var c={width:parseInt(r.width+(i.width-r.width)*a,10),height:parseInt(r.height+(i.height-r.height)*a,10),top:parseInt(r.top+(i.top-r.top)*a,10),left:parseInt(r.left+(i.left-r.left)*a,10)};if(typeof i.opacity!=="undefined")c.opacity=a<0.5?0.5:a;f.css(c);
j.css({width:c.width-d.padding*2,height:c.height-y*a-d.padding*2})},U=function(){return[b(window).width()-d.margin*2,b(window).height()-d.margin*2,b(document).scrollLeft()+d.margin,b(document).scrollTop()+d.margin]},X=function(){var a=U(),c={},g=d.autoScale,k=d.padding*2;c.width=d.width.toString().indexOf("%")>-1?parseInt(a[0]*parseFloat(d.width)/100,10):d.width+k;c.height=d.height.toString().indexOf("%")>-1?parseInt(a[1]*parseFloat(d.height)/100,10):d.height+k;if(g&&(c.width>a[0]||c.height>a[1]))if(e.type==
"image"||e.type=="swf"){g=d.width/d.height;if(c.width>a[0]){c.width=a[0];c.height=parseInt((c.width-k)/g+k,10)}if(c.height>a[1]){c.height=a[1];c.width=parseInt((c.height-k)*g+k,10)}}else{c.width=Math.min(c.width,a[0]);c.height=Math.min(c.height,a[1])}c.top=parseInt(Math.max(a[3]-20,a[3]+(a[1]-c.height-40)*0.5),10);c.left=parseInt(Math.max(a[2]-20,a[2]+(a[0]-c.width-40)*0.5),10);return c},V=function(){var a=e.orig?b(e.orig):false,c={};if(a&&a.length){c=a.offset();c.top+=parseInt(a.css("paddingTop"),
10)||0;c.left+=parseInt(a.css("paddingLeft"),10)||0;c.top+=parseInt(a.css("border-top-width"),10)||0;c.left+=parseInt(a.css("border-left-width"),10)||0;c.width=a.width();c.height=a.height();c={width:c.width+d.padding*2,height:c.height+d.padding*2,top:c.top-d.padding-20,left:c.left-d.padding-20}}else{a=U();c={width:d.padding*2,height:d.padding*2,top:parseInt(a[3]+a[1]*0.5,10),left:parseInt(a[2]+a[0]*0.5,10)}}return c},Z=function(){if(t.is(":visible")){b("div",t).css("top",L*-40+"px");L=(L+1)%12}else clearInterval(K)};
b.fn.fancybox=function(a){if(!b(this).length)return this;b(this).data("fancybox",b.extend({},a,b.metadata?b(this).metadata():{})).unbind("click.fb").bind("click.fb",function(c){c.preventDefault();if(!h){h=true;b(this).blur();o=[];q=0;c=b(this).attr("rel")||"";if(!c||c==""||c==="nofollow")o.push(this);else{o=b("a[rel="+c+"], area[rel="+c+"]");q=o.index(this)}I()}});return this};b.fancybox=function(a,c){var g;if(!h){h=true;g=typeof c!=="undefined"?c:{};o=[];q=parseInt(g.index,10)||0;if(b.isArray(a)){for(var k=
0,C=a.length;k<C;k++)if(typeof a[k]=="object")b(a[k]).data("fancybox",b.extend({},g,a[k]));else a[k]=b({}).data("fancybox",b.extend({content:a[k]},g));o=jQuery.merge(o,a)}else{if(typeof a=="object")b(a).data("fancybox",b.extend({},g,a));else a=b({}).data("fancybox",b.extend({content:a},g));o.push(a)}if(q>o.length||q<0)q=0;I()}};b.fancybox.showActivity=function(){clearInterval(K);t.show();K=setInterval(Z,66)};b.fancybox.hideActivity=function(){t.hide()};b.fancybox.next=function(){return b.fancybox.pos(p+
1)};b.fancybox.prev=function(){return b.fancybox.pos(p-1)};b.fancybox.pos=function(a){if(!h){a=parseInt(a);o=l;if(a>-1&&a<l.length){q=a;I()}else if(d.cyclic&&l.length>1){q=a>=l.length?0:l.length-1;I()}}};b.fancybox.cancel=function(){if(!h){h=true;b.event.trigger("fancybox-cancel");N();e.onCancel(o,q,e);h=false}};b.fancybox.close=function(){function a(){u.fadeOut("fast");n.empty().hide();f.hide();b.event.trigger("fancybox-cleanup");j.empty();d.onClosed(l,p,d);l=e=[];p=q=0;d=e={};h=false}if(!(h||f.is(":hidden"))){h=
true;if(d&&false===d.onCleanup(l,p,d))h=false;else{N();b(E.add(z).add(A)).hide();b(j.add(u)).unbind();b(window).unbind("resize.fb scroll.fb");b(document).unbind("keydown.fb");j.find("iframe").attr("src",M&&/^https/i.test(window.location.href||"")?"javascript:void(false)":"about:blank");d.titlePosition!=="inside"&&n.empty();f.stop();if(d.transitionOut=="elastic"){r=V();var c=f.position();i={top:c.top,left:c.left,width:f.width(),height:f.height()};if(d.opacity)i.opacity=1;n.empty().hide();B.prop=1;
b(B).animate({prop:0},{duration:d.speedOut,easing:d.easingOut,step:T,complete:a})}else f.fadeOut(d.transitionOut=="none"?0:d.speedOut,a)}}};b.fancybox.resize=function(){u.is(":visible")&&u.css("height",b(document).height());b.fancybox.center(true)};b.fancybox.center=function(a){var c,g;if(!h){g=a===true?1:0;c=U();!g&&(f.width()>c[0]||f.height()>c[1])||f.stop().animate({top:parseInt(Math.max(c[3]-20,c[3]+(c[1]-j.height()-40)*0.5-d.padding)),left:parseInt(Math.max(c[2]-20,c[2]+(c[0]-j.width()-40)*0.5-
d.padding))},typeof a=="number"?a:200)}};b.fancybox.init=function(){if(!b("#fancybox-wrap").length){b("body").append(m=b('<div id="fancybox-tmp"></div>'),t=b('<div id="fancybox-loading"><div></div></div>'),u=b('<div id="fancybox-overlay"></div>'),f=b('<div id="fancybox-wrap"></div>'));D=b('<div id="fancybox-outer"></div>').append('<div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div>').appendTo(f);
D.append(j=b('<div id="fancybox-content"></div>'),E=b('<a id="fancybox-close"></a>'),n=b('<div id="fancybox-title"></div>'),z=b('<a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a>'),A=b('<a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a>'));E.click(b.fancybox.close);t.click(b.fancybox.cancel);z.click(function(a){a.preventDefault();b.fancybox.prev()});A.click(function(a){a.preventDefault();b.fancybox.next()});
b.fn.mousewheel&&f.bind("mousewheel.fb",function(a,c){if(h)a.preventDefault();else if(b(a.target).get(0).clientHeight==0||b(a.target).get(0).scrollHeight===b(a.target).get(0).clientHeight){a.preventDefault();b.fancybox[c>0?"prev":"next"]()}});b.support.opacity||f.addClass("fancybox-ie");if(M){t.addClass("fancybox-ie6");f.addClass("fancybox-ie6");b('<iframe id="fancybox-hide-sel-frame" src="'+(/^https/i.test(window.location.href||"")?"javascript:void(false)":"about:blank")+'" scrolling="no" border="0" frameborder="0" tabindex="-1"></iframe>').prependTo(D)}}};
b.fn.fancybox.defaults={padding:10,margin:40,opacity:false,modal:false,cyclic:false,scrolling:"auto",width:560,height:340,autoScale:true,autoDimensions:true,centerOnScroll:false,ajax:{},swf:{wmode:"transparent"},hideOnOverlayClick:true,hideOnContentClick:false,overlayShow:true,overlayOpacity:0.7,overlayColor:"#777",titleShow:true,titlePosition:"float",titleFormat:null,titleFromAlt:false,transitionIn:"fade",transitionOut:"fade",speedIn:300,speedOut:300,changeSpeed:300,changeFade:"fast",easingIn:"swing",
easingOut:"swing",showCloseButton:true,showNavArrows:true,enableEscapeButton:true,enableKeyboardNav:true,onStart:function(){},onCancel:function(){},onComplete:function(){},onCleanup:function(){},onClosed:function(){},onError:function(){}};b(document).ready(function(){b.fancybox.init()})})(jQuery);	



/*
 * ----------------------------- JSTORAGE -------------------------------------
 * Simple local storage wrapper to save data on the browser side, supporting
 * all major browsers - IE6+, Firefox2+, Safari4+, Chrome4+ and Opera 10.5+
 *
 * Copyright (c) 2010 Andris Reinman, andris.reinman@gmail.com
 * Project homepage: www.jstorage.info
 *
 * Licensed under MIT-style license:
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/**
 * $.jStorage
 * 
 * USAGE:
 *
 * jStorage requires Prototype, MooTools or jQuery! If jQuery is used, then
 * jQuery-JSON (http://code.google.com/p/jquery-json/) is also needed.
 * (jQuery-JSON needs to be loaded BEFORE jStorage!)
 *
 * Methods:
 *
 * -set(key, value)
 * $.jStorage.set(key, value) -> saves a value
 *
 * -get(key[, default])
 * value = $.jStorage.get(key [, default]) ->
 *    retrieves value if key exists, or default if it doesn't
 *
 * -deleteKey(key)
 * $.jStorage.deleteKey(key) -> removes a key from the storage
 *
 * -flush()
 * $.jStorage.flush() -> clears the cache
 * 
 * -storageObj()
 * $.jStorage.storageObj() -> returns a read-ony copy of the actual storage
 * 
 * -storageSize()
 * $.jStorage.storageSize() -> returns the size of the storage in bytes
 *
 * -index()
 * $.jStorage.index() -> returns the used keys as an array
 * 
 * -storageAvailable()
 * $.jStorage.storageAvailable() -> returns true if storage is available
 * 
 * -reInit()
 * $.jStorage.reInit() -> reloads the data from browser storage
 * 
 * <value> can be any JSON-able value, including objects and arrays.
 *
 **/
 

(function($){
    if(!$ || !($.toJSON || Object.toJSON || window.JSON) && !$.browser.msie){
        throw new Error("jQuery, MooTools or Prototype needs to be loaded before jStorage!");
    }
    
    var
        /* This is the object, that holds the cached values */ 
        _storage = {},

        /* Actual browser storage (localStorage or globalStorage['domain']) */
        _storage_service = {jStorage:"{}"},

        /* DOM element for older IE versions, holds userData behavior */
        _storage_elm = null,
        
        /* How much space does the storage take */
        _storage_size = 0,

        /* function to encode objects to JSON strings */
        json_encode = $.toJSON || Object.toJSON || (window.JSON && (JSON.encode || JSON.stringify)),

        /* function to decode objects from JSON strings */
        json_decode = $.evalJSON || (window.JSON && (JSON.decode || JSON.parse)) || function(str){
            return String(str).evalJSON();
        },
        
        /* which backend is currently used */
        _backend = false;
        
        /**
         * XML encoding and decoding as XML nodes can't be JSON'ized
         * XML nodes are encoded and decoded if the node is the value to be saved
         * but not if it's as a property of another object
         * Eg. -
         *   $.jStorage.set("key", xmlNode);        // IS OK
         *   $.jStorage.set("key", {xml: xmlNode}); // NOT OK
         */
        _XMLService = {
            
            /**
             * Validates a XML node to be XML
             * based on jQuery.isXML function
             */
            isXML: function(elm){
                var documentElement = (elm ? elm.ownerDocument || elm : 0).documentElement;
                return documentElement ? documentElement.nodeName !== "HTML" : false;
            },
            
            /**
             * Encodes a XML node to string
             * based on http://www.mercurytide.co.uk/news/article/issues-when-working-ajax/
             */
            encode: function(xmlNode) {
                if(!this.isXML(xmlNode)){
                    return false;
                }
                try{ // Mozilla, Webkit, Opera
                    return new XMLSerializer().serializeToString(xmlNode);
                }catch(E1) {
                    try {  // IE
                        return xmlNode.xml;
                    }catch(E2){}
                }
                return false;
            },
            
            /**
             * Decodes a XML node from string
             * loosely based on http://outwestmedia.com/jquery-plugins/xmldom/
             */
            decode: function(xmlString){
                var dom_parser = ("DOMParser" in window && (new DOMParser()).parseFromString) ||
                        (window.ActiveXObject && function(_xmlString) {
                    var xml_doc = new ActiveXObject('Microsoft.XMLDOM');
                    xml_doc.async = 'false';
                    xml_doc.loadXML(_xmlString);
                    return xml_doc;
                }),
                resultXML;
                if(!dom_parser){
                    return false;
                }
                resultXML = dom_parser.call("DOMParser" in window && (new DOMParser()) || window, xmlString, 'text/xml');
                return this.isXML(resultXML)?resultXML:false;
            }
        };

    ////////////////////////// PRIVATE METHODS ////////////////////////

    /**
     * Initialization function. Detects if the browser supports DOM Storage
     * or userData behavior and behaves accordingly.
     * @returns undefined
     */
    function _init(){
        /* Check if browser supports localStorage */
        if("localStorage" in window){
            try {
                if(window.localStorage) {
                    _storage_service = window.localStorage;
                    _backend = "localStorage";
                }
            } catch(E3) {/* Firefox fails when touching localStorage and cookies are disabled */}
        }
        /* Check if browser supports globalStorage */
        else if("globalStorage" in window){
            try {
                if(window.globalStorage) {
                    _storage_service = window.globalStorage[window.location.hostname];
                    _backend = "globalStorage";
                }
            } catch(E4) {/* Firefox fails when touching localStorage and cookies are disabled */}
        }
        /* Check if browser supports userData behavior */
        else {
            _storage_elm = document.createElement('link');
            if(_storage_elm.addBehavior){

                /* Use a DOM element to act as userData storage */
                _storage_elm.style.behavior = 'url(#default#userData)';

                /* userData element needs to be inserted into the DOM! */
                document.getElementsByTagName('head')[0].appendChild(_storage_elm);

                _storage_elm.load("jStorage");
                var data = "{}";
                try{
                    data = _storage_elm.getAttribute("jStorage");
                }catch(E5){}
                _storage_service.jStorage = data;
                _backend = "userDataBehavior";
            }else{
                _storage_elm = null;
                return;
            }
        }

        _load_storage();
    }
    
    /**
     * Loads the data from the storage based on the supported mechanism
     * @returns undefined
     */
    function _load_storage(){
        /* if jStorage string is retrieved, then decode it */
        if(_storage_service.jStorage){
            try{
                _storage = json_decode(String(_storage_service.jStorage));
            }catch(E6){_storage_service.jStorage = "{}";}
        }else{
            _storage_service.jStorage = "{}";
        }
        _storage_size = _storage_service.jStorage?String(_storage_service.jStorage).length:0;    
    }

    /**
     * This functions provides the "save" mechanism to store the jStorage object
     * @returns undefined
     */
    function _save(){
        try{
            _storage_service.jStorage = json_encode(_storage);
            // If userData is used as the storage engine, additional
            if(_storage_elm) {
                _storage_elm.setAttribute("jStorage",_storage_service.jStorage);
                _storage_elm.save("jStorage");
            }
            _storage_size = _storage_service.jStorage?String(_storage_service.jStorage).length:0;
        }catch(E7){/* probably cache is full, nothing is saved this way*/}
    }

    /**
     * Function checks if a key is set and is string or numberic
     */
    function _checkKey(key){
        if(!key || (typeof key != "string" && typeof key != "number")){
            throw new TypeError('Key name must be string or numeric');
        }
        return true;
    }

    ////////////////////////// PUBLIC INTERFACE /////////////////////////

    $.jStorage = {
        /* Version number */
        version: "0.1.5.2",

        /**
         * Sets a key's value.
         * 
         * @param {String} key - Key to set. If this value is not set or not
         *              a string an exception is raised.
         * @param value - Value to set. This can be any value that is JSON
         *              compatible (Numbers, Strings, Objects etc.).
         * @returns the used value
         */
        set: function(key, value){
            _checkKey(key);
            if(_XMLService.isXML(value)){
                value = {_is_xml:true,xml:_XMLService.encode(value)};
            }
            _storage[key] = value;
            _save();
            return value;
        },
        
        /**
         * Looks up a key in cache
         * 
         * @param {String} key - Key to look up.
         * @param {mixed} def - Default value to return, if key didn't exist.
         * @returns the key value, default value or <null>
         */
        get: function(key, def){
            _checkKey(key);
            if(key in _storage){
                if(_storage[key] && typeof _storage[key] == "object" &&
                        _storage[key]._is_xml &&
                            _storage[key]._is_xml){
                    return _XMLService.decode(_storage[key].xml);
                }else{
                    return _storage[key];
                }
            }
            return typeof(def) == 'undefined' ? null : def;
        },
        
        /**
         * Deletes a key from cache.
         * 
         * @param {String} key - Key to delete.
         * @returns true if key existed or false if it didn't
         */
        deleteKey: function(key){
            _checkKey(key);
            if(key in _storage){
                delete _storage[key];
                _save();
                return true;
            }
            return false;
        },

        /**
         * Deletes everything in cache.
         * 
         * @returns true
         */
        flush: function(){
            _storage = {};
            _save();
            return true;
        },
        
        /**
         * Returns a read-only copy of _storage
         * 
         * @returns Object
        */
        storageObj: function(){
            function F() {}
            F.prototype = _storage;
            return new F();
        },
        
        /**
         * Returns an index of all used keys as an array
         * ['key1', 'key2',..'keyN']
         * 
         * @returns Array
        */
        index: function(){
            var index = [], i;
            for(i in _storage){
                if(_storage.hasOwnProperty(i)){
                    index.push(i);
                }
            }
            return index;
        },
        
        /**
         * How much space in bytes does the storage take?
         * 
         * @returns Number
         */
        storageSize: function(){
            return _storage_size;
        },
        
        /**
         * Which backend is currently in use?
         * 
         * @returns String
         */
        currentBackend: function(){
            return _backend;
        },
        
        /**
         * Test if storage is available
         * 
         * @returns Boolean
         */
        storageAvailable: function(){
            return !!_backend;
        },
        
        /**
         * Reloads the data from browser storage
         * 
         * @returns undefined
         */
        reInit: function(){
            var new_storage_elm, data;
            if(_storage_elm && _storage_elm.addBehavior){
                new_storage_elm = document.createElement('link');
                
                _storage_elm.parentNode.replaceChild(new_storage_elm, _storage_elm);
                _storage_elm = new_storage_elm;
                
                /* Use a DOM element to act as userData storage */
                _storage_elm.style.behavior = 'url(#default#userData)';

                /* userData element needs to be inserted into the DOM! */
                document.getElementsByTagName('head')[0].appendChild(_storage_elm);

                _storage_elm.load("jStorage");
                data = "{}";
                try{
                    data = _storage_elm.getAttribute("jStorage");
                }catch(E5){}
                _storage_service.jStorage = data;
                _backend = "userDataBehavior";
            }
            
            _load_storage();
        }
    };

    // Initialize jStorage
    _init();

})(window.jQuery || window.$);

/**
 * jQuery custom checkboxes
 * 
 * Copyright (c) 2008 Khavilo Dmitry (http://widowmaker.kiev.ua/checkbox/)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * @version 1.3.0 Beta 1
 * @author Khavilo Dmitry
 * @mailto wm.morgun@gmail.com
 * modified for White Label by Xaver Birsak revaxarts.com
**/

(function($){
	/* Little trick to remove event bubbling that causes events recursion */
	var CB = function(e)
	{
		if (!e) var e = window.event;
		e.cancelBubble = true;
		if (e.stopPropagation) e.stopPropagation();
	};
	
	$.fn.checkbox = function(options) {
		
		/* Default settings */
		var settings = {
			cls: 'jquery-checkbox'  /* checkbox  */
		};
		
		/* Processing settings */
		settings = $.extend(settings, options || {});
		
		/* Adds check/uncheck & disable/enable events */
		var addEvents = function(object)
		{
			var checked = object.checked;
			var disabled = object.disabled;
			var $object = $(object);
			
			if ( object.stateInterval )
				clearInterval(object.stateInterval);
			
			object.stateInterval = setInterval(
				function() 
				{
					if ( object.disabled != disabled )
						$object.trigger( (disabled = !!object.disabled) ? 'disable' : 'enable');
					if ( object.checked != checked )
						$object.trigger( (checked = !!object.checked) ? 'check' : 'uncheck');
				}, 
				10 /* in miliseconds. Low numbers this can decrease performance on slow computers, high will increase responce time */
			);
			return $object;
		};
		
		/* Wrapping all passed elements */
		return this.each(function() 
		{
			var ch = this; /* Reference to DOM Element*/
			var $ch = addEvents(ch),/* Adds custom events and returns, jQuery enclosed object */
				elClass = ($(ch).is(':radio')) ? 'radio' : 'checkbox'; 
			
			/* Removing wrapper if already applied  */
			if (ch.wrapper) ch.wrapper.remove();
			
			/* Creating wrapper for checkbox and assigning "hover" event */
			ch.wrapper = $('<span class="' + settings.cls + ' ' + elClass + '"><span><span class="checkboxplaceholder"></span></span></span>');
			ch.wrapperInner = ch.wrapper.children('span:eq(0)');
			ch.wrapper.bind({
				"click" : function(e) { $ch.trigger('click'); return false; },
				"mouseover" : function(e) { ch.wrapperInner.addClass('hover'); },
				"mouseout" : function(e) { ch.wrapperInner.removeClass('hover'); },
				"mousedown" : function(e) { ch.wrapperInner.addClass('pressed'); },
				"mouseup" : function(e) { ch.wrapperInner.removeClass('pressed'); }
			});
			
			/* Wrapping checkbox */
			$ch.css({position: 'absolute', zIndex: -1, visibility: 'hidden'}).after(ch.wrapper);
			
			/* Ttying to find "our" label */
			var label = false;
/*			if ($ch.attr('id')) {
				label = $('label[for='+$ch.attr('id')+']');
				if (!label.length) label = false;
			}
*/			if (!label) {
				label = $ch.closest('label');
				if (!label.length) label = false;
			}
			/* Label found, applying event hanlers */
			if (label) {
				label.bind({
					"click" : function(e) { $ch.trigger('click'); return false; },
					"mouseover" : function(e) { ch.wrapper.trigger('mouseover'); },
					"mouseout" : function(e) { ch.wrapper.trigger('mouseout'); },
					"mousedown" : function(e) { ch.wrapper.addClass('pressed'); },
					"mouseup" : function(e) { ch.wrapper.removeClass('pressed'); }
				});
			}
			
			$ch.bind('disable', function() { ch.wrapperInner.addClass('disabled');}).bind('enable', function() { ch.wrapperInner.removeClass( 'disabled' );});
			$ch.bind('check', function() { ch.wrapper.addClass('checked' );}).bind('uncheck', function() { ch.wrapper.removeClass( 'checked' );});
			
			/* Firefox antiselection hack */
			if ( window.getSelection )
				ch.wrapper.css('MozUserSelect', 'none');
			
			/* Applying checkbox state */
			if ( ch.checked )
				ch.wrapper.addClass('checked');
			if ( ch.disabled )
				ch.wrapperInner.addClass('disabled');			
		});
	}
})(jQuery);

/*----------------------------------------------------------------------*/
/* wl_Alert v 1.1 by revaxarts.com
/* description: Handles alert boxes
/* dependency: jquery UI Slider, fadeOutSlide plugin
/*----------------------------------------------------------------------*/


$.fn.wl_Alert = function (method) {
	var args = arguments;
	return this.each(function () {

		var $this = $(this);


		if ($.fn.wl_Alert.methods[method]) {
			return $.fn.wl_Alert.methods[method].apply(this, Array.prototype.slice.call(args, 1));
		} else if (typeof method === 'object' || !method) {
			if ($this.data('wl_Alert')) {
				var opts = $.extend({}, $this.data('wl_Alert'), method);
			} else {

				var opts = $.extend({}, $.fn.wl_Alert.defaults, method, $this.data());
			}
		} else {
			$.error('Method "' + method + '" does not exist');
		}


		if (!$this.data('wl_Alert')) {

			$this.data('wl_Alert', {});

			//bind click events to hide alert box
			$this.bind('click.wl_Alert', function (event) {
				event.preventDefault();

				//Don't hide if it is sticky
				if (!$this.data('wl_Alert').sticky) {
					$.fn.wl_Alert.methods.close.call($this[0]);
				}

				//prevent hiding the box if an inline link is clicked
			}).find('a').bind('click.wl_Alert', function (event) {
				event.stopPropagation();
			});
		} else {

		}
		//show it if it is hidden
		if ($this.is(':hidden')) {
			$this.slideDown(opts.speed / 2);
		}

		if (opts) $.extend($this.data('wl_Alert'), opts);
	});

};

$.fn.wl_Alert.defaults = {
	speed: 500,
	sticky: false,
	onBeforeClose: function (element) {},
	onClose: function (element) {}
};
$.fn.wl_Alert.version = '1.1';


$.fn.wl_Alert.methods = {
	close: function () {
		var $this = $(this),
			opts = $this.data('wl_Alert');
		//call callback and stop if it returns false
		if (opts.onBeforeClose.call(this, $this) === false) {
			return false;
		};
		//fadeout and call an callback
		$this.fadeOutSlide(opts.speed, function () {
			opts.onClose.call($this[0], $this);
		});
	},
	set: function () {
		var $this = $(this),
			options = {};
		if (typeof arguments[0] === 'object') {
			options = arguments[0];
		} else if (arguments[0] && arguments[1] !== undefined) {
			options[arguments[0]] = arguments[1];
		}
		$.each(options, function (key, value) {
			if ($.fn.wl_Alert.defaults[key] !== undefined || $.fn.wl_Alert.defaults[key] == null) {
				$this.data('wl_Alert')[key] = value;
			} else {
				$.error('Key "' + key + '" is not defined');
			}
		});

	}
};

//to create an alert box on the fly
$.wl_Alert = function (text, cssclass, insert, after, options) {
	//go thru all
	$('div.alert').each(function () {
		var _this = $(this);
		//...and hide if one with the same text is allready set
		if (_this.text() == text) {
			_this.slideUp($.fn.wl_Alert.defaults.speed);
		}
	});

	//create a new DOM element and inject it
	var al = $('<div class="alert ' + cssclass + '">' + text + '</div>').hide();
	(after) ? al.appendTo(insert).wl_Alert(options) : al.prependTo(insert).wl_Alert(options);
	
	//return the element
	return al;
};
/*----------------------------------------------------------------------*/
/* wl_Dialog v 1.1 by revaxarts.com
/* description: handles alert boxes, prompt boxes and confirm boxes and
/*				message boxes
/*				contains 4 plugins
/* dependency: jquery UI Dialog
/*----------------------------------------------------------------------*/


/*----------------------------------------------------------------------*/
/* Confirm Dialog
/* like the native confirm method
/*----------------------------------------------------------------------*/
$.confirm = function (text, callback, cancelcallback) {

	var options = $.extend(true, {}, $.alert.defaults, $.confirm.defaults);

	//nativ behaviour
	if (options.nativ) {
		if (result = confirm(unescape(text))) {
			if ($.isFunction(callback)) callback.call(this);
		} else {
			if ($.isFunction(cancelcallback)) cancelcallback.call(this);
		}
		return;
	}

	//the callbackfunction
	var cb = function () {
			if ($.isFunction(callback)) callback.call(this);
			$(this).dialog('close');
			$('#wl_dialog').remove();
		},

		//the callbackfunction on cancel
		ccb = function () {
			if ($.isFunction(cancelcallback)) cancelcallback.call(this);
			$(this).dialog('close');
			$('#wl_dialog').remove();
		};

	//set some options
	options = $.extend({}, {
		buttons: [{
			text: options.text.ok,
			click: cb
		}, {
			text: options.text.cancel,
			click: ccb
		}]
	}, options);

	//use the dialog
	return $.alert(unescape(text), options);
};

$.confirm.defaults = {
	text: {
		header: 'Please confirm',
		ok: 'Yes',
		cancel: 'No'
	}
};

/*----------------------------------------------------------------------*/
/* Prompt Dialog
/* like the native prompt method
/*----------------------------------------------------------------------*/

$.prompt = function (text, value, callback, cancelcallback) {

	var options = $.extend(true, {}, $.alert.defaults, $.prompt.defaults);

	//nativ behaviour
	if (options.nativ) {
		var val = prompt(unescape($.trim(text)), unescape(value));
		if ($.isFunction(callback) && val !== null) {
			callback.call(this, val);
		} else {
			if ($.isFunction(cancelcallback)) cancelcallback.call(this);
		}
		return;
	}

	//the callbackfunction
	var cb = function (value) {
			if ($.isFunction(callback)) callback.call(this, value);
			$(this).dialog('close');
			$('#wl_dialog').remove();
		},

		//the callbackfunction on cancel
		ccb = function () {
			if ($.isFunction(cancelcallback)) cancelcallback.call(this);
			$(this).dialog('close');
			$('#wl_dialog').remove();
		};

	//set some options
	options = $.extend({}, {
		buttons: [{
			text: options.text.ok,
			click: function () {
				cb.call(this, $('#wl_promptinputfield').val());
			}
		}, {
			text: options.text.cancel,
			click: ccb
		}],
		open: function () {
			$('#wl_promptinputfield').focus().select();
			$('#wl_promptinputfield').uniform();
			$('#wl_promptinputform').bind('submit', function (event) {
				event.preventDefault();
				cb.call(this, $('#wl_promptinputfield').val());
				$(this).parent().dialog('close');
				$('#wl_dialog').remove();
			});

		}
	}, options);

	//use the dialog
	return $.alert('<p>' + unescape(text) + '</p><form id="wl_promptinputform"><input id="wl_promptinputfield" name="wl_promptinputfield" value="' + unescape(value) + '"></form>', options);
};

$.prompt.defaults = {
	text: {
		header: 'Please prompt',
		ok: 'OK',
		cancel: 'Cancel'
	}
};


/*----------------------------------------------------------------------*/
/* Alert Dialog
/* like the native alert method
/*----------------------------------------------------------------------*/

$.alert = function (content, options) {


	//if no options it is a normal dialog
	if (!options) {
		var options = $.extend(true, {}, {
			buttons: [{
				text: $.alert.defaults.text.ok,
				click: function () {
					$(this).dialog('close');
					$('#wl_dialog').remove();
				}
			}]
		}, $.alert.defaults);
	}

	//nativ behaviour
	if (options.nativ) {
		alert(content);
		return;
	}

	//create a container
	var container = $('<div/>', {
		id: 'wl_dialog'
	}).appendTo('body');

	//set a header
	if (options.text.header) {
		container.attr('title', options.text.header);
	}

	//fill the container
	container.html(content.replace(/\n/g, '<br>'));
	//display the dialog
	container.dialog(options);
	
	return{
		close:function(callback){
			container.dialog('close');
			container.remove();
			if($.isFunction(callback)) callback.call(this);
		},
		setHeader:function(text){
			this.set('title',text);
		},
		setBody:function(html){
			container.html(html);
		},
		set:function(option, value){
			container.dialog("option", option, value);
		}	
	}


};


$.alert.defaults = {
	nativ: false,
	resizable: false,
	modal: true,
	text: {
		header: 'Notification',
		ok: 'OK'
	}
};


/*----------------------------------------------------------------------*/
/* Message Function
/*----------------------------------------------------------------------*/


$.msg = function (content, options) {


	//get the options
	var options = $.extend({}, $.msg.defaults, options);

	var container = $('#wl_msg'),msgbox;

	//the container doen't exists => create it
	if (!container.length) {
		container = $('<div/>', {
			id: 'wl_msg'
		}).appendTo('body').data('msgcount', 0);
		var topoffset = parseInt(container.css('top'), 10);

		//bind some events to it
		container.bind('mouseenter', function () {
			container.data('pause', true);
		}).bind('mouseleave', function () {
			container.data('pause', false);
		});
		container.delegate('.msg-close', 'click', function () {
			container.data('pause', false);
			close($(this).parent());
		});
		container.delegate('.msg-box-close', 'click', function () {
			container.fadeOutSlide(options.fadeTime);
		});

		//bind the scroll event
		$(window).unbind('scroll.wl_msg').bind('scroll.wl_msg', function () {
			var pos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
			if (pos > topoffset) {
				(window.navigator.standalone === undefined) ? container.css({
					position: 'fixed',
					top: 10
				}) : container.css({
					top: pos + 10
				});
			} else {
				(window.navigator.standalone === undefined) ? container.removeAttr('style') : container.css({
					top: topoffset
				});
			}
		}).trigger('scroll.wl_msg');
	}
	
	//stop if no content is set
	if(!content)return false;

	//count of displayed messages
	var count = container.data('msgcount');

	function getHTML(content, headline) {
		return '<div class="msg-box"><h3>' + (headline || '') + '</h3><a class="msg-close">close</a><div class="msg-content">' + content.replace('\n', '<br>') + '</div></div>';
	}

	function create() {
		msgbox = $(getHTML(content, options.header)),
		closeall = $('.msg-box-close');

		//we have some messages allready
		if (count) {

			//No close all button
			if (!closeall.length) {
				msgbox.appendTo(container);
				$('<div class="msg-box-close">close all</div>').appendTo(container).fadeInSlide(options.fadeTime);

				//Close all button
			} else {
				msgbox.insertBefore(closeall);
			}

			//first message
		} else {
			msgbox.appendTo(container);
		}

		//fade it in nicely
		msgbox.fadeInSlide(options.fadeTime);

		//add the count of the messages to the container
		container.data('msgcount', ++count);

		//outclose it only if it's not sticky
		if (!options.sticky) {
			close(msgbox, options.live);
		}
	}

	function close(item, delay, callback) {
		if ($.isFunction(delay)){
			callback = delay;
			delay = 0;
		}else if(!delay){
			delay = 0;
		}
		setTimeout(function () {

			//if the mouse isn't over the container
			if (!container.data('pause')) {
				item.fadeOutSlide(options.fadeTime, function () {
					var count = $('.msg-box').length;
					if (count < 2 && $('.msg-box-close').length) {
						$('.msg-box-close').fadeOutSlide(options.fadeTime);
					}
					container.data('msgcount', count);
					if($.isFunction(callback)) callback.call(item);
				})
				//try again...
			} else {
				close(item, delay);
			}

		}, delay);
	}

	//create the messsage
	create();
	
	return {
		close:function(callback){
			close(msgbox,callback);
		},
		setHeader:function(text){
			msgbox.find('h3').eq(0).text(text);
		},
		setBody:function(html){
			msgbox.find('.msg-content').eq(0).html(html);
		},
		closeAll:function(callback){
			container.fadeOutSlide(options.fadeTime, function(){
				if($.isFunction(callback)) callback.call(this);
			});
		}	
	}

};

$.msg.defaults = {
	header: null,
	live: 5000,
	topoffset: 90,
	fadeTime: 500,
	sticky: false
};

//initial call to prevent IE to jump to the top
$(document).ready(function() {$.msg(false);});

/*----------------------------------------------------------------------*/
/* wl_Form v 1.3.5 by revaxarts.com
/* description:	handles the serialization, unserialization and sending
/*				of a form
/* dependency: 	$.confirm, wl_Number*, wl_Slider*, wl_Date*, wl_Value*,
/* 				wl_Password*, wl_File*, wl_Multiselect*
/*				* only when fields are within the form
/*----------------------------------------------------------------------*/
$.fn.wl_Form = function (method) {

	var args = arguments;
	return this.each(function () {

		var $this = $(this);

		if ($.fn.wl_Form.methods[method]) {
			return $.fn.wl_Form.methods[method].apply(this, Array.prototype.slice.call(args, 1));
		} else if (typeof method === 'object' || !method) {
			if ($this.data('wl_Form')) {
				var opts = $.extend({}, $this.data('wl_Form'), method);
			} else {
				var opts = $.extend({}, $.fn.wl_Form.defaults, method, $this.data());
			}
		} else {
			$.error('Method "' + method + '" does not exist');
		}

		//all fields within that form
		var $inputs = $this.find('input,textarea,select,div.date,div.slider'),
			//$required = $inputs.filter('[required]'), //Does not work on IE7/8
			$submitbtn = (opts.submitButton instanceof jQuery) ? opts.submitButton : $this.find(opts.submitButton),
			$resetbtn = (opts.resetButton instanceof jQuery) ? opts.resetButton : $this.find(opts.resetButton);

		if (!$this.data('wl_Form')) {

			$this.data('wl_Form', {});

			//get options from the forms nativ attributes
			opts.action = $this.attr('action') || opts.action;
			opts.method = $this.attr('method') || opts.method;

			//prevent the forms default behaviour
			$this.bind({
				'submit.wl_Form': function (event) {
					event.preventDefault();
					return false;
				},
				'reset.wl_Form': function (event) {
					event.preventDefault();
					return false;
				}
			});

			//bind the click action to the submit button
			$submitbtn.bind('click.wl_Form', function (event) {
				$.fn.wl_Form.methods.submit.call($this[0]);
				return false;
			});
			//bind the click action to the submit button
			$resetbtn.bind('click.wl_Form', function (event) {
				$.fn.wl_Form.methods.reset.call($this[0]);
				return false;
			});

			//iterate through the fields
			$inputs.each(function () {
				var _this = $(this),
					_row = _this.closest('section'),
					//the label should be nice readable
					_label = _row.find('label').eq(0).html() || this.name || this.id || '';
					


				//This is required because IEs < 9 can't handle this as expected
				if (_this.is('[required]') || typeof _this.prop('required') == 'string') {
					_this.data('required', true);
					//only append one required asterix
					if(!_row.find('span.required').length) _row.find('label').eq(0).append('&nbsp;<span class="required">&nbsp;</span>');
				}

				//add the label to the field (and strip out unwanted info)
				_this.data('wl_label', _label.replace(/<span>([^<]+)<\/span>|<([^>]+)\/?>/g, ''));

				//set initial data for Form reset
				_this.data('wl_initdata', function () {

					var _type = _this.attr("type");

					if (_type == "checkbox" || _type == "radio") {
						return _this.prop("checked");

						//datepicker
					} else if (_this.data('wl_Date')) {
						return _this.datepicker('getDate');

						//slider
					} else if (_this.data('wl_Slider')) {
						if (!_this.data('wl_Slider').connect) {
							if (_this.data('wl_Slider').range) {
								return _this.slider('option', 'values');
							} else {
								return _this.slider('option', 'value');
							}
						}
						//other fields
					} else {
						return _this.val();
					}

				}());
			});


			//set the form status after the submit button if status is true
			if (opts.status && !$submitbtn.closest('div').is('span.wl_formstatus')) {
				$submitbtn.closest('div').append('<span class="wl_formstatus"></span>');
			}

			//parse the location.search parameters
			if (opts.parseQuery) {
				$this.wl_Form.methods.unserialize.call(this);
			}


		} else {

		}

		if (opts) $.extend($this.data('wl_Form'), opts);
	});

};

$.fn.wl_Form.defaults = {
	submitButton: 'button.submit',
	resetButton: 'button.reset',
	method: 'post',
	action: null,
	ajax: true,
	serialize: false,
	parseQuery: true,
	dataType: 'text',
	status: true,
	sent: false,
	confirmSend: true,
	text: {
		required: 'This field is required',
		valid: 'This field is invalid',
		password: 'This password is to short',
		passwordmatch: 'This password doesn\'t match',
		fileinqueue: 'There is at least one file in the queue',
		incomplete: 'Please fill out the form correctly!',
		send: 'send form...',
		sendagain: 'send again?',
		success: 'form sent!',
		error: 'error while sending!',
		parseerror: 'Can\'t unserialize query string:\n %e'
	},
	tooltip: {
		gravity: 'nw'
	},
	onRequireError: function (element) {},
	onValidError: function (element) {},
	onPasswordError: function (element) {},
	onFileError: function (element) {},
	onBeforePrepare: function () {},
	onBeforeSubmit: function (data) {},
	onReset: function () {},
	onComplete: function (textStatus, jqXHR) {},
	onError: function (textStatus, error, jqXHR) {},
	onSuccess: function (data, textStatus, jqXHR) {}
};
$.fn.wl_Form.version = '1.3.5';


$.fn.wl_Form.methods = {
	disable: function () {
		var $this = $(this),
			_inputs = $this.find($this.data('wl_Form').submitButton + ',input,textarea,select,div.date,div.slider');
		//iterate through all fields
		_inputs.each(function () {
			var _this = $(this);
			if (_this.is('div')) {
				//disable slider and datefields
				if (_this.is('div.slider') && _this.data('wl_Slider')) {
					_this.wl_Slider('disable');
				} else if (_this.is('div.date') && _this.data('wl_Date')) {
					_this.wl_Date('disable');
				}
			} else {
				//disable normal fields
				_this.prop('disabled', true);
			}
		});
		$this.data('wl_Form').disabled = true;
	},
	enable: function () {
		var $this = $(this),
			_inputs = $this.find($this.data('wl_Form').submitButton + ',input,textarea,select,div.date,div.slider');
		//iterate through all fields
		_inputs.each(function () {
			var _this = $(this);
			if (_this.is('div')) {
				//enable slider and datefields
				if (_this.is('div.slider') && _this.data('wl_Slider')) {
					_this.wl_Slider('enable');
				} else if (_this.is('div.date') && _this.data('wl_Date')) {
					_this.wl_Date('enable');
				}
			} else {
				//enable normal fields
				_this.prop('disabled', false);
			}
		});
		$this.data('wl_Form').disabled = false;
	},
	reset: function () {
		var $this = $(this),
			_inputs = $this.find('input,textarea,select,div.date,div.slider');

		//trigger callback
		if ($this.data('wl_Form').onReset.call($this[0]) === false) return false;

		//remove all errorclasses
		$this.find('section.error').removeClass('error');
		
		//iterate through all fields
		_inputs.each(function () {
			var _this = $(this),
				_type = _this.attr("type");

			if (_type == "checkbox") {
				_this.prop("checked", _this.data('wl_initdata')).trigger('change');

				//radio buttons
			} else if (_type == "radio") {
				_this.prop("checked", _this.data('wl_initdata')).trigger('change');

				//datepicker
			} else if (_this.data('wl_Date')) {
				_this.datepicker('setDate', _this.data('wl_initdata'));

				//time 
			} else if (_this.data('wl_Time')) {
				_this.val(_this.data('wl_initdata'));

				//multi select
			} else if (_this.data('wl_Multiselect')) {
				_this.wl_Multiselect('clear');
				_this.wl_Multiselect('select', _this.data('wl_initdata'));

				//slider
			} else if (_this.data('wl_Slider')) {
				if (!_this.data('wl_Slider').connect) {
					if (_this.data('wl_Slider').range) {
						_this.slider('option', 'values', $.parseData(_this.data('wl_initdata')));
					} else {
						_this.slider('option', 'value', _this.data('wl_initdata'));
					}
					_this.wl_Slider("change");
					_this.wl_Slider("slide");
				}
				//prevent file inputs to get triggered
			} else if (_this.data('wl_File')) {
				_this.wl_File('reset');

				//wysiwyg editor
			} else if (_this.data('wl_Editor')) {
				_this.val(_this.data('wl_initdata')).wysiwyg("setContent", _this.data('wl_initdata'));

				//colorpicker
			} else if (_this.data('wl_Color')) {
				_this.wl_Color('set', 'value', _this.data('wl_initdata'));

				//other fields
			} else {
				_this.val(_this.data('wl_initdata')).trigger('change');

				//placeholder text needs some CSS
				if (_this.is('[placeholder]')) {
					if (_this.data('wl_initdata') == "" || _this.data('wl_initdata') == _this.attr("placeholder")) {
						_this.addClass("placeholder").val(_this.attr("placeholder")).data("uservalue", false);
					} else {
						_this.removeClass("placeholder").data("uservalue", true);
					}
				}
			}

		});
	},
	submit: function () {

		//collect some required info
		var $this = $(this),
			_data = {},
			_opts = $this.data('wl_Form'),
			_inputs = $this.find('input,textarea,select,div.date,div.slider'),
			_statusel = $this.find('.wl_formstatus'),
			_requiredelements = Array(),
			_validelements = Array(),
			_passwordelements = Array(),
			_fileelements = Array(),
			_submit = true,
			_submitbtn = (_opts.submitButton instanceof jQuery) ? _opts.submitButton : $this.find(_opts.submitButton),
			_callbackReturn, _addHiddenField = function (after, id, name, value) {
				if (!$('#' + id).length) $('<input>', {
					type: 'hidden',
					id: id,
					name: name,
					value: value
				}).insertAfter(after);
			};

		//status reset
		_statusel.text("");

		//iterate through all fields
		_inputs.each(function (i, e) {
			var _this = $(this),
				_row = _this.closest('section');

			//remove all error classes
			_row.removeClass('error');

			//if a placeholder is set remove the value temporary
			if (_this.prop('placeholder') && _this.val() == _this.prop('placeholder') && !_this.data('uservalue')) {
				_this.val('');
			}
			//if field is required and a value isn't set or it is a checkbox and the checkbox isn't checked or it is a file upload with no files
			if (_this.data('required')) {
				if ((!_this.val() || _this.is(':checkbox') && !_this.is(':checked')) && !_this.data('wl_File')) {
					_requiredelements.push(_this);
					_submit = false;
				} else if (_this.is(':radio')) {
					
					//get all checked radios;
					var checked = $('input[name='+_this.attr('name')+']:checked');
					//no radio button is selected
					if(!checked.length){
						_requiredelements.push(_this);
						_submit = false;
					}

				} else if (_this.data('wl_File') && !_this.data('wl_File').files.length) {
					//use the filepool for the tooltip
					_requiredelements.push(_row.find('.fileuploadpool').eq(0));
					_submit = false;

				}
			}
			//if it is a valid field but it isn't valid
			if (_this.data('wl_Valid') && !_this.data('wl_Valid').valid) {
				_validelements.push(_this);
				_submit = false;
			}
			//check if there is a file in the queue
			if (_this.data('wl_File') && !$.isEmptyObject(_this.data('wl_File').queue)) {
				//use the filepool for the tooltip
				_fileelements.push(_row.find('.fileuploadpool').eq(0));
				_submit = false;
			}
			//if it is a password
			if (_this.data('wl_Password')) {
				var value = _this.val();
				//password confirmation is set and the confirmation isn't equal the password or the password is shorter than the minlength of the password field
				if ((_this.data('wl_Password').confirm && _this.data('wl_Password').connect && value != $('#' + _this.data('wl_Password').connect).val()) || (value && value.length < _this.data('wl_Password').minLength)) {
					//_row.addClass('error');
					_passwordelements.push(_this);
					_submit = false;

				}
			};
		});

		//if some of the above errors occures
		if (!_submit) {

			//iterate through all required fields
			$.each(_requiredelements, function (i, e) {
												
				var _row = e.closest('section');
				_row.addClass('error');
				
				//callback
				_opts.onRequireError.call(e[0], e);
				
				//store the old tooltip if set
				var orgtitle = e.attr('original-title');
				if(orgtitle) e.removeData('tipsy').removeAttr('original-title');

				//use tipsy for a tooltip
				e.tipsy($.extend({}, config.tooltip, _opts.tooltip, {
					trigger: 'manual',
					fallback: e.data('errortext') || _opts.text.required
				}));
				e.tipsy('show');

				//hide the tooltip on every radio button
				if(e.is(':radio')){
					var radiosiblings = $('input[name='+e.attr('name')+']');
					radiosiblings.bind('focus.tooltip, click.tooltip, change.tooltip', function () {
						e.unbind('focus.tooltip, click.tooltip, change.tooltip').tipsy('hide');
						//restore the old tooltip
						if(orgtitle) e.attr('title',orgtitle).tipsy(config.tooltip);
					});
				}else{
					//hide tooltip on fieldfocus or change
					e.bind('focus.tooltip, click.tooltip, change.tooltip', function () {
						$(this).unbind('focus.tooltip, click.tooltip, change.tooltip').tipsy('hide');
						//restore the old tooltip
						if(orgtitle) e.attr('original-title',orgtitle).tipsy(config.tooltip);
					});
				}
			});


			//iterate through all valid fields
			$.each(_validelements, function (i, e) {
												
				var _row = e.closest('section');
				//highlight the row
				_row.addClass('error');
				
				//callback
				_opts.onValidError.call(e[0], e);

				//store the old tooltip if set
				var orgtitle = e.attr('original-title');
				if(orgtitle) e.removeData('tipsy').removeAttr('original-title');

				//use tipsy for a tooltip
				e.tipsy($.extend({}, config.tooltip, _opts.tooltip, {
					trigger: 'manual',
					fallback: e.data('errortext') || e.data('wl_Valid').errortext || _opts.text.valid
				}));
				e.tipsy('show');

				//hide tooltip on fieldfocus
				e.bind('focus.tooltip, click.tooltip', function () {
					$(this).unbind('focus.tooltip, click.tooltip').tipsy('hide');
					//restore the old tooltip
					if(orgtitle) e.attr('original-title',orgtitle).tipsy(config.tooltip);
				});
			});

			//iterate through all password fields
			$.each(_passwordelements, function (i, e) {
				var text = '',
					value = e.val(),
					_row = e.closest('section');
					
				//highlight the row
				_row.addClass('error');
				
				//store the old tooltip if set
				var orgtitle = e.attr('original-title');
				if(orgtitle) e.removeData('tipsy').removeAttr('original-title');
				
				
				//confirmation is set
				if (e.data('wl_Password').confirm) {
					var connect = $('#' + e.data('wl_Password').connect);

					//but password is not equal confimration
					if (value != connect.val()) {

						//tipsy on the confirmation field
						connect.tipsy($.extend({}, config.tooltip, _opts.tooltip, {
							trigger: 'manual',
							fallback: connect.data('errortext') || _opts.text.passwordmatch
						}));
						connect.tipsy('show');

						//hide tooltip in fieldfocus
						connect.bind('focus.tooltip, click.tooltip', function () {
							$(this).unbind('focus.tooltip, click.tooltip').tipsy('hide');
							//restore the old tooltip
							if(orgtitle) e.attr('original-title',orgtitle).tipsy(config.tooltip);
						});
					}
				}

				//length is to short
				if (value.length < e.data('wl_Password').minLength) {
					_opts.onPasswordError.call(e[0], e);

					//tipsy
					e.tipsy($.extend({}, config.tooltip, _opts.tooltip, {
						trigger: 'manual',
						fallback: e.data('errortext') || _opts.text.password
					}));
					e.tipsy('show');

					//hide tooltip in fieldfocus
					e.bind('focus.tooltip, click.tooltip', function () {
						$(this).unbind('focus.tooltip, click.tooltip').tipsy('hide');
						//restore the old tooltip
						if(orgtitle) e.attr('original-title',orgtitle).tipsy(config.tooltip);
					});
				}

			});

			//iterate through all file upload fields
			$.each(_fileelements, function (i, e) {

				var _row = e.closest('section');
				//highlight the row
				_row.addClass('error');
				//callback
				_opts.onFileError.call(e[0], e);

				//use tipsy for a tooltip
				e.tipsy($.extend({}, config.tooltip, _opts.tooltip, {
					trigger: 'manual',
					fallback: e.data('errortext') || _opts.text.fileinqueue
				}));
				e.tipsy('show');

				//hide tooltip on fieldfocus or change
				e.bind('focus.tooltip, click.tooltip, change.tooltip', function () {
					$(this).unbind('focus.tooltip, click.tooltip, change.tooltip').tipsy('hide');
				});
			});
			//Set status message
			_statusel.text(_opts.text.incomplete);
			return false;
		}


		//confirmation is required if the form was allready sent
		if (_opts.confirmSend && _opts.sent === true) {
			$.confirm(_opts.text.sendagain, function () {
				_opts.sent = false;
				$.fn.wl_Form.methods.submit.call($this[0]);
			});
			return false;
		}

		//callback can return false
		if (_opts.onBeforePrepare.call($this[0]) === false) {
			return false;
		}

		//iterate through all fields and prepare data
		_inputs.each(function (i, e) {
			var _el = $(e),
				key = _el.attr('name') || e.id,
				value = null;

			//datepicker
			if (_el.data('wl_Date')) {

				var connect = $this.find('input[data-connect=' + e.id + ']').eq(0),
					dateobj = new Date(_el.datepicker('getDate')),
					//format: YYYY-MM-DD
					date = dateobj.getFullYear() + '-' + $.leadingZero(dateobj.getMonth() + 1) + '-' + $.leadingZero(dateobj.getDate());
				if (dateobj.getTime()) {
					//is connected to a timefield
					if (connect.length) {
						value = date + ' ' + (connect.data('wl_Time').time || '00:00');
						//insert a hidden field for non ajax submit
						if (!_opts.ajax) _addHiddenField(_el, key + '_wlHidden', key, value);
					} else {
						value = date;
						//correct the format on nativ submit
						if (!_opts.ajax) _el.val(value);
					}
				}

				//inline Date needs a hidden input for nativ submit
				if (!_opts.ajax && _el.is('div')) {
					_addHiddenField(_el, key + '_wlHidden', key, value)
				}
				_data[key] = value;

				//slider
			} else if (_el.data('wl_Slider')) {

				//if it is connected we have a input field too so skip it
				if (!_el.data('wl_Slider').connect) {
					if (_el.data('wl_Slider').range !== true) {
						value = _el.slider('option', 'value');
						//insert a hidden field for non ajax submit
						if (!_opts.ajax) _addHiddenField(_el, key + '_wlHidden', key, value);
					} else {
						value = _el.slider('option', 'values');
						//insert hidden fields for non ajax submit
						if (!_opts.ajax) {
							for (var i = value.length - 1; i >= 0; i--) {
								_addHiddenField(_el, key + '_' + i + '_wlHidden', key + '[]', value[i]);
							}
						}
					}
					_data[key] = value;

				} else {
					//form needs a name attribute for nativ submit
					if (!_opts.ajax) {
						if (_el.data('wl_Slider').range !== true) {
							var input = $('#' + _el.data('wl_Slider').connect);
							if (!input.attr('name')) input.attr('name', _el.data('wl_Slider').connect);
						} else {
							var connect = $.parseData(_el.data('wl_Slider').connect, true);
							var input1 = $('#' + connect[0]);
							var input2 = $('#' + connect[1]);
							if (!input1.attr('name')) input1.attr('name', connect[0]);
							if (!input2.attr('name')) input2.attr('name', connect[1]);
						}
					}
				}

				//wysiwyg editor
			} else if (_el.data('wl_Editor')) {

				//copy the content to the textarea
				_el.wysiwyg('save');
				_data[key] = _el.val();

				//file upload
			} else if (_el.data('wl_File')) {

				_data[key] = _el.data('wl_File').files;

				//if no file was uploaded value is null
				if ($.isEmptyObject(_data[key])) {
					_data[key] = null;
					//insert a hidden field for non ajax submit
					if (!_opts.ajax) _addHiddenField(_el, key + '_wlHidden', key, 'null');
				} else {
					//insert hidden fields for non ajax submit
					if (!_opts.ajax) {
						for (var i = _data[key].length - 1; i >= 0; i--) {
							_addHiddenField(_el, key + '_' + i + '_wlHidden', key + '[]', _data[key][i]);
						}
					}
				}

				//timefield
			} else if (_el.data('wl_Time')) {

				//if it is connected we have a datefield too so skip it
				if (!_el.data('wl_Time').connect) {
					_data[key] = _el.data('wl_Time').time;

					//insert a hidden field for non ajax submit
					if (!_opts.ajax) _addHiddenField(_el, key + '_wlHidden', key, _el.data('wl_Time').time);
				}


				//password
			} else if (_el.data('wl_Password')) {

				//only add if it's not the confirmation field
				if (!_el.data('wl_Password').confirmfield) _data[key] = _el.val();
				if (!_opts.ajax && _el.data('wl_Password').confirmfield) _el.prop('disabled', true);

				//radio buttons
			} else if (_el.is(':radio')) {

				if (_el.is(':checked')) {
					//use the value attribute if present or id as fallback (new in 1.1)
					_data[key] = (_el.val() != 'on') ? _el.val() : e.id;
				}

				//checkbox
			} else if (_el.is(':checkbox')) {
				
				//if checkbox name has '[]' at the and we need an array
				if (/\[\]$/.test(key)) {
					_data[key] = _data[key] || [];
					//checkbox is checked
					if (_el.is(':checked')) {
						//if value = 'on' value isn't set use id or val if id isn't defined
						var val = _el.val();
						_data[key].push((val != 'on') ? val : _el.attr('id') || val);
					}
				} else {
					//use value if set and true or false if not set
					if (_el.is(':checked')) {
						var val = _el.val();
						_data[key] = (val != 'on') ? val : _el.is(':checked') || (_el.attr('id') || val);
					}else{
						//use always 0 (false) if unchecked
						_data[key] = 0;	
					}
				}
				
				//convert true to 1 and false to 0
				if(_data[key] === true) { _data[key] = 1; }else if(_data[key] === false) {  _data[key] = 0; }

				//insert a hidden field for non ajax submit
				if (!_opts.ajax) _addHiddenField(_el, key + '_wlHidden', key, _data[key]);

				//number field
			} else if (_el.data('wl_Number')) {

				value = _el.val();
				if (isNaN(value)) {
					value = null;
				}
				_data[key] = value;

				//other fields
			} else {
				var val = _el.val();
				//if name attribute has '[]' at the and we need an array
				if (/\[\]$/.test(key) && !$.isArray(val)) {
					_data[key] = _data[key] || [];
					_data[key].push(val);
				} else {
					_data[key] = val;
				}
			}
		});
		
		//add the name attribut of the submit button to the data (native behavior)
		var submitbtnname = _submitbtn.attr('name');
		if(submitbtnname){
			_data[submitbtnname] = _submitbtn.attr('value') || true;
			//insert a hidden field for non ajax submit
			if (!_opts.ajax) _addHiddenField(_submitbtn, submitbtnname + '_wlHidden', submitbtnname, _data[submitbtnname]);
		}

		//callback
		_callbackReturn = _opts.onBeforeSubmit.call($this[0], _data);

		//can return false to prevent sending
		if (_callbackReturn === false) {
			return false;
			//can return an object to modifie the _data
		} else if (typeof _callbackReturn == 'object') {
			_data = _callbackReturn;
		}


		//should we serialize it? (key=value&key2=value2&...)
		if (_opts.serialize) {
			_data = $.param(_data);
		}
		//set status text
		_statusel.text(_opts.text.send);

		//send the form natively
		if (!_opts.ajax) {
			$this.unbind('submit.wl_Form');
			$this.submit();
			return false;
		}

		//now disable it
		$.fn.wl_Form.methods.disable.call(this);


		//send the form
		$.ajax({
			url: _opts.action,
			type: _opts.method,
			data: _data,
			dataType: _opts.dataType,
			//callback on success
			success: function (data, textStatus, jqXHR) {
				_statusel.textFadeOut(_opts.text.success);
				_opts.onSuccess.call($this[0], data, textStatus, jqXHR);
			},
			//callback on complete
			complete: function (jqXHR, textStatus) {
				$.fn.wl_Form.methods.enable.call($this[0]);
				_opts.sent = true;
				_opts.onComplete.call($this[0], textStatus, jqXHR);
			},
			//callback on error
			error: function (jqXHR, textStatus, error) {
				_statusel.text(_opts.text.error);
				_opts.onError.call($this[0], textStatus, error, jqXHR);
			}
		});

	},
	unserialize: function (string) {
		var $this = $(this),
			_searchquery = string || location.search.substr(1);

		//parse only if we have something to parse
		if (_searchquery) {

			//could throw an error because its an userinput
			try {

				//prepare string to get a clean array with with key => value
				values = decodeURIComponent(_searchquery).split('&');

				var serialized_values = [];

				$.each(values, function () {
					var properties = this.split("="),
						key = properties.shift();

					properties = properties.join('=');

					if ((typeof key !== 'undefined') && (typeof properties !== 'undefined')) {
						key = key.replace(/\+/g, " ");
						//handle Array
						if (/\[\]$/.test(key)) {
							key = key.replace('[]', '');
							serialized_values[key] = serialized_values[key] || [];
							serialized_values[key].push(properties.replace(/\+/g, " "));
						} else {
							serialized_values[key] = properties.replace(/\+/g, " ");
						}
					}
				});
				values = serialized_values;

				// Iterate through each element
				$this.find("input,textarea,select,div.date,div.slider").each(function () {
					var _this = $(this),
						_type = _this.attr("type"),
						tag_name = this.name || this.id;

					//remove '[]' if present
					if (/\[\]$/.test(tag_name)) tag_name = tag_name.replace('[]', '');

					// Set the values to field
					if (values[tag_name] != null) {

						//chechboxes
						if (_type == "checkbox") {
							_this.data('wl_initdata', (values[tag_name] == 'true')).prop("checked", (values[tag_name] == 'true'));

							//radio buttons
						} else if (_type == "radio") {
							$('input[id="' + values[tag_name] + '"]').data('wl_initdata', true).attr("checked", true);

							//password
						} else if (_type == "password") {
							//don't write passwords for security reasons
							//_this.val(values[tag_name]).trigger('change')
							//datepicker
						} else if (_this.data('wl_Date') && _this.is('input')) {
							if (/(\d\d:\d\d)$/.test(values[tag_name])) {
								var time = values[tag_name].substr(11),
									date = values[tag_name].substr(0, 10);
								_this.data('wl_initdata', new Date(date)).datepicker('setDate', new Date(date));
								$('input[data-connect="' + tag_name + '"]').data('wl_initdata', time).val(time).data('wl_Time').time = time;
							} else {
								_this.data('wl_initdata', new Date(values[tag_name])).datepicker('setDate', new Date(values[tag_name]));
							}

							//inline datepicker
						} else if (_this.data('wl_Date') && _this.is('div')) {
							_this.data('wl_initdata', new Date(values[tag_name])).datepicker('setDate', new Date(values[tag_name]));

							//colorpicker
						} else if (_this.data('wl_Color')) {
							_this.data('wl_initdata', values[tag_name]).wl_Color('set', 'value', values[tag_name]);

							//Slider
						} else if (_this.data('wl_Slider')) {
							if (!_this.data('wl_Slider').connect) {
								if (_this.data('wl_Slider').range) {
									_this.slider('option', 'values', $.parseData(values[tag_name]));
								} else {
									_this.slider('option', 'value', values[tag_name]);
								}
								_this.data('wl_initdata', values[tag_name]);
								_this.wl_Slider("change");
								_this.wl_Slider("slide");
							}

							//Multiselect
						} else if (_this.data('wl_Multiselect')) {
							_this.data('wl_initdata', values[tag_name]).wl_Multiselect('select', values[tag_name]);

							//wysiwyg editor
						} else if (_this.data('wl_Editor')) {
							_this.data('wl_initdata', values[tag_name]).val(values[tag_name]).wysiwyg("setContent", values[tag_name]);

							//other fields
						} else {
							_this.data('wl_initdata', values[tag_name]).val(values[tag_name]).trigger('change');
						}
					}
				});
			} catch (e) {

				//call a message to prevent crashing the application
				$.msg($this.data('wl_Form').text.parseerror.replace('%e', e));
			}
		}
	},
	set: function () {
		var $this = $(this),
			options = {};
		if (typeof arguments[0] === 'object') {
			options = arguments[0];
		} else if (arguments[0] && arguments[1] !== undefined) {
			options[arguments[0]] = arguments[1];
		}
		$.each(options, function (key, value) {
			if ($.fn.wl_Form.defaults[key] !== undefined && $.fn.wl_Form.defaults[key] !== null) {
				$this.data('wl_Form')[key] = value;
			} else {
				$.error('Key "' + key + '" is not defined');
			}
		});

	}
};
/*----------------------------------------------------------------------*/
/* Set some Standards
/* This file not required! It just demonstrate how you can define
/* standards in one configuration file
/*----------------------------------------------------------------------*/

var config = {
	tooltip :{
		gravity: 'nw',
		fade: false,
		opacity: 1,
		offset: 0
	}
};

//wrap them because of some jQuery Elements
$(document).ready(function() {


if($.fn.wl_Alert) $.fn.wl_Alert.defaults = {
	speed: 500,
	sticky: false,
	onBeforeClose: function (element) {},
	onClose: function (element) {}
};

if($.fn.wl_Autocomplete) $.fn.wl_Autocomplete.defaults = {
	//check http://jqueryui.com/demos/autocomplete/ for all options
};

if($.fn.wl_Breadcrump) $.fn.wl_Breadcrump.defaults = {
	start: 0,
	numbers: false,
	allownextonly: false,
	disabled: false,
	connect: null,
	onChange: function () {}
};

if($.fn.wl_Calendar) $.fn.wl_Calendar.defaults = {
	//check http://arshaw.com/fullcalendar/ for all options
};

if($.fn.wl_Chart) $.fn.wl_Chart.defaults = {
	width: null,
	height: 300,
	hideTable: true,
	tableBefore: false,
	data: {},
	stack: false,
	type: 'lines',
	points: null,
	shadowSize: 2,
	fill: null,
	fillColor: null,
	lineWidth: null,
	legend: true,
	legendPosition: "ne", // or "nw" or "se" or "sw"
	tooltip: true,
	tooltipGravity: 'n',
	tooltipPattern: function (value, legend, label, id, itemobj) {
		return "value is " + value + " from " + legend + " at " + label + " (" + id + ")";
	},
	//tooltipPattern: "value is %1 from %2 at %3 (%4)", //also possible
	orientation: 'horizontal',
	colors: ['#b2e7b2', '#f0b7b7', '#b5f0f0', '#e8e8b3', '#efb7ef', '#bbb6f0'],
	flot: {},
	onClick: function (value, legend, label, id, itemobj) {}
};

if($.fn.wl_Color) $.fn.wl_Color.defaults = {
	mousewheel: true,
	onChange: function (hsb, rgb) {}
};


if($.fn.wl_Date) $.fn.wl_Date.defaults = {
	value: null,
	mousewheel: true,
	
	//some datepicker standards
	dayNames : ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
	dayNamesMin : ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
	dayNamesShort : ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	firstDay: 0,
	nextText: 'next',
	prevText: 'prev',
	currentText: 'Today',
	showWeek: true,
	dateFormat: 'mm/dd/yy'
};


if($.confirm) $.confirm.defaults = {
	text:{
		header: 'Please confirm',
		ok: 'Yes',
		cancel: 'No'
	}
};
if($.prompt) $.prompt.defaults = {
	text:{
		header: 'Please prompt',
		ok: 'OK',
		cancel: 'Cancel'
	}
};
if($.alert) $.alert.defaults = {
	nativ: false,
	resizable: false,
	modal: true,
	text:{
		header: 'Notification',
		ok: 'OK'
	}
};

if($.fn.wl_Editor) $.fn.wl_Editor.defaults = {
	css: 'css/light/editor.css',
	buttons: 'bold|italic|underline|strikeThrough|justifyLeft|justifyCenter|justifyRight|justifyFull|highlight|colorpicker|indent|outdent|subscript|superscript|undo|redo|insertOrderedList|insertUnorderedList|insertHorizontalRule|createLink|insertImage|h1|h2|h3|h4|h5|h6|paragraph|rtl|ltr|cut|copy|paste|increaseFontSize|decreaseFontSize|html|code|removeFormat|insertTable',
	initialContent: ''
};

if($.fn.wl_File) $.fn.wl_File.defaults = {
	url: 'upload.php',
	autoUpload: true,
	paramName: 'files',
	multiple: false,
	allowedExtensions: ['jpg','jpeg','gif','png','doc','zip','docx','txt','pdf'],
	maxNumberOfFiles: 0,
	maxFileSize: 0,
	minFileSize: 0,
	sequentialUploads: false,
	dragAndDrop: true,
	formData: {},
	text: {
		ready: 'ready',
		cancel: 'cancel',
		remove: 'remove',
		uploading: 'uploading...',
		done: 'done',
		start: 'start upload',
		add_files: 'add files',
		cancel_all: 'cancel upload',
		remove_all: 'remove all'
	},
	onAdd: function (e, data) {},
	onDelete:function(files){},
	onCancel:function(file){},
	onSend: function (e, data) {},
	onDone: function (e, data) {},
	onFinish: function (e, data) {},
	onFail: function (e, data) {},
	onAlways: function (e, data) {},
	onProgress: function (e, data) {},
	onProgressAll: function (e, data) {},
	onStart: function (e) {},
	onStop: function (e) {},
	onChange: function (e, data) {},
	onDrop: function (e, data) {},
	onDragOver: function (e) {},
	onFileError: function (error, fileobj) {
		$.msg('file is not allowed: ' + fileobj.name, {
			header: error.msg + ' (' + error.code + ')'
		});
	}
};

if($.fn.wl_Fileexplorer) $.fn.wl_Fileexplorer.defaults = {
	url: 'elfinder/php/connector.php',
	toolbar: [
		['back', 'reload', 'open', 'select', 'quicklook', 'info', 'rename', 'copy', 'cut', 'paste', 'rm', 'mkdir', 'mkfile', 'upload', 'duplicate', 'edit', 'archive', 'extract', 'resize', 'icons', 'list', 'help']
	]
};

if($.fn.wl_Form) $.fn.wl_Form.defaults = {
	submitButton: 'button.submit',
	resetButton: 'button.reset',
	method: 'post',
	action: null,
	ajax: true,
	serialize: false,
	parseQuery: true,
	dataType: 'text',
	status: true,
	sent: false,
	confirmSend: true,
	text: {
		required: 'This field is required',
		valid: 'This field is invalid',
		password: 'This password is to short',
		passwordmatch: 'This password doesn\'t match',
		fileinqueue: 'There is at least one file in the queue',
		incomplete: 'Please fill out the form correctly!',
		send: 'send form...',
		sendagain: 'send again?',
		success: 'form sent!',
		error: 'error while sending!',
		parseerror: 'Can\'t unserialize query string:\n %e'
	},
	tooltip: {
		gravity: 'nw'
	},
	onRequireError: function (element) {},
	onValidError: function (element) {},
	onPasswordError: function (element) {},
	onFileError: function (element) {},
	onBeforePrepare: function () {},
	onBeforeSubmit: function (data) {},
	onReset: function () {},
	onComplete: function (textStatus, jqXHR) {},
	onError: function (textStatus, error, jqXHR) {},
	onSuccess: function (data, textStatus, jqXHR) {}
};

if($.fn.wl_Gallery) $.fn.wl_Gallery.defaults = {
	group: 'wl_gallery',
	editBtn: true,
	deleteBtn: true,
	fancybox: {},
	onEdit: function (element, href, title) {},
	onDelete: function (element, href, title) {},
	onMove: function (element, href, title, newOrder) {}
};

if($.fn.wl_Multiselect) $.fn.wl_Multiselect.defaults = {
	height: 200,
	items: [],
	selected: [],
	showUsed: false,
	searchfield: true,
	onAdd: function (values) {},
	onRemove: function (values) {},
	onSelect: function (values) {},
	onUnselect: function (values) {},
	onSort: function (values) {}
};

if($.fn.wl_Number) $.fn.wl_Number.defaults = {
	step: 1,
	decimals: 0,
	start: 0,
	min: null,
	max: null,
	mousewheel: true,
	onChange: function (value) {},
	onError: function (value) {}
};

if($.fn.wl_Password) $.fn.wl_Password.defaults = {
	confirm: true,
	showStrength: true,
	words: ['too short', 'bad', 'medium', 'good', 'very good', 'excellent'],
	minLength: 3,
	text: {
		confirm: 'please confirm',
		nomatch: 'password doesn\'t match'
	}
};

if($.fn.wl_Slider) $.fn.wl_Slider.defaults = {
	min: 0,
	max: 100,
	step: 1,
	animate: false,
	disabled: false,
	orientation: 'horizontal',
	range: false,
	mousewheel: true,
	connect: null,
	tooltip: false,
	tooltipGravity: ['s','w'],
	tooltipPattern: "%n",
	onSlide: function (value) {},
	onChange: function (value) {}
};

if($.fn.wl_Time) $.fn.wl_Time.defaults = {
	step: 5,
	timeformat: 24,
	roundtime: true,
	time: null,
	value: null,
	mousewheel: true,
	onDateChange: function (offset) {},
	onHourChange: function (offset) {},
	onChange: function (value) {}
};

if($.fn.wl_Valid) $.fn.wl_Valid.defaults = {
	errorClass: 'error',
	instant: true,
	regex: /.*/,
	minLength: 0,
	onChange: function ($this, value) {},
	onError: function ($this, value) {}
};

if($.fn.wl_Mail) $.fn.wl_Mail.defaults = {
	regex: /^([\w-]+(?:\.[\w-]+)*)\@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$|(\[?(\d{1,3}\.){3}\d{1,3}\]?)$/i,
	onChange: function (element, value) {
		element.val(value.toLowerCase());
	}
};

if($.fn.wl_URL) $.fn.wl_URL.defaults = {
	regex: /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w]))*\.+(([\w#!:.?+=&%@!\-\/]))?/,
	instant: false,
	onChange: function (element, value) {
		if (value != '' && !/^(ftp|http|https):\/\//.test(value)) element.val('http://' + value).trigger('change.wl_Valid');
	}
};

if($.fn.wl_Widget) $.fn.wl_Widget.defaults = {
	collapsed: false,
	load: null,
	reload: false,
	removeContent: true,
	collapsible: true,
	sortable: true,
	text: {
		loading: 'loading...',
		reload: 'reload',
		collapse: 'collapse widget',
		expand: 'expand widget'
	},
	onDrag: function () {},
	onDrop: function () {},
	onExpand: function () {},
	onCollapse: function () {}
};



});

$(document).ready(function() {
						   
						   
	var $body = $('body'),
		$content = $('#content'),
		$form = $content.find('#loginform');
	
		
		//IE doen't like that fadein
		if(!$.browser.msie) $body.fadeTo(0,0.0).delay(500).fadeTo(1000, 1);
		
		
		$("input").uniform();
		

		$form.wl_Form({
			status:false,
			onBeforeSubmit: function(data){
				$form.wl_Form('set','sent',false);
				if(data.username || data.password){
					location.href="dashboard.html";
				}else{
					$.wl_Alert('Please provide something!','info','#content');
				}
				return false;

			}							  
		});
		
		
});