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

    $(document).on('click', 'input:checkbox', function(e)
    {
        var numOfSelected = $('input:checkbox[name=ids]:checked').length;
        if(numOfSelected > 0)
        {
          $('#deleteSelected').removeAttr('disabled');
          $('#deleteSelected').attr('aria-disabled', false);
          $('#deleteSelected').removeClass('disabled');
        }
        else
        {
          $('#deleteSelected').attr('disabled');
          $('#deleteSelected').attr('aria-disabled', true);
          $('#deleteSelected').addClass('disabled');
        }
    });

    $('#checkAll').on('click', function(e)
    {
        $('input:checkbox[name=ids]').prop('checked', this.checked);
    });

    $('[data-bs-tooltip="tooltip"]').tooltip();
});
