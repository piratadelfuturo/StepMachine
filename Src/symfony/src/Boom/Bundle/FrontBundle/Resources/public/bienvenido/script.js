$(document).ready(function(){

  window.setTimeout(function(){
    $('#sld1').addClass('active')
  }, 400);

  var pageY = function(){
    console.log($(window).scrollTop());
    return $(window).scrollTop();
  }


  $(window).scroll(function(){
    var slideH = 680;

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
    }

    if ( pageY() > (slideH*7.5) ) {
      $('#sld9').addClass('active');
    }

  });

})
