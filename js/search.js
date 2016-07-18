$(document).ready(function() {
    $('#date-from').on('click', function() {
        console.log(this);
        $(this).datepicker();
    });
    $('#date-to').on('click', function() {
        console.log(this);
        $(this).datepicker();
    });
    $('.bookbtn').on('click', function(e){
      e.preventDefault();
      window.location.href = "http://staycation.applikable.co/hotels?location=" + $('#locationSearch').val() + "&checkin=" + $('#date-from').val() + "&checkout=" + $('#date-to').val();
    })
});
