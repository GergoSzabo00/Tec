$(document).ready(function() {
    $('#sidebarToggler').on('click', function(e) 
    {
      $('.sidebar').toggleClass('sidebar-toggle');
    });

    $(window).resize(function() 
    {
      if ($(window).width() < 768) {
        $('.sidebar .collapse').collapse('hide');
      }

      $('.sidebar').removeClass('sidebar-toggle');

    });
    
});
