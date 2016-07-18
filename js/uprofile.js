/**
 * Created by cristopher on 30-05-2016.
 */
$(document).ready(function() {

    switch (window.location.pathname) {
        //case "/user-profile":
        //    $("#user-name").addClass("active");
        //    $("#hotels-name").removeClass("active");
        //    $("#book-name").removeClass("active");
        //    break;
        //case "/hotels":
        //    $("#hotels-name").addClass("active");
        //    $("#user-name").removeClass("active");
        //    $("#book-name").removeClass("active");
        //    break;
        //case "/book":
        //    $("#book-name").addClass("active");
        //    $("#user-name").removeClass("active");
        //    $("#hotels-name").removeClass("active");
        //    break;
        //case "/":
        //    $("#book-name").removeClass("active");
        //    $("#user-name").removeClass("active");
        //    $("#hotels-name").removeClass("active");
        //    break;
    }
    $('#menu_book').click(function(e) {
        e.preventDefault();
        window.location.href = document.origin + "/books";
    });
    $('#menu_hotels').click(function(e) {
        e.preventDefault();
        window.location.href = document.origin + "/hotels";
    });
    $('#menu_south').click(function(e) {
        e.preventDefault();
        //window.location.href = window.location.pathname +"/hotels";
    });
    $('#menu_events').click(function(e) {
        e.preventDefault();
        window.location.href = document.origin + "/events";
    });
    $('#user-name').click(function(e) {
        e.preventDefault();
        window.location.href = document.origin + "/user-profile";
    });

    $(document).on('click', '.details_reservation', function(e) {
        e.preventDefault();
        console.log('details_reservation');
        $('#hotel-id').val($(this).data('id'));
        $('.hotel-details').submit();
    });
    $(document).on('click', '.details_favorites', function(e) {
        e.preventDefault();
        console.log('details_favorites');
        $('#hotel-id').val($(this).data('id'));
        $('.hotel-details').submit();
    });
    $(document).on('click', '.status', function(e) {
        e.preventDefault();
        console.log('status ' + $(this).data('id'));
        switch ($(this).data('id')) {
            case "All":
                $('.status_booking:contains(booking)').show();
                break;
            case "Current":
                {
                    $('.status_booking:not(:contains(booking_4))').hide();
                    $('.status_booking:contains(booking_4)').show();
                    break;
                }
            case "Cancelled":
                {
                    $('.status_booking:not(:contains(booking_2))').hide();
                    $('.status_booking:contains(booking_2)').show();
                    break;
                }
            case "Past":
                {
                    //s
                    break;
                }
        }
    });
    $(document).on('click', '.preference', function(e) {
        //e.preventDefault();
        console.log($(this));
        console.log($(this).is(':checked'));
        if ($(this).is(':checked'))
            $(this).prop('checked', true);
        else
            $(this).prop('checked', false);
        id_preferences = $(this).data('id');
        console.log(id_preferences);
        console.log($('#id_user').val());
        $.ajax({
            type: "POST",
            url: "/templates/staycation/common/preference.php",
            datatype: "text",
            data: {
                user: $('#id_user').val(),
                preference: id_preferences
            },
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });

    });

    $('.edit-profile').on('click', function(e) {
        e.preventDefault();
    });
    $('#edit-continue').on('click', function(e) {
        e.preventDefault();
        //var photo = new FormData();
        //jQuery.each(jQuery('#photo')[0].files, function(i, file) {
        //    photo.append('file-' + i, file);
        //});
        //console.log(photo);
        var form = $('#form-edit')[0]; // You need to use standart javascript object here
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "/templates/staycation/common/edit-profile.php",
            data: formData,
            async: false,
            success: function(data) {
                console.log('pass');
                console.log(data);
            },
            error: function(data) {
                console.log('not pass');
                console.log(data);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // $.ajax({
        //     type: "POST",
        //     url: "/templates/staycation/common/edit-profile.php",
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     data: photo,
        //     success: function(data) {
        //       console.log('pass photo');
        //       console.log(data);
        //     },
        //     error: function(data) {
        //       console.log('not pass photo');
        //       console.log(data);
        //     }
        // });
    });
});
