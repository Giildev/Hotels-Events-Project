<?php  require(SYSBASE."templates/".TEMPLATE."/common/header.php");
// require(SYSBASE."templates/".TEMPLATE."/common/hotel-filters.php");

$page = (!empty($_GET['page']))?$_GET['page']:1;

// Filter vars
$style = $db->query("
SELECT *
FROM  `pm_style`
");

$location = $db->query("
SELECT *
FROM  `pm_neighborhood`
");

$amenities = $db->query("
SELECT *
FROM  `pm_facility`
WHERE lang = ".LANG_ID."
");

$benefit = $db->query("
SELECT *
FROM  `pm_benefit`
");

$count = $db->query("
SELECT COUNT(id) FROM pm_hotel
");
// filter vars end

foreach ($count as $key => $value) {
  // Here we have the total row count
  $rows = $value[0];
}

$style_url = urldecode(str_replace(",", "','", $_GET['style']));
$location_url = urldecode(str_replace(",", "','", $_GET['location']));
$amenities_url = urldecode(str_replace(",", "','", $_GET['amenities']));
$benefit_url = urldecode(str_replace(",", "','", $_GET['benefit']));

// Location
$neigh = $db->query("
SELECT * FROM pm_neighborhood
WHERE title IN('".$location_url."')
AND lang =2
");

foreach ($neigh as $key => $value) {
  $resultNeigh[] = $value[0];
  $neigh_id = implode(",", $resultNeigh);
}
// Location - end

// Amenities
$amen = $db->query("
SELECT * FROM pm_facility
WHERE name IN('".$amenities_url."')
AND lang =2
");

foreach ($amen as $key => $value) {
  $resultAmen[] = $value[0];
  $amen_id = implode(",", $resultAmen);
}
// Amenities - end

// Benefit
$ben = $db->query("
SELECT * FROM pm_benefit
WHERE name IN('".$benefit_url."')
AND lang =2
");

foreach ($ben as $key => $value) {
  $resultBen[] = $value[0];
  $ben_id = implode(",", $resultBen);
}
// Benefit - end
//
// Style
$sty = $db->query("
SELECT * FROM pm_style
WHERE name IN('".$style_url."')
AND lang =2
");

foreach ($sty as $key => $value) {
  $resultSty[] = $value[0];
  $sty_id = implode(",", $resultSty);
}
// style - end

$queryArr = array();
if($style_url != "") $queryArr[] = "style IN('{$sty_id}')";
if($location_url != "") $queryArr[] = "id_neighborhood IN('{$neigh_id}')";
if($amenities_url != "") $queryArr[] = "facilities IN('{$amen_id}')";
if($benefit_url != "") $queryArr[] = "benefit IN('{$ben_id}')";
$queryStr = implode(" AND ", $queryArr);

//$betweenArr = array();
$betweenR="";
$between="";
if($priceMin_decoded != "" && $priceMax_decoded != ""){
  $betweenR="r.price BETWEEN '{$priceMin_decoded}' AND '{$priceMax_decoded}'";
   $between="price BETWEEN '{$priceMin_decoded}' AND '{$priceMax_decoded}'";
}
// $between = implode("", $betweenArr);
// print_r($between);
// print_r($betweenR);
// exit();

$stringWhere = array();
if(!empty($queryArr) || !empty($between)) $stringWhere[] = "WHERE";
$Where = implode("", $stringWhere);

if(!empty($betweenR) && !empty($queryStr)) $stringAnd = "AND";
if(!empty($between)) $stringAndBetween = "AND";

// This is the number of results we want displayed per page
$page_rows = 10;
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($page - 1) * $page_rows .',' .$page_rows;
// This is your query again, it is for grabbing just one page worth of rows by applying $limit
$hotel = $db->query("
SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
n.order_neighborhood AS neigborhood_order,
h.id AS hotel_id,
h.title AS hotel_title,
h.alias AS hotel_alias,
hf.file as hotel_file,
hf.id as hotel_file_id,
(SELECT COUNT(id) from pm_like where id_hotel=h.id) as count,
(SELECT AVG(price) FROM pm_room WHERE id_hotel = h.id {$stringAndBetween} {$between}) as price
FROM pm_neighborhood AS n
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
INNER JOIN pm_room as r ON r.id_hotel=h.id
AND h.id = hf.id_item
AND h.lang = ".LANG_ID."
AND hf.lang = ".LANG_ID."
{$Where} {$queryStr} {$stringAnd} {$betweenR}
order by h.title desc
.$limit.
");

$count_all = $db->query("
SELECT COUNT(*) from (
SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
n.order_neighborhood AS neigborhood_order,
h.id AS hotel_id,
h.title AS hotel_title,
h.alias AS hotel_alias,
hf.file as hotel_file,
hf.id as hotel_file_id,
(SELECT COUNT(id) from pm_like where id_hotel=h.id {$stringAndBetween} {$between}) as count
FROM pm_neighborhood AS n
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
INNER JOIN pm_room as r ON r.id_hotel=h.id
AND h.id = hf.id_item
AND h.lang = ".LANG_ID."
AND hf.lang = ".LANG_ID."
{$Where} {$queryStr} {$stringAnd} {$betweenR}
order by h.title desc) t;
");

$count_all_fetch = $count_all->fetchAll();
?>


<div class="page" id="page">
  <div class="head_bck" data-color="#292929"  data-opacity="0.5"></div>
  <?php  require(SYSBASE."templates/".TEMPLATE."/common/page_header.php"); ?>
<!--Hotel-->
<section id="hotel-results">
<div class="container-fluid">

        <div class="row">
            <div class="bordered_block col-md-12 grey_border">

                <div class="container" style="background-color:#fff; height:auto; margin: 90px 0;">
                    <div class="row">

                        <!--Sidebar-->
                        <div class="col-md-9 col-md-push-3 col-xs-12">

                            <!-- ToolBar -->
                            <div class="toolbar">
                                <p class="amount pull-left">

                                </p>
                                <div class="sorter pull-right">
                                    <div class="sort-by">
                                        <select onchange="setLocation(this.value)">
                                            <option selected="selected" value="">Default sorting</option>
                                            <option value="">Position</option>
                                            <option value="">Name</option>
                                            <option value="">Price</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <form class="hotel-details" action="" method="post">
                              <input type="hidden" id="hotel-id" name="hotel-id" value="">
                              <div id="divhotels">
                                <!-- <div class="search-overlay"> -->
                                  <?php foreach ($hotel as $key => $value) {?>
                                    <div class="row hotel-list" id="<?php echo $value['neigborhood_title']; ?>" style="border:1px solid #f1f1f1; margin-bottom:15px;">
                                      <!-- Item -->
                                      <div class="col-sm-12">
                                        <a class="product_item text-left">
                                          <span class="product_photo"><img src="<?php echo DOCBASE."medias/hotel/medium/".$value['hotel_file_id']."/".$value['hotel_file']; ?>" alt=""></span>
                                          <span class="product_title details" style="cursor: pointer;" data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>"><?php echo $value['hotel_title']; ?><br>
                                            <span style="color:#999; font-size:12px"><?php echo $value['neigborhood_title']; ?></span></span>
                                            <span class="product_price"><span style="from;margin-right: 20px;color: #d2d2d2;text-decoration: line-through;">$ <?php echo number_format(((($value['price'] * 25)/ 100) + $value['price']), '2') ?></span>
                                            <span style="color:#00a0ae;font-size: 22px;">$ <?php echo number_format($value['price'], '2') ?></span>
                                            <span style="font-size: 18px;color:#a9a9a9"> avg/night</span></span>
                                            <hr style="padding-left: 33px;"><span class="product_title">
                                              <span><i class="fa fa-gift" style="font-size: 36px;"></i> Perks</span>
                                              <span class="details" data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" style="cursor: pointer; margin-left: 20px;"><i class="ti-layout-media-center-alt" style="color:#000;font-size: 27px;margin-right: 6px;"></i>Details</span>
                                              <span style="float: right;"><button type="submit" class="btn btn-default" style="height: 45px;width: 92px;border: 0;background-color: #ffbf3b ;color: #fff !important;font-size: 66%;">Book Now</button></span></span>
                                              <?php if ($value['count'] >= 1) {?>
                                                <span style="cursor: pointer;" class="sale like like-val" data-idhotel="<?php echo $value['hotel_id'];?>" data-iduser="<?php echo $_SESSION['user']['id'];?>">
                                                  <div value="<?php echo $value['count']; ?>"><i class="fa fa-heart" style="margin-right:10px;"></i><span id="hotel-<?php echo $value['hotel_id']; ?>" ><?php echo $value['count'];  ?></span></div>
                                                </span>
                                                <?php } else { ?>
                                                  <span style="cursor: pointer;" class="sale like like-val" data-idhotel="<?php echo $value['hotel_id'];?>" data-iduser="<?php echo $_SESSION['user']['id'];?>">
                                                    <div value="<?php echo $value['count']; ?>"><i class="fa fa-heart" style="margin-right:10px;"></i><span id="hotel-<?php echo $value['hotel_id']; ?>" >0</span></div
                                                    </div>
                                                  </span>
                                                  <?php } ?>
                                                </a>
                                              </div>
                                            </div>
                                            <?php } ?>
                                <!-- </div> -->
                              </div>
                              <?php include("hotels_template.html") ?>
                            </form>
									<!-- Item -->

                  <div class="text-center">
                                  <div id="paginator" class="pagination" style="float:none;"></div>
                            </div>
                        </div>
                        <!--Sidebar End-->


<form id="filter-form" action="index.html" method="post">
  <input type="hidden" name="location" id="location" value="">
  <input type="hidden" name="style" id="style" value="">
  <input type="hidden" name="amenities" id="amenities" value="">
  <input type="hidden" name="benefit" id="benefit" value="">
  <input type="hidden" name="price-min" id="price-min" value="">
  <input type="hidden" name="price-max" id="price-max" value="">
  <input type="hidden" id="currentpage" name="currentpage" value="<?php echo $page; ?>"/>
  <input type="hidden" id="pageCount" name="pageCount" value="<?php echo $count_all_fetch[0][0]; ?>"/>
  <div class="col-md-3 col-md-pull-9 hidden-xs hidden-sm">

<div class="widget" style="display:none">
          <h6 class="title">Style</h6>
          <ul class="list-unstyled">
            <?php foreach ($style as $key => $value) {?>
              <li>
                  <a href="#" class="" data-name="<?php echo $value['name']; ?>"><?php echo $value['name']; ?><i style="color:#fff;background-color: #d3d3d3;padding: 2px 6px;border-radius: 48px;width: 15px;height: 15px;font-size: 11px;margin-left: 5px;" class="fa fa-info"  data-toggle="tooltip" data-placement="right" title="Intimate properties with an individualized style and unique story. Your experience will be personable and enjoyable with a smaller range of incredible amenities than a larger hotel."></i></a>
                  <input type="checkbox" class="style" name="multiple_item[]" value="<?php echo $value['name']; ?>"/>
              </li>
            <?php  }?>
          </ul>
      </div>
      <div class="widget">
          <h6 class="title">Price</h6>
          <div class="widget widget-price-filter">
              <span class="min-filter">$<span id="price-filter-value-1">100</span></span>
              <span class="max-filter">$<span id="price-filter-value-2">700</span></span>
              <div id="price-filter" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 10.01%; width: 60.0601%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 10.01%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 70.0701%;"></span></div>
              <a href="#" class="btn btn-default filterPrice">Filter</a>
          </div>
      </div>
      <div class="widget">
          <h6 class="title">Location</h6>
          <ul class="list-unstyled">
            <?php foreach ($location as $key => $value) {?>
              <li>
                  <a href="#" class="" data-name="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a>
                  <input type="checkbox" class="location" name="" value="<?php echo $value['title']; ?>"/>
              </li>
            <?php  }?>
          </ul>
      </div>
      <div class="widget">
          <h6 class="title">Amenities</h6>
          <ul class="list-unstyled">
            <?php foreach ($amenities as $key => $value) {?>
              <li>
                  <a href="#" class="" data-name="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></a>
                  <input type="checkbox" class="amenities" name="" value="<?php echo $value['name']; ?>"/>
              </li>
            <?php  }?>
          </ul>
      </div>
<div class="widget" style="display:none">
          <h6 class="title">Added Benefits</h6>
          <ul class="list-unstyled">
            <?php foreach ($benefit as $key => $value) {?>
              <li>
                  <a href="#" class="" data-name="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></a>
                  <input type="checkbox" class="benefit" name="" value="<?php echo $value['name']; ?>"/>
              </li>
            <?php  }?>
          </ul>
      </div>

<?php displayWidgets("popular", $page_id); ?>

      <div class="widget">
              <h6 class="title">Florida Residents Only </h6>


              <p>Staycation rates and perks are for Florida residents only. Proof of residency will be required at check in. </p>
          </div>
<div class="widget">
              <h6 class="title">Staycay Benefits </h6>
<ul class="staycation-benefits">
<li>Lowest Florida resident rates.</li>
<li>Best negotiated hotel perks.</li>
<li>Collection of the finest hotels</li>
</ul>

          </div>



  </div>
  <!--Sidebar End-->
</form>
                    </div>
                    <!--Row End-->

                </div>
            </div>
        </div>
        <!-- Row End -->


    </div>
</section>
<section class="boxes" id="contacts">
    <div class="container-fluid">

        <div class="row">

            <!-- Contacts -->
            <div class="col-md-4 bordered_block image_bck  " data-color="#f2f2f2" style="height: 565px; background-color: #f2f2f2;">
                <div class="col-md-12 simple_block text-left" style="height:auto; padding:81px 96px;">
                    <h3>Hotels By Area</h3>
                    <ul style="list-style:none;-webkit-padding-start:0">
                    	<li><a href="#">Hotels in South Beach</a>
                    	<li><a href="#">Hotels in Ft. Lauderdale</a>
                    	<li><a href="#">Hotels in Key West</a>
                    	<li><a href="#">Hotels in Brickell</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 bordered_block image_bck  " data-color="#f2f2f2" style="height: 565px; background-color: #f2f2f2;">
                <div class="col-md-12 simple_block text-left" style="height:auto; padding:81px 96px;">
                    <h3>Featured Hotels</h3>
                    <ul style="list-style:none;-webkit-padding-start:0">
                    	<li><a href="#">Featured Hotels in South Beach</a>
                    	<li><a href="#">Featured Hotels in Ft. Lauderdale</a>
                    	<li><a href="#">Featured Hotels in Key West</a>
                    	<li><a href="#">Featured Hotels in Brickell</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 bordered_block image_bck  " data-color="#f2f2f2" style="height: 565px; background-color: #f2f2f2;">
                <div class="col-md-12 simple_block text-left" style="height:auto; padding:81px 96px;">
                    <h3>Upcoming Events</h3>
                    <ul style="list-style:none;-webkit-padding-start:0">
                    	<li><a href="#">Events in South Beach</a>
                    	<li><a href="#">Events in Ft. Lauderdale</a>
                    	<li><a href="#">Events in Key West</a>
                    	<li><a href="#">Events in Brickell</a>
                    </ul>
                </div>
            </div>



        </div>
        <!-- Row End -->
    </div>
    </section>
