function removearr(arr, item) {
    for (var i = arr.length; i--;) {
        if (arr[i] === item) {
            arr.splice(i, 1);
        }
    }
    return arr;
}

function getSearchParameters() {
    var prmstr = window.location.search.substr(1);
    return prmstr !== null && prmstr !== "" ? transformToAssocArray(prmstr) : {};
}

function editParams(key, value, url) {
    key = encodeURI(key);

    var params = getSearchParameters();

    if (Object.keys(params).length === 0) {
        if (value !== false)
            return window.history.replaceState('', '', window.location.href + '?' + key + '=' + encodeURIComponent(value));
        else
            return '';
    }

    if (value !== false)
        params[key] = encodeURI(value);
    else
        delete params[key];

    if (Object.keys(params).length === 0)
        return '';

    var currentURL = window.location.href.split('?');
    //var currentURL = url.split('?');
    var newurl = currentURL[0];
    //var change = new RegExp('('+param+')=(.*)&', 'g');

    window.history.replaceState('', '', newurl + '?' + jQuery.map(params, function(value, key) {
        return key + '=' + encodeURIComponent(value);
    }).join('&'));

    return newurl + '?' + jQuery.map(params, function(value, key) {
        return key + '=' + encodeURIComponent(value);
    }).join('&');
}

$(document).ready(function() {
    if ($('#session').val() != '') {
        $('#room-availability').addClass('in');
        $('#room-availability').css('height', '');
    }
    $('.details').on('click', function(e) {
        e.preventDefault();
        window.location.href = "http://staycation.applikable.co/hotel-profile?id=" + $(this).data('id') + "&hotel=" + $(this).data('name');
        // editParams('name', $(this).data('name'), window.location.href);
        // editParams('id', $(this).data('id'), window.location.href);
    });

    var myOptions = {
        zoom: 8,
        center: new google.maps.LatLng(51.49, -0.12),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map"), myOptions);

    // var myLatLng = {lat: 25.7617, lng: -80.1918};
    // console.log(myLatLng);
    // var myOptions = {
    //      zoom: 11,
    //      center: new google.maps.LatLng(myLatLng),
    //      mapTypeId: google.maps.MapTypeId.ROADMAP
    //   };
    //
    //   var map = new google.maps.Map(document.getElementById("map"), myOptions);

    //     var marker = new google.maps.Marker({
    //       position: myLatLng,
    //       map: map,
    //       title: 'Hello World!'
    // });
});
