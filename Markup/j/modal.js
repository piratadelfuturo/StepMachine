$(document).ready(function() { 
  $.blockUI.defaults.css = {};
  $('#login-1').click(function() { 
      $.blockUI({ message: $('#login-info') });
      $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
  }); 
}); 
