$(document).ready(function(){

  var pageX = function(){
    return $(window).scrollLeft();
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
    
    //tirar geocities
    if ( pageX() >= 1 ) {
      $('#dude-banner').addClass('jump');
      $('#geocities').addClass('hideGC').delay(2800).hide(0);
      $('#dude').removeClass('fall');
    }
    else {
      $('#geocities').removeClass('hideGC').delay(2800).show(0);
    };
    
    //agregar left a texto y a dude
    $('#txt-wrapper').css('left', (pageX() + 280) + 'px');
    $('#dude').css('left', (pageX() + 350) + 'px');
    
    //triggers texto
    if ( pageX() >= 400 ){
      $('#txt1 .numero').removeClass('hide').addClass('show');
      $('#txt1 .uno').removeClass('hide').addClass('show');
      $('#txt1 .dos').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 800 ){
      $('#txt1 .uno').removeClass('show').addClass('hide');
      $('#txt1 .dos').removeClass('hide').addClass('show');
      $('#txt1 .tres').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 1100 ){
      $('#txt1 .dos').removeClass('show').addClass('hide');
      $('#txt1 .tres').removeClass('hide').addClass('show');
      $('#txt1 .cuatro').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 1500 ){
      $('#txt1 .tres').removeClass('show').addClass('hide');
      $('#txt1 .cuatro').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 1800 ){
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
    
    if ( pageX() >= 2800 ){
      $('#txt2 .uno').removeClass('show').addClass('hide');
      $('#txt2 .dos').removeClass('hide').addClass('show');
      $('#txt2 .tres').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 3400 ){
      $('#txt2 .dos').removeClass('show').addClass('hide');
      $('#txt2 .tres').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 3800 ){
      $('#txt2 .tres').removeClass('show').addClass('hide');
      $('#txt2 .numero').removeClass('show').addClass('hide');
      $('#txt3 .uno').removeClass('show').addClass('hide');
      $('#txt3 .numero').removeClass('show').addClass('hide');
    };    
    
    if ( pageX() >= 4600 ){
      $('#txt3 .numero').removeClass('hide').addClass('show');
      $('#txt3 .uno').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 4750 ){
      $('#txt3 .dos').removeClass('show').addClass('hide');
      $('#txt3 .uno').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 5000 ){
      $('#txt3 .dos').removeClass('hide').addClass('show');
      $('#txt3 .tres').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 5200 ){
      $('#txt3 .tres').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 5500 ){
      $('#txt3 .dos').removeClass('show').addClass('hide');
      $('#txt3 .tres').removeClass('show').addClass('hide');
      $('#txt3 .numero').removeClass('show').addClass('hide');
      $('#txt4 .uno').removeClass('show').addClass('hide');
      $('#txt4 .numero').removeClass('show').addClass('hide');
    }; 
    
    if ( pageX() >= 5700 ){
      $('#txt4 .numero').removeClass('hide').addClass('show');
      $('#txt4 .uno').removeClass('hide').addClass('show');
      $('#txt4 .dos').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 5900 ){
      $('#txt4 .uno').removeClass('show').addClass('hide');
      $('#txt4 .dos').removeClass('hide').addClass('show');
      $('#txt4 .tres').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 6100 ){
      $('#txt4 .tres').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 6800 ){
      $('#txt4 .dos').removeClass('show').addClass('hide');
      $('#txt4 .tres').removeClass('show').addClass('hide');
      $('#txt4 .numero').removeClass('show').addClass('hide');
      $('#txt5 .uno').removeClass('show').addClass('hide');
      $('#txt5 .numero').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 7000 ){
      $('#txt5 .numero').removeClass('hide').addClass('show');
      $('#txt5 .uno').removeClass('hide').addClass('show');
      $('#txt5 .dos').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 7300 ){
      $('#txt5 .uno').removeClass('show').addClass('hide');
      $('#txt5 .dos').removeClass('hide').addClass('show');
      $('#txt5 .tres').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 7500 ){
      $('#txt5 .tres').removeClass('hide').addClass('show');
      $('#txt5 .cuatro').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 7700 ){
      $('#txt5 .dos').removeClass('show').addClass('hide');
      $('#txt5 .tres').removeClass('show').addClass('hide');
      $('#txt5 .cuatro').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 8200 ){
      $('#txt5 .numero').removeClass('show').addClass('hide');
      $('#txt5 .cuatro').removeClass('show').addClass('hide');
      $('#txt5 .tres').removeClass('show').addClass('hide');
      $('#txt6 .numero').removeClass('show').addClass('hide');
      $('#txt6 .uno').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 8500 ){
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
    
    if ( pageX() >= 10000 ){
      $('#txt6 .cuatro').removeClass('show').addClass('hide');
      $('#txt6 .cinco').removeClass('show').addClass('hide');
    };
    
    if ( pageX() >= 10200 ){
      $('#txt6 .cinco').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 10500 ){
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
    
    if ( pageX() >= 10850 ){
      $('#txt7 .uno').removeClass('show').addClass('hide');
      $('#txt7 .dos').delay(1000).removeClass('hide').addClass('show');
      $('#txt7 .tres').delay(2000).removeClass('hide').addClass('show');
    };
    
    //triggers animaciones escena 3
    
    $('#globo').css('left', (pageX() + 400) + 'px');
    
    if ( pageX() >= 4800 ){
      $('#nube').removeClass('hide').addClass('show');
      };
    if ( pageX() >= 4850 ){
        $('#ruido').removeClass('hide').addClass('show');
        $('#globo').removeClass('show').addClass('hidden');
      }; 
    if ( pageX() >= 4990 ){
        $('#ruido').removeClass('show').addClass('hide');
        $('#nube').removeClass('show').addClass('hide');
      };  
    if ( pageX() >= 4900 ){
      $('#globo').removeClass('hidden').removeClass('give').addClass('appear');
      $('.dude-brazos .b-left').addClass('feliz');
      };
    if ( pageX() >= 4950 ){
      $('#globo').removeClass('appear');
      $('#morro .face1, #morro .b2-left, #morro .b2-right, #morro .face3').removeClass('show').addClass('hide');
      $('#morro .face2, #morro .b-left, #morro .b-right').removeClass('hide').addClass('show');
      };
    if ( pageX() >= 5000 ){ 
      $('#globo').addClass('give').css('left', '5590' + 'px');
      $('.dude-brazos .b-left').removeClass('feliz');
      $('#morro .morro-brazos, #morro .morro-piernas').addClass('feliz');
      $('#morro .face2').removeClass('show').addClass('hide');
      $('#morro .face3').removeClass('hide').addClass('show');
    };
    if ( pageX() >= 5010 ){ 
      $('#globo').removeClass('give').css('left', '5590' + 'px');
    };
    if ( pageX() >= 6000 ){ 
      $('#morra1, #morra2, #alien').addClass('feliz');
    };
    if ( pageX() >= 8800 ){ 
      $('#dude').addClass('jump');
      $('#dude .dude-gorra').removeClass('show').addClass('hide');
    };
    if ( pageX() >= 8850 ){ 
      $('#dude .dude-casco').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 9100 ){ 
      $('#dude').removeClass('jump');
      $('#cohete #cohete-bubble').removeClass('hide').addClass('show');
    };
    
    if ( pageX() >= 9100 && pageX() <= 9450 ){ 
      $('#dude').css('bottom', '1200'+'px').addClass('hide');
    };
    
    if ( pageX() >= 9350){ 
      $('#cohete').addClass('volar').delay(3000).queue(function(next){
          $(this).hide(0);
          next();
      });
      $('#slide-fondo').addClass('alinfinito');
      $('#dude').css('left', (pageX() + 500) + 'px');
      $('#dude').delay(3800).queue(function(next){
          $('#dude').removeClass('hide').addClass('show').addClass('feliz').css('bottom', '20' + 'px')
          next();
      });  
      $('#dude .dude-casco').removeClass('show').addClass('hide');
      $('#dude .dude-parachute').removeClass('hide').addClass('show');        
    };
    if ( pageX() >= 9750){
      $('#dude .dude-parachute').removeClass('show').addClass('hide');
      $('#dude').removeClass('feliz');   
    };
    
    
  });

  
  
});
