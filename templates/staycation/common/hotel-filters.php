<?php
require_once("../../../common/lib.php");
require_once("../../../common/define.php");
$style = str_replace(",", "','", $_GET['style']);
$style_decoded = urldecode($style);
$location = str_replace(",", "','", $_GET['location']);
$location_decoded = urldecode($location);
$amenities = str_replace(",", "','", $_GET['amenities']);
$amenities_decoded = urldecode($amenities);
$benefit = str_replace(",", "','", $_GET['benefit']);
$benefit_decoded = urldecode($benefit);
$priceMin = str_replace(",", "','", $_GET['price-min']);
$priceMin_decoded = urldecode($priceMin);
$priceMax = str_replace(",", "','", $_GET['price-max']);
$priceMax_decoded = urldecode($priceMax);
// print_r();
// exit();


// Location
$neigh = $db->query("
SELECT * FROM pm_neighborhood
WHERE title IN('".$location_decoded."')
AND lang =2
");

foreach ($neigh as $key => $value) {
  $resultNeigh[] = $value[0];
  $neigh_id = implode(",", $resultNeigh);
}
// print_r($neigh_id);
// exit();
// Location - end

// Amenities
$amen = $db->query("
SELECT * FROM pm_facility
WHERE name IN('".$amenities_decoded."')
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
WHERE name IN('".$benefit_decoded."')
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
WHERE name IN('".$style_decoded."')
AND lang =2
");

foreach ($sty as $key => $value) {
  $resultSty[] = $value[0];
  $sty_id = implode(",", $resultSty);
}
// style - end

$queryArr = array();
if($style_decoded != "") $queryArr[] = "h.style IN({$sty_id})";
if($location_decoded != "") $queryArr[] = "h.id_neighborhood IN({$neigh_id})";
if($amenities_decoded != "") $queryArr[] = "h.facilities IN({$amen_id})";
if($benefit_decoded != "") $queryArr[] = "h.benefit IN({$ben_id})";
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


$query = "
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
{$Where} {$queryStr} {$stringAnd} {$betweenR}
AND h.lang = ".LANG_ID."
AND hf.lang = ".LANG_ID."
group by h.id
.$limit.
";

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
and h.lang = 2
{$Where} {$queryStr} {$stringAnd} {$betweenR}
order by h.title desc) t;
");

$count_all_fetch = $count_all->fetchAll();

// print_r($query);
// exit();
  $result_hotels = $db->query($query);
  $hotels_array = $result_hotels->fetchAll();
  $hotels_array['count_all'] = $count_all_fetch[0][0];
  // print_r($hotels_array);
  // exit();
  header('Content-Type: application/json');
  echo json_encode($hotels_array)
   ?>
