(function($) {
  $( function() {
    $( ".datepicker-ui" ).datepicker({
      dateFormat: "MM dd, yy",
      defaultDate: +1,
      minDate: 1
    }).attr('readonly','readonly');
  } );
})(jQuery);
