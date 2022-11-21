 $(function () {
  
   $( "#event_date" ).datepicker();

   $('input[name="event_location"]').change(function () {
    console.log($('#event_abroad').prop('checked'));
    if ($('#event_abroad').prop('checked')) {
      $('#event_abroad_title').show();
    } else {
      $('#event_abroad_title').hide();
    }
    
  });
 });
