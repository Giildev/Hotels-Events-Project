var arrayLocation = [];
var arrayStyle = [];
var arrayAmenities = [];
var arrayBenefit = [];
var arrayPagination = [];
var arrayPriceMin = [];
var arrayPriceMax = [];


function fillPaginator(counter, page)
{
   //console.log(page);
   //console.log(counter);
   var nrocounter;
   if(counter =='')
       nrocounter = jQuery('#page_count').val();
   else
   {
       if (counter <=10)
       {
           nrocounter = 1;
       }
       else
       {
           nrocounter = counter/10;
           if (nrocounter > 1 && nrocounter < 2)
               nrocounter = 2;
       }
   }
//console.log(nrocounter);
   var options = {
       // alignment: 'center',
       currentPage: page,
       totalPages: nrocounter,
       pageUrl: function(type, page, current){
           return editParams('pages',page,window.location.href);
       },
       onPageClicked: function(e,originalEvent,type,page){
           //$('#alert-content').text("Page item clicked, type: "+type+" page: "+page);
           editParams('pages',page,window.location.href);
           window.location.href;
       }
   }
   //console.log('paginator');
   jQuery('#paginator').empty();
   jQuery('#paginator').bootstrapPaginator(options);
}

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

// convert parameters from url-style string to associative array
function transformToAssocArray(prmstr) {
    var params = {},
        prmarr = prmstr.split("&");

    for (var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var apiCall = function() {
    var templateId, elementResult, typeAction, url, datatype;
    var construct = function() {
        templateId = '';
        elementResult = '';
        typeAction = '';
        url = '';
        datatype = '';
    };
    var execAPI = function(templateId, elementResult, typeAction, url, datatype, elementdata) {
        //console.log($(elementdata).serializeArray());

        $.ajax({
            url: url,
            type: typeAction,
            datatype: datatype,
            data: $(elementdata).serializeArray(),
            beforeSend: function() {
                //$('#'+elementResult).addClass('divLoading');
                $('.search-overlay').show();
            },
            complete: function() {
                //$('#'+elementResult).removeClass('divLoading');
                $('.search-overlay').hide();
            },
            success: function(data) {
                console.log(data);
                var arreglo = data;
                var stringHtml = $('#' + templateId).html();
                var template = Handlebars.compile(stringHtml);
                $('#' + elementResult).html(template(data));
                if (data.count_all != "0") {
                   fillPaginator(data.count_all,$('#currentpage').val());
                }
            },
            error: function() {
                console.log("");
            }
        });
    };
    return {
        init: function() {
            construct();
        },
        runAPI: function(templateId, elementResult, typeAction, url, datatype, elementdata) {
            execAPI(templateId, elementResult, typeAction, url, datatype, elementdata);
            return;
        }
    };
}();


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

$(document).on('ready', function() {
    $('.location').on('click', function() {
        if ($(this).is(':checked')) {
            arrayLocation.push($(this).val());
            $('#location').val(arrayLocation.toString());
            editParams('location', arrayLocation.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        } else {
            arrayLocation = removearr(arrayLocation, $(this).val());
            $('#location').val(arrayLocation.toString());
            editParams('location', arrayLocation.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        }
    });
    $('.benefit').on('click', function() {
        if ($(this).is(':checked')) {
            arrayBenefit.push($(this).val());
            $('#benefit').val(arrayBenefit.toString());
            editParams('benefit', arrayBenefit.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        } else {
            arrayBenefit = removearr(arrayBenefit, $(this).val());
            $('#benefit').val(arrayBenefit.toString());
            editParams('benefit', arrayBenefit.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'))

        }
    });
    $('.style').on('click', function() {

        if ($(this).is(':checked')) {
            arrayStyle.push($(this).val());
            $('#style').val(arrayStyle.toString());
            editParams('style', arrayStyle.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        } else {
            arrayStyle = removearr(arrayStyle, $(this).val());
            $('#style').val(arrayStyle.toString());
            editParams('style', arrayStyle.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        }
    });
    $('.amenities').on('click', function() {
        if ($(this).is(':checked')) {
            arrayAmenities.push($(this).val());
            $('#amenities').val(arrayAmenities.toString());
            editParams('amenities', arrayAmenities.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        } else {
            arrayAmenities = removearr(arrayAmenities, $(this).val());
            $('#amenities').val(arrayAmenities.toString());
            editParams('amenities', arrayAmenities.toString(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        }
    });
    $('.filterPrice').on('click', function(e) {
        e.preventDefault();
        $('.filterPrice').toggleClass('filter-toggle');
        if ($('.filterPrice').hasClass('filter-toggle')) {
            $('#price-min').val($('#price-filter-value-1').text());
            $('#price-max').val($('#price-filter-value-2').text());
            editParams('price-min', $('#price-min').val(), window.location.href);
            editParams('price-max', $('#price-max').val(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));

        } else {
            $('#price-min').val($('#price-filter-value-1').text());
            $('#price-max').val($('#price-filter-value-2').text());
            editParams('price-min', $('#price-min').val(), window.location.href);
            editParams('price-max', $('#price-max').val(), window.location.href);
            apiCall.runAPI('hotel-list', 'divhotels', 'GET', document.location.origin + '/templates/staycation/common/hotel-filters.php', 'json', jQuery('#filter-form'));


        }
    });
    $('.paginator').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('paginator-toggle');
        if ($(this).hasClass('filter-toggle')) {
            editParams('pn', $(this).text(), window.location.href);
            location.reload();
            // var url = location.href.replace(/&?pn=([^&]$|[^&]*)/i, "");
        } else {
            editParams('pn', $(this).text(), window.location.href);
            location.reload();
            // var url = location.href.replace(/&?pn=([^&]$|[^&]*)/i, "");
        }
    })

    counter = $('#pageCount').val();
    var nrocounter;
    if (counter <=10)
    {
        nrocounter = 1;
    }
    else
    {
        nrocounter = counter/10;
        if (nrocounter > 1 && nrocounter < 2)
            nrocounter = 2;
    }
    var options = {
        currentPage: $('#currentpage').val(),
        totalPages: nrocounter,
        onPageClicked: function(e,originalEvent,type,page){
           editParams('page',page,window.location.href);
           location.reload();
       }
    }
    $('#paginator').bootstrapPaginator(options);

    Handlebars.registerHelper('convertNumber', function(list_price) {
           return  '$ '+ parseInt(list_price).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
       }
    );
});






$('#price-filter').slider({
    range: true,
    min: 0,
    max: 999,
    values: [100, 700],
    slide: function(event, ui) {
        $('#price-filter-value-1').text(ui.values[0]);
        $('#price-filter-value-2').text(ui.values[1]);
        var min = ui.values[0] / 999 * 90;
        var max = ui.values[1] / 999 * 90;
        $('.min-filter').css('left', min + '%');
        $('.max-filter').css('left', max + '%');
    }
});



// apiCall.runAPI('hotel-list','divhotels','GET',document.location.origin + '/templates/staycation/common/hotel-filters.php','json',jQuery('#filter-form'));
