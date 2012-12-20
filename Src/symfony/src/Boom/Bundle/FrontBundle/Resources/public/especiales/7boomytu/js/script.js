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

  //función de keypress
  $("html, body").keydown(function(e) {
    if(e.keyCode == 37) {

      console.log('Izquierda');
      var direction = 'l';
      event.preventDefault();

      return $.slideMove();

    }
    else if(e.keyCode == 39) {

      console.log('Derecha');
      var direction = 'r';
      event.preventDefault();

      return $.slideMove();

    }
  });

  //Animación al teclear
  $.slideMove = function(direction){
    var slidesPos = {
      slide1:[0, 1400],
      slide2:[1400, 2800]
    };
    var len = slidesPos.length;

    for ( i in slidesPos ) {
      console.log(i);
      if ( pageX() >= slidesPos[i][0] && pageX() <= slidesPos[i][1] ) {
        console.log(slidesPos);
        $('html, body').stop(false, false).animate({
          scrollLeft: slidesPos[i][1]
        }, 7000);
      }
    }
  }

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

    //soon to be cool function
    /*var obj = {
      ani1:['#dude-banner', 1],
      ani2:['id_del_bloque_2', 780]
    };

    var length = $('.bloque').length() -1;

    for (i=0; i<length; i++){
      var blockPosition = scrollLeft - $('.bloque').eq(i).offset().left;

      if(blockPosition < 0 ){
        $('.bloque').eq(i).addClass('active');
      } 
    }*/

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
      $('#txt1 .numero, #txt1 .uno').removeClass('hide').addClass('show');
      $('#txt1 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 500 ){
      $('#txt1 .uno, #txt1 .tres').removeClass('show').addClass('hide');
      $('#txt1 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 1000 ){
      $('#txt1 .tres').removeClass('hide').addClass('show');
      $('#txt1 .cuatro, #txt1 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 1500 ){
      $('#txt1 .tres').removeClass('show').addClass('hide');
      $('#txt1 .cuatro').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 2000 ){
      $('#txt2 .uno, #txt2 .numero, #txt1 .numero, #txt1 .cuatro').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 2500 ){
      $('#txt2 .numero, #txt2 .uno').removeClass('hide').addClass('show');
      $('#txt2 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 3000 ){
      $('#txt2 .uno, #txt2 .tres').removeClass('show').addClass('hide');
      $('#txt2 .dos').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 3500 ){
      $('#txt2 .dos').removeClass('show').addClass('hide');
      $('#txt2 .tres').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 4000 ){
      $('#txt2 .tres, #txt2 .numero, #txt3 .uno, #txt3 .numero').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 4500 ){
      $('#txt3 .numero, #txt3 .uno').removeClass('hide').addClass('show');
      $('#txt3 .dos, #txt3 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 5000 ){
      $('#txt3 .uno, #txt4 .uno, #txt4 .numero').removeClass('show').addClass('hide');
      $('#txt3 .dos, #txt3 .tres').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 5500 ){
      $('#txt4 .numero, #txt4 .uno').removeClass('hide').addClass('show');
      $('#txt4 .dos, #txt3 .dos, #txt3 .tres, #txt3 .numero, #txt4 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 6000 ){
      $('#txt4 .uno, #txt5 .uno, #txt5 .numero').removeClass('show').addClass('hide');
      $('#txt4 .dos, #txt4 .tres').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 6500 ){
      $('#txt4 .dos, #txt4 .tres, #txt4 .numero, #txt5 .dos').removeClass('show').addClass('hide');
      $('#txt5 .numero, #txt5 .uno').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 7000 ){
      $('#txt5 .uno, #txt5 .tres').removeClass('show').addClass('hide');
      $('#txt5 .dos').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 7500 ){
      $('#txt5 .tres').removeClass('hide').addClass('show');
      $('#txt5 .cuatro').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 8000 ){
      $('#txt5 .dos, #txt5 .tres, #txt6 .numero, #txt6 .uno').removeClass('show').addClass('hide');
      $('#txt5 .cuatro').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 8500 ){
      $('#txt5 .numero, #txt5 .cuatro, #txt5 .tres, #txt6 .dos').removeClass('show').addClass('hide');
      $('#txt6 .numero, #txt6 .uno').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 8600 ){
      $('#txt6 .dos').removeClass('hide').addClass('show');
      $('#txt6 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 8800 ){
      $('#txt6 .tres').removeClass('hide').addClass('show');
      $('#txt6 .dos, #txt6 .uno, #txt6 .cuatro').removeClass('show').addClass('hide');
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
      $('#txt6 .numero, #txt6 .cinco, #txt7 .numero, #txt7 .uno, #txt7 .dos, #txt7 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 10700 ){
      $('#txt7 .numero, #txt7 .uno').removeClass('hide').addClass('show');
    };

    //triggers animaciones escena 3

    if ( pageX() >= 4800 ){
      $('#nube').removeClass('hide').addClass('show');
      };
    if ( pageX() >= 4850 ){
        $('#ruido').removeClass('hide').addClass('show');
      }; 
    if ( pageX() >= 4990 ){
        $('#ruido, #nube').removeClass('show').addClass('hide');
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
