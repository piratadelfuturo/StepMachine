$(document).ready(function(){

  //Side scrolling
  $(function pageMove() {
    $("html, body").mousewheel(function(event, delta) {
      this.scrollLeft -= (delta * 5);
      event.preventDefault();
    });
  });

  var isfirst = parseInt("0");
  var gvballoon = parseInt("0");
  var pageX = function(){
    return $(window).scrollLeft();
  }

  var init = function(){

    var slidesPos2 = [
      [0, 500, 1000, 1500, 2600],
      [3000, 3500, 4700],
      [5000, 5700],
      [6000, 6500],
      [7000, 7500, 8000, 8500],
      [9000, 9300, 9600, 10000],
      [10300, 10600, 10900]
    ],
    current = function( direction, dimension ){

      /*
       * s: slide
       * p: position
       * */
      if ( direction == 'right' ) {

        $('#dude, #dude2').removeClass('mirror');

        for (var s = 0; s < slidesPos2.length; s++) {
          for (var p = 0; p < slidesPos2[s].length; p++) {

            if(slidesPos2[s][p] > pageX()) {
              if ( dimension == 'position' ) {
                return p;
              }
              if ( dimension == 'slide' ) {
                return s;
              }
            }
          };
        };

      } else { /* direction == 'left' */

        $('#dude, #dude2').addClass('mirror');

        for (var s = slidesPos2.length; s-- > 0;) {
          for (var p = slidesPos2[s].length; p-- > 0;) {

            if(slidesPos2[s][p] < pageX()) {

              if ( dimension == 'position' ) {
                return p;
              }

              if ( dimension == 'slide' ) {
                return s;
              }

            }

          }
        }

      }
      return 0;
    },
    animation = function( direction ){
      var position = current( direction, 'position' ),
          slide = current( direction, 'slide' );

      //console.log("slide: " + slide);
      //console.log("position:" + position);

      if ( typeof( slidesPos2[slide][position] ) === "number" ) {
        $('body').stop(true, false).animate({
          scrollLeft: slidesPos2[slide][position]
        }, 3000,
        function(){
          setTimeout(
            function() {
              if (
                (typeof(slidesPos2[slide][position+1]) === "number" && direction == 'right') ||
                (typeof(slidesPos2[slide][position-1]) === "number" && direction == 'left')
              ) {
                animation( direction );
              }
            }, 1000
          )
        }
      );
      }
    };

    $('body').keyup(function(e) {

      var direction = {
        37: 'left',
        39: 'right'
      };

      //console.log(typeof(direction[e.which]));

      if ( typeof(direction[e.which]) === "string" ) {
        //console.log(e.which);
        animation( direction[e.which] );
      }

    });

    $('nav .nav-btn').click(function(){

      var direction = $(this).data('direction');

      animation( direction );

    });

  };

  init();

  //$('.bloque').addClass('hide');
  //$('.numero').addClass('hide');

  var scrollTimeout = null;
  var scrollendDelay = 100;

  function scrollbeginHandler() {
    $('body').addClass('is-scrolling');
  }

  function scrollendHandler() {
    $('body').removeClass('is-scrolling');
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

    console.log(pageX());

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
      $('#txt1 .numero, #txt1 .uno').addClass('is-showing');
      $('#txt1 .dos').removeClass('is-showing');
    };

    if ( pageX() >= 500 ){
      $('#txt1 .uno, #txt1 .tres').removeClass('is-showing');
      $('#txt1 .dos').addClass('is-showing');
    };

    if ( pageX() >= 1000 ){
      $('#txt1 .tres').addClass('is-showing');
      $('#txt1 .cuatro, #txt1 .dos').removeClass('is-showing');
    };

    if ( pageX() >= 1500 ){
      $('#txt1 .tres').removeClass('is-showing');
      $('#txt1 .cuatro').addClass('is-showing');
    };

    if ( pageX() >= 2000 ){
      $('#txt2 .uno, #txt2 .numero, #txt1 .numero, #txt1 .cuatro').removeClass('is-showing');
    };

    if ( pageX() >= 2500 ){
      $('#txt2 .numero, #txt2 .uno').addClass('is-showing');
      $('#txt2 .dos').removeClass('is-showing');
    };

    if ( pageX() >= 3000 ){
      $('#txt2 .uno, #txt2 .tres').removeClass('is-showing');
      $('#txt2 .dos').addClass('is-showing');
    };

    if ( pageX() >= 3500 ){
      $('#txt2 .dos').removeClass('is-showing');
      $('#txt2 .tres').addClass('is-showing');
    };

    if ( pageX() >= 4000 ){
      $('#txt2 .tres, #txt2 .numero, #txt3 .uno, #txt3 .numero').removeClass('is-showing');
    };

    if ( pageX() >= 4500 ){
      $('#txt3 .numero, #txt3 .uno').addClass('is-showing');
      $('#txt3 .dos').removeClass('is-showing');
    };

    if ( pageX() >= 5000 ){
      $('#txt3 .uno, #txt4 .uno, #txt4 .numero').removeClass('is-showing');
      $('#txt3 .dos').addClass('is-showing');
    };

    if ( pageX() >= 5700 ){
      $('#txt4 .numero, #txt4 .uno').addClass('is-showing');
      $('#txt4 .dos, #txt3 .dos, #txt3 .tres, #txt3 .numero').removeClass('is-showing');
    };

    if ( pageX() >= 6000 ){
      $('#txt4 .uno, #txt5 .uno, #txt5 .numero').removeClass('is-showing');
      $('#txt4 .dos').addClass('is-showing');
    };

    if ( pageX() >= 6500 ){
      $('#txt4 .dos, #txt4 .numero, #txt5 .dos').removeClass('is-showing');
      $('#txt5 .numero, #txt5 .uno').addClass('is-showing');
    };

    if ( pageX() >= 7000 ){
      $('#txt5 .uno, #txt5 .tres').removeClass('is-showing');
      $('#txt5 .dos').addClass('is-showing');
    };

    if ( pageX() >= 7500 ){
      $('#txt5 .tres').addClass('is-showing');
      $('#txt5 .cuatro, #txt5 .dos').removeClass('is-showing');
    };

    if ( pageX() >= 8000 ){
      $('#txt5 .dos, #txt5 .tres, #txt6 .numero, #txt6 .uno').removeClass('is-showing');
      $('#txt5 .cuatro').addClass('is-showing');
    };

    if ( pageX() >= 8500 ){
      $('#txt5 .numero, #txt5 .cuatro, #txt5 .tres, #txt6 .dos').removeClass('is-showing');
      $('#txt6 .numero, #txt6 .uno').addClass('is-showing');
    };

    if ( pageX() >= 9000 ){
      $('#txt6 .dos').addClass('is-showing');
      $('#txt6 .tres, #txt6 .uno, #txt6 .cuatro').removeClass('is-showing');
    };

    if ( pageX() >= 9300 ){
      $('#txt6 .tres').addClass('is-showing');
      $('#txt6 .cuatro, #txt6 .dos').removeClass('is-showing');
    };

    if ( pageX() >= 9600 ){
      $('#txt6 .tres').removeClass('is-showing').delay(5600).queue(function(next){
        $('#txt6 .cuatro').addClass('is-showing');
      });
    };

    if ( pageX() >= 9800 ){
      $('#txt6 .numero, #txt6 .cuatro, #txt7 .numero, #txt7 .uno, #txt7 .dos, #txt7 .tres').removeClass('is-showing');
    };

    if ( pageX() >= 10200 ){
      $('#txt7 .numero, #txt7 .uno').addClass('is-showing');
    };

    if ( pageX() >= 10600 ){
      $('#txt7 .numero, #txt7 .dos').addClass('is-showing');
      $('#txt7 .uno').removeClass('is-showing');
      $('#social').removeClass('hidden').addClass('appear');
      if(gvballoon == 2){
        $('#dude2 .b-left').addClass('feliz');
        gvballoon = 3;
      }
    };

    if ( pageX() >= 10700 ){
      $('#txt7 .dos').removeClass('is-showing');
      $('#txt7 .tres').addClass('is-showing');
      setTimeout( function() {
        $('#share').removeClass('hide');
      }, 600 );
    };

    //triggers animaciones escena 3

    if ( pageX() >= 4500 ){
      if (gvballoon == 0 ) {
        $('.dude-brazos .b-left').addClass('feliz');
        $('#globo').removeClass('hidden').addClass('appear');
        gvballoon = 1;
      }
    }
    if ( pageX() >= 4800){
      $('#morro .face1, #morro .b2-left, #morro .b2-right, #morro .face3').removeClass('show').addClass('hide');
      $('#morro .face2, #morro .b-left, #morro .b-right').removeClass('hide').addClass('show');
    }
    if ( pageX() >= 4950 ){
      $('#morro .morro-brazos, #morro .morro-piernas').addClass('feliz');
      $('#ruido, #nube').removeClass('show').addClass('hide');
      if(gvballoon == 1) {
        $('.dude-brazos .b-left').removeClass('feliz');
        $('#morro .face2').removeClass('show').addClass('hide');
        $('#morro .face3').removeClass('hide').addClass('show');
        $('#globo').removeClass('appear').addClass('static');
        gvballoon = 2;
      }
    };
    if ( pageX() >= 6000 ){
      $('#morra1, #morra2, #alien').addClass('feliz');
    };
    if ( pageX() >= 9000 ){
      $('#dude').css('left', (pageX() + 300) + 'px' ).addClass('jump');
      $('#dude .dude-gorra').removeClass('show').addClass('hide');
    };
    if ( pageX() >= 9150 ){
      $('#dude .dude-casco').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 9250 ){
      $('#dude').removeClass('jump');
      $('#cohete #cohete-bubble').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 9250 ){
      $('#dude').hide(0);
    };

    if ( pageX() >= 9500){
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

  });

});
