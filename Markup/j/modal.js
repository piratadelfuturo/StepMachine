$(document).ready(function() { 
  $.blockUI.defaults.css = {
    top:  ($(window).height() - 600 ) /2 + 'px',
    left: ($(window).width() - 566) /2 + 'px',
    cursor:'default'
  };
  $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
  $('.cls-btn').attr('title','Cerrar').click(function(){
    $.unblockUI();
    return false;
  });
  $('#login-1').click(function() { 
      $.blockUI({ 
        message: $('#login-info')
      });
  });
  $('#saved-boom').click(function() { 
      $.blockUI({ 
        message: $('#boom-saved')
      });
  });
  $('#login-2').click(function() { 
      $.blockUI({ 
        message: $('#login-info2')
      });
      return false;
  });
  $('#socialshare').click(function() { 
      $.blockUI({ 
        message: $('#social-share')
      });
  });

}); 
