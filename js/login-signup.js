$(document).ready(function() {
    /////////////////////////////////////////////////
    //////////////// Login /////////////////////////
    ///////////////////////////////////////////////
    $('#login-continue').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/templates/staycation/common/register/login.php",
            datatype: "json",
            data: {
                user: $('#login-email').val(),
                password: $('#login-password').val()
            },
            success: function(data) {
                $('#user-name').text($('#login-email').val());
                console.log(data);
                location.reload();
            },
            error: function(data) {
                alert(data.error);
            }
        });
    });

    /////////////////////////////////////////////////
    //////////////// Register /////////////////////////
    ///////////////////////////////////////////////
    $('#signup-continue').on('click', function(e) {
        e.preventDefault();
        if ($('#signup-password').val() != '' && $('#signup-confirm_password').val() != '' && $('#signup-email').val() != '') {
            if ($('#signup-password').val() == $('#signup-confirm_password').val()) {
                $.ajax({
                    type: "POST",
                    url: "/templates/staycation/common/register/signup.php",
                    datatype: "json",
                    data: {
                        name: $('#signup-email').val(),
                        username: $('#signup-email').val(),
                        email: $('#signup-email').val(),
                        password: $('#signup-password').val()
                    },
                    success: function(data) {
                        // alert(data.success);
                        console.log('Success - ' + data);
                        location.reload();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                alert("Password must be confirmed");
                return false;
            }
        } else {
            alert('Email and Password must be filled');
            return false;
        }

    });
    $('#logout').on('click', function(e){
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "/templates/staycation/common/register/logout.php",
          // data: $('#logout-user').val(),
          success: function() {
            location.reload()
          },
          error: function() {
            console.log('not pass');
          }
      });
    });
});
