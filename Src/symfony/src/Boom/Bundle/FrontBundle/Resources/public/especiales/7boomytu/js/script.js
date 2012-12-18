$(document).ready(function(){

  //Side scrolling
  $(function() {
    $("html, body").mousewheel(function(event, delta) {
      this.scrollLeft -= (delta * 30);
      event.preventDefault();
    });
  });

  var isfirst = parseInt("0");
  var pageX = function(){
    return $(window).scrollLeft();
  }

  $("body").keydown(function(e) {
    if(e.keyCode == 37) {
      console.log('Izquierda');
    }
    else if(e.keyCode == 39) {
      console.log('Derecha');
    }
  });

  $('.bloque').addClass('hide');
  $('.numero').addClass('hide');

  var scrollTimeout = null;
  var scrollendDelay = 100;

  function scrollbeginHandler() {
    $('.dude-piernas').addClass('walk');
  }

  function scrollendHandler() {
    $('.dude-piernas').removeClass('walk');
  	scrollTimeout = null;
  }

  $(function() {
    $(window).scroll(function() {
      if ( scrollTimeout === null ) {
        scrollbeginHandler();
      }else{
        clearTimeout( scrollTimeout );
      }
      scrollTimeout = setTimeout( scrollendHandler, scrollendDelay );
    });
  });

  $(window).scroll(function(){

    //tirar geocities
    if ( pageX() >= 1 ) {
      $('#dude-banner').addClass('jump');
      $('#geocities').addClass('hideGC').delay(2800).hide(0);
      $('#dude').removeClass('fall');
    }
    else {
      $('#geocities').removeClass('hideGC').delay(2800).show(0);
    };


    //triggers texto
    if ( pageX() >= 0 ){
      $('#txt1 .numero').removeClass('hide').addClass('show');
      $('#txt1 .uno').removeClass('hide').addClass('show');
      $('#txt1 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 500 ){
      $('#txt1 .uno').removeClass('show').addClass('hide');
      $('#txt1 .dos').removeClass('hide').addClass('show');
      $('#txt1 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 1000 ){
      $('#txt1 .dos').removeClass('show').addClass('hide');
      $('#txt1 .tres').removeClass('hide').addClass('show');
      $('#txt1 .cuatro').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 1500 ){
      $('#txt1 .tres').removeClass('show').addClass('hide');
      $('#txt1 .cuatro').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 2000 ){
      $('#txt1 .cuatro').removeClass('show').addClass('hide');
      $('#txt1 .numero').removeClass('show').addClass('hide');
      $('#txt2 .numero').removeClass('show').addClass('hide');
      $('#txt2 .uno').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 2500 ){
      $('#txt2 .numero').removeClass('hide').addClass('show');
      $('#txt2 .uno').removeClass('hide').addClass('show');
      $('#txt2 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 3000 ){
      $('#txt2 .uno').removeClass('show').addClass('hide');
      $('#txt2 .dos').removeClass('hide').addClass('show');
      $('#txt2 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 3500 ){
      $('#txt2 .dos').removeClass('show').addClass('hide');
      $('#txt2 .tres').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 4000 ){
      $('#txt2 .tres').removeClass('show').addClass('hide');
      $('#txt2 .numero').removeClass('show').addClass('hide');
      $('#txt3 .uno').removeClass('show').addClass('hide');
      $('#txt3 .numero').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 4500 ){
      $('#txt3 .numero').removeClass('hide').addClass('show');
      $('#txt3 .uno').removeClass('hide').addClass('show')
      $('#txt3 .dos').removeClass('show').addClass('hide');
      $('#txt3 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 5000 ){
      $('#txt3 .uno').removeClass('show').addClass('hide');
      $('#txt3 .dos').removeClass('hide').addClass('show');
      $('#txt3 .tres').removeClass('hide').addClass('show');
      $('#txt4 .uno').removeClass('show').addClass('hide');
      $('#txt4 .numero').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 5500 ){
      $('#txt4 .numero').removeClass('hide').addClass('show');
      $('#txt4 .uno').removeClass('hide').addClass('show');
      $('#txt4 .dos').removeClass('show').addClass('hide');
      $('#txt3 .dos').removeClass('show').addClass('hide');
      $('#txt3 .tres').removeClass('show').addClass('hide');
      $('#txt3 .numero').removeClass('show').addClass('hide');
      $('#txt4 .tres').removeClass('show').addClass('hide');

    };

    if ( pageX() >= 6000 ){
      $('#txt4 .uno').removeClass('show').addClass('hide');
      $('#txt4 .dos').removeClass('hide').addClass('show');
      $('#txt4 .tres').removeClass('hide').addClass('show');
      $('#txt5 .uno').removeClass('show').addClass('hide');
      $('#txt5 .numero').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 6500 ){
      $('#txt4 .dos').removeClass('show').addClass('hide');
      $('#txt4 .tres').removeClass('show').addClass('hide');
      $('#txt4 .numero').removeClass('show').addClass('hide');
      $('#txt5 .numero').removeClass('hide').addClass('show');
      $('#txt5 .uno').removeClass('hide').addClass('show');
      $('#txt5 .dos').removeClass('show').addClass('hide');
      
    };

    if ( pageX() >= 7000 ){
      $('#txt5 .uno').removeClass('show').addClass('hide');
      $('#txt5 .dos').removeClass('hide').addClass('show');
      $('#txt5 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 7500 ){
      $('#txt5 .tres').removeClass('hide').addClass('show');
      $('#txt5 .cuatro').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 8000 ){
      $('#txt5 .dos').removeClass('show').addClass('hide');
      $('#txt5 .tres').removeClass('show').addClass('hide');
      $('#txt5 .cuatro').removeClass('hide').addClass('show');
      $('#txt6 .numero').removeClass('show').addClass('hide');
      $('#txt6 .uno').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 8500 ){
      $('#txt5 .numero').removeClass('show').addClass('hide');
      $('#txt5 .cuatro').removeClass('show').addClass('hide');
      $('#txt5 .tres').removeClass('show').addClass('hide');
      $('#txt6 .numero').removeClass('hide').addClass('show');
      $('#txt6 .uno').removeClass('hide').addClass('show');
      $('#txt6 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 8600 ){
      $('#txt6 .dos').removeClass('hide').addClass('show');
      $('#txt6 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 8800 ){
      $('#txt6 .tres').removeClass('hide').addClass('show');
      $('#txt6 .dos').removeClass('show').addClass('hide');
      $('#txt6 .uno').removeClass('show').addClass('hide');
      $('#txt6 .cuatro').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 9100 ){
      $('#txt6 .cuatro').removeClass('hide').addClass('show');
      $('#txt6 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 9350 ){
      $('#txt6 .cuatro').removeClass('show').addClass('hide').delay(5600).queue(function(next){
        $('#txt6 .cinco').removeClass('hide').addClass('show');
      });
    };

    if ( pageX() >= 9800 ){
      $('#txt6 .numero').removeClass('show').addClass('hide');
      $('#txt6 .cinco').removeClass('show').addClass('hide');
      $('#txt7 .numero').removeClass('show').addClass('hide');
      $('#txt7 .uno').removeClass('show').addClass('hide');
      $('#txt7 .dos').removeClass('show').addClass('hide');
      $('#txt7 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 10700 ){
      $('#txt7 .numero').removeClass('hide').addClass('show');
      $('#txt7 .uno').removeClass('hide').addClass('show');
    };

    //triggers animaciones escena 3

    if ( pageX() >= 4800 ){
      $('#nube').removeClass('hide').addClass('show');
      };
    if ( pageX() >= 4850 ){
        $('#ruido').removeClass('hide').addClass('show');
      }; 
    if ( pageX() >= 4990 ){
        $('#ruido').removeClass('show').addClass('hide');
        $('#nube').removeClass('show').addClass('hide');
      };  
    if ( pageX() >= 4900 ){
      $('.dude-brazos .b-left').addClass('feliz');
      };
    if ( pageX() >= 4950 ){
      $('#morro .face1, #morro .b2-left, #morro .b2-right, #morro .face3').removeClass('show').addClass('hide');
      $('#morro .face2, #morro .b-left, #morro .b-right').removeClass('hide').addClass('show');
      };
    if ( pageX() >= 5000 ){ 
      $('.dude-brazos .b-left').removeClass('feliz');
      $('#morro .morro-brazos, #morro .morro-piernas').addClass('feliz');
      $('#morro .face2').removeClass('show').addClass('hide');
      $('#morro .face3').removeClass('hide').addClass('show');
    };
    if ( pageX() >= 6000 ){ 
      $('#morra1, #morra2, #alien').addClass('feliz');
    };
    if ( pageX() >= 8500 ){ 
      $('#dude').css('left', (pageX() + 300) + 'px' ).addClass('jump');
      $('#dude .dude-gorra').removeClass('show').addClass('hide');
    };
    if ( pageX() >= 8850 ){ 
      $('#dude .dude-casco').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 9100 ){ 
      $('#dude').removeClass('jump');
      $('#cohete #cohete-bubble').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 9100 ){ 
      $('#dude').hide(0);
    };

    if ( pageX() >= 9350){ 
      if(isfirst == 0){
        $('#cohete').addClass('volar').delay(3000).queue(function(next){
            $(this).hide(0);
            next();
        });
        $('#slide-fondo').addClass('alinfinito');

        $('#dude2').delay(3800).queue(function(next){
            $(this).removeClass('fall').addClass('feliz');
            next();
        });
        $('#dude2').delay(2000).queue(function(next){
            $(this).removeClass('feliz').stop();
            next();
        });
        $('#dude2 .dude-parachute').removeClass('hide').addClass('show').delay(5600).queue(function(next){
          $(this).removeClass('show').addClass('hide').stop();
        });
	isfirst = 1;
      }

    };

    if ( pageX() >= 11000 ){
      $('#txt7 .uno').removeClass('show').addClass('hide');
      $('#txt7 .dos, #txt7 .tres').removeClass('hide').addClass('show');
      $('#dude2 .b-left').addClass('feliz');
      $('#social').removeClass('hidden').addClass('appear');
    };

  });

});
