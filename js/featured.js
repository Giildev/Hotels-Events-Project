var maphotel;
$(document).ready(function() {
    $('.featured-neigborhood').on('click', function(e) {
        e.preventDefault();
        result = $(this).data('neigborhood');
        underline = $(this).parent()
        $('.image-hotel:not(:contains("' + result + '"))').hide();
        $('.image-hotel:contains("' + result + '")').show();
        $(underline).css('text-decoration', 'underline');
        $(underline).siblings().css('text-decoration', '');
    });
    $('.featured-event').on('click', function(e) {
        e.preventDefault();
        result = $(this).data('event');
        underline = $(this).parent();
        console.log($('.image-event:not(:contains("' + result + '"))'));
        $('.image-event:contains("' + result + '")').show();
        $('.image-event:not(:contains("' + result + '"))').hide();
        $(underline).css('text-decoration', 'underline');
        $(underline).siblings().css('text-decoration', '');
    });
    //$('#area-tab').on('click', function()
    //{
    //    console.log('area');
    //    document.getElementById('map').style.display="block";
    //    //var center = maphotel.getCenter();
    //    //google.maps.event.trigger(maphotel, 'resize');
    //    //maphotel.setCenter(center);
    //    mapResize()
    //});
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        mapResize();
    });
    //mapResize()
});
function mapResize()
{
    //jQuery(window).resize(function(){
    //    jQuery('#map').height(jQuery('#map_canvas').height());
    //});
   // document.getElementById('map').style.display="block";
    var myLatLng = new google.maps.LatLng(25.7601793, -80.1958755);
    var mapOptions = {
        zoom: 14,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.RoadMap,
        disableDefaultUI: true,
        zoomControl: true
    };
    console.log(mapOptions);
    maphotel = new google.maps.Map(document.getElementById('map'),
        mapOptions);
    //jQuery('#map').height(jQuery('#map_canvas').height());
}