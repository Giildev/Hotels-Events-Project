$(document).ready(function(){
  $(document).on('click', '.neigborhood', function(){
    neigborhood_child = $(this).children();
    neigborhood_id = $(neigborhood_child).val();
    img = $(this).next();
    img_id = $(this).next().children().val();
    if ($(img).hide()) {
      $(img).hide();
    }else {
        $(img).show();
    }
  })
});
