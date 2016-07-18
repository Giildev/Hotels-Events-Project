$(document).on('ready', function() {
    $(document).on('click', '.like', function(e) {
        e.preventDefault();
        hotel_id = $(this).data('idhotel');
        user_id = $(this).data('iduser');
        likes = $(this).children().attr('value');
        console.log('hid = ' +hotel_id+ '- uid = '+user_id+ '- likes = '+likes);
        if (user_id != '') {
            $.ajax({
                type: "POST",
                url: "/templates/staycation/common/like.php",
                datatype: "json",
                data: {
                    hotel: hotel_id,
                    user: user_id
                },
                success: function(data) {
                    $('#hotel-' + hotel_id).last().text(data);
                    $('#' + hotel_id).text(data);
                    console.log(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {
            $('#modalLogin').modal('show');
        }

    });
});
