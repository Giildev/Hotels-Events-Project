<?php

require_once("../../../common/lib.php");
require_once("../../../common/define.php");

function update($db, $table, $data)
{
    $result = $db->query("SELECT * FROM ".$table." LIMIT 1");
    $list_cols = db_list_columns($db, $table);
    $count_cols = 0;
    $nb_cols = 0;
    foreach($list_cols as $column)
        if(array_key_exists($column, $data)) $nb_cols++;
    $query = "UPDATE ".$table." SET ";
    foreach($list_cols as $i => $column){
        if(array_key_exists($column, $data)){
            $query .= $column." = :".$column;
            if($count_cols < $nb_cols-1) $query .= ", ";
            $count_cols++;
        }
    }
    $query .= " WHERE id_hotel = ".$data['id_hotel']." AND id_user = ".$data['id_user']."";
    // if(isset($data['lang']) && db_column_exists($db, $table, "lang")) $query .= " AND lang = '".$data['lang']."'";
    $result = $db->prepare($query);
    foreach($list_cols as $i => $column){
        if(array_key_exists($column, $data)){
            $col_type = db_column_type($db, $table, $column);
            $value = (is_null($data[$column]) || (preg_match("/.*(char|text).*/i", $col_type) === false && $data[$column] == "")) ? null : $data[$column];
            $result->bindValue(":".$column, $value);
        }
    }
    return $result;
}


$output = array("html" => "", "notices" => array(), "error" => "", "success" => "", "redirect" => "");

$hotel_id = htmlentities($_POST['hotel'], ENT_COMPAT, "UTF-8");
$user_id = htmlentities($_POST['user'], ENT_COMPAT, "UTF-8");

$result_like = $db->query("SELECT * FROM pm_like WHERE id_user = ".$db->quote($user_id)." AND id_hotel = ".$db->quote($hotel_id));
if($result_like !== false && $db->last_row_count() > 0){
    $rowlike = $result_like->fetch();
    if($hotel_id == $rowlike['id_hotel'] && $user_id == $rowlike['id_user'])
    {
      if ($rowlike['like_count'] =="1")
        $output['notices'] = "unlike";
        else {
          $output['notices'] = "like";
        }
    }
}
if(count($output['notices']) == 0){

  $data = array();
  $data['id'] = "";
  $data['id_user'] = $user_id;
  $data['id_hotel'] = $hotel_id;                                      //   Insert
  $data['like_count'] = "1";
  $data['checked'] = 1;

 $result_insert = db_prepareInsert($db, "pm_like", $data);
 $result_insert->execute();


}elseif ($output['notices'] == "unlike") {
  $data = array();
  $data['id_user'] = $user_id;
  $data['id_hotel'] = $hotel_id;                                     //   Unlike
  $data['like_count'] = "0";
  $data['checked'] = 1;

  $result_update = update($db, "pm_like", $data);
  $result_update->execute();


}elseif ($output['notices'] == "like") {
  $data = array();
  $data['id_user'] = $user_id;
  $data['id_hotel'] = $hotel_id;                                    //  Like Again
  $data['like_count'] = "1";
  $data['checked'] = 1;

  $result_update = update($db, "pm_like", $data);
  $result_update->execute();

}

// Likes count
$likeloop = $db->query("
SELECT COUNT( id ) as likes
FROM  `pm_like`
WHERE `id_hotel` = ".$hotel_id."
AND `like_count` = 1
");
foreach ($likeloop as $key => $value) {
  $total = $value['likes'];
}

print_r($total);
?>
