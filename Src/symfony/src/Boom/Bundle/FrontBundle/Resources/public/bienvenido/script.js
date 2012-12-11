$(document).ready( function() {

  window.setTimeout( function() {
    $('#sld1').addClass('active')
  }, 400);

  var pageY = function() {
    return $(window).scrollTop();
  }

  var scrollD = $('div.wrapper > a.scroll-down');

  $.nextSlide = function() {

    $('body, html').stop(true, true).animate({
      scrollTop: '+=700'
    }, 500 );

    return false;

  }

  scrollD.click( function() {

    return $.nextSlide();

  });

  $(window).scroll(function(){
    var slideH = 680,
        close = window.parent.$('#iframe-container .close-frame');

    /*if ( pageY() < slideH ) {
      close.css('opacity', .5);
    }*/

    if ( pageY() >= slideH ) {
      $('#sld2').addClass('active');
    }

    if ( pageY() >= (slideH*2) ) {
      $('#sld3').addClass('active');
    }

    if ( pageY() >= (slideH*3) ) {
      $('#sld4').addClass('active');
    }

    if ( pageY() >= (slideH*4) ) {
      $('#sld5').addClass('active');
    }

    if ( pageY() >= (slideH*5) ) {
      $('#sld6').addClass('active');
    }

    if ( pageY() >= (slideH*6) ) {
      $('#sld7').addClass('active');
    }

    if ( pageY() >= (slideH*7) ) {
      $('#sld8').addClass('active');
      $('#sld8').find('.text-container p').css('opacity', .999);
      window.setTimeout(function(){
        $('#sld8').children('.text-container').addClass('active');
      }, 1500);
    }

    if ( pageY() > (slideH*7.5) ) {
      $('#sld9').addClass('active');
    }

    if ( pageY() > ( slideH * 8 ) ) {
      scrollD.css('opacity', 0);
    } else {
      scrollD.css('opacity', 1);
    }

    scrollD.css('bottom', ( -pageY() + 30 ) );


  });

  $("a#fb-login-check-in").click(function(){
    window.parent.location.onFbInit();
  });

})
