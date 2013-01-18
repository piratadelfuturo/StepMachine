$(document).ready(function(){

  //Side scrolling
  $(function() {
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
  /* {{{ NO SE USA AHORA.
  //función de keypress
  /*
  $("html, body").keydown(function(e) {
    if(e.which == 37) {

      var direction = 'l';
      event.preventDefault();

      return $.slideMove();

    }
    else if(e.which == 39) {

      var direction = 'r';
      event.preventDefault();

      return $.slideMove();

    }
  });
  */

  //Animación al teclear
  /*
  $.slideMove = function(direction){
    var slidesPos = {
      //Slide1
      slide1:[0, 500],
      slide2:[500, 1000],
      slide3:[1000, 1500],
      slide4:[1500, 2600],
      slide5:[2600, 3000],
      //Slide2
      slide6:[3000, 3500],
      slide7:[3500, 4700],
      //Slide3
      slide8:[4700, 5000],
      slide9:[5000, 5700],
      //Slide4
      slide10:[5700, 6000],
      slide11:[6000, 6500],
      //Slide5
      slide12:[6500, 7000],
      slide13:[7000, 7500],
      slide14:[7500, 8000],
      slide15:[8000, 8500],
      //Slide6
      slide16:[8500, 9000],
      slide17:[9000, 9300],
      slide19:[9300, 9500],
      slide20:[9500, 10000],
      //Slide7
      slide21:[10000, 10100]
    };
    for ( i in slidesPos ) {
      if ( pageX() >= slidesPos[i][0] && pageX() <= slidesPos[i][1] ) {
        $('html, body').stop(false, false).animate({
          scrollLeft: slidesPos[i][1]
        }, 3000);
      }
    }
  }
  }}} */
  var init = function(){

    /* {{{ lol así no era
    var slidesPos2 = [
      0, 500, 1000, 1500, 2600, 3000,
      3500, 4700, 5000, 5700,
      6000, 6500, 7000, 7500, 8000, 8500,
      9000, 9300, 9500, 10000, 11000
    ];

    var animation = function( order ){
      $('html, body').stop(true, true).animate({
        scrollLeft: slidesPos2[order]
      }, 3000);
    };

    $('body').keyup(function(e){
      var position = pageX(),
          current = 0;

      for (var i = 0; i < slidesPos2.length; i++) {

        if ( e.which == 39 ) {
          //adelante

          if ( slidesPos2[i] > pageX() ) {
            animation(i);
            break;
          }

        }

      };

      for (var i = slidesPos2.length; i >= 0 ; i--) {

        if ( e.which == 37 ) {
          //atras

          if ( slidesPos2[i] < pageX() ) {
            animation(i);
            break;
          }

        }

      };

    });
    }}} */

    var slidesPos2 = [
      [0, 500, 1000, 1500, 2600],
      [3000, 3500, 4700],
      [5000, 5700],
      [6000, 6500],
      [7000, 7500, 8000, 8500],
      [9000, 9300, 9500, 10000],
      [10300, 10600, 10900]
    ],
    current = function( direction, dimension ){

      /*
       * s: slide
       * p: position
       * */
      if ( direction == 'right' ) {
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
  };

  init();

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
      $('#txt1 .numero, #txt1 .uno').removeClass('hide').addClass('show');
      $('#txt1 .dos').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 500 ){
      $('#txt1 .uno, #txt1 .tres').removeClass('show').addClass('hide');
      $('#txt1 .dos').removeClass('hide').addClass('show');
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

    if ( pageX() >= 5700 ){
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
      $('#txt5 .dos, #txt5 .tres, #txt6 .numero, #txt6 .uno, #txt6 .dos').removeClass('show').addClass('hide');
      $('#txt5 .cuatro').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 8500 ){
      $('#txt5 .numero, #txt5 .cuatro, #txt5 .tres, #txt6 .tres').removeClass('show').addClass('hide');
      $('#txt6 .numero, #txt6 .uno, #txt6 .dos').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 9000 ){
      $('#txt6 .tres').removeClass('hide').addClass('show');
      $('#txt6 .dos, #txt6 .uno, #txt6 .cuatro').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 9300 ){
      $('#txt6 .cuatro').removeClass('hide').addClass('show');
      $('#txt6 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 9500 ){
      $(window).unbind('scroll');
      $('#txt6 .cuatro').removeClass('show').addClass('hide').delay(5600).queue(function(next){
        $('#txt6 .cinco').removeClass('hide').addClass('show');
      });
    };

    if ( pageX() >= 9800 ){
      $(window).bind('scroll');
      $('#txt6 .numero, #txt6 .cinco, #txt7 .numero, #txt7 .uno, #txt7 .dos, #txt7 .tres').removeClass('show').addClass('hide');
    };

    if ( pageX() >= 10200 ){
      $('#txt7 .numero, #txt7 .uno').removeClass('hide').addClass('show');
    };

    if ( pageX() >= 10600 ){
      $('#txt7 .numero, #txt7 .dos').removeClass('hide').addClass('show');
      $('#txt7 .uno').removeClass('show').addClass('hide');
      $('#social').removeClass('hidden').addClass('appear');
      if(gvballoon == 2){
        $('#dude2 .b-left').addClass('feliz');
        gvballoon = 3;
      }
    };

    if ( pageX() >= 10700 ){
      $('#txt7 .dos').removeClass('show').addClass('hide');
      $('#txt7 .tres').removeClass('hide').addClass('show');
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
      $('#morro .face1, #morro .b2-left, #morro .b2-right, #morro .face3').removeClass('show').addClass('hide');
      $('#morro .face2, #morro .b-left, #morro .b-right').removeClass('hide').addClass('show');
    }

    if ( pageX() >= 5000 ){
      $('#morro .morro-brazos, #morro .morro-piernas').addClass('feliz');
      $('#ruido, #nube').removeClass('show').addClass('hide');
      $('#morro .face2').removeClass('show').addClass('hide');
      $('#morro .face3').removeClass('hide').addClass('show');
      if(gvballoon == 1) {
        $('.dude-brazos .b-left').removeClass('feliz');
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
