<?php

require_once("../../../common/lib.php");
require_once("../../../common/define.php");

//function update($db, $table, $data)
//{
//    $result = $db->query("SELECT * FROM ".$table." LIMIT 1");
//    $list_cols = db_list_columns($db, $table);
//    $count_cols = 0;
//    $nb_cols = 0;
//    foreach($list_cols as $column)
//        if(array_key_exists($column, $data)) $nb_cols++;
//    $query = "UPDATE ".$table." SET ";
//    foreach($list_cols as $i => $column){
//        if(array_key_exists($column, $data)){
//            $query .= $column." = :".$column;
//            if($count_cols < $nb_cols-1) $query .= ", ";
//            $count_cols++;
//        }
//    }
//    $query .= " WHERE id = ".$data['id']." ";
//    if(isset($data['lang']) && db_column_exists($db, $table, "lang")) $query .= " AND lang = '".$data['lang']."'";
//    $result = $db->prepare($query);
//    foreach($list_cols as $i => $column){
//        if(array_key_exists($column, $data)){
//            $col_type = db_column_type($db, $table, $column);
//            $value = (is_null($data[$column]) || (preg_match("/.*(char|text).*/i", $col_type) === false && $data[$column] == "")) ? null : $data[$column];
//            $result->bindValue(":".$column, $value);
//        }
//    }
//    return $result;
//}
//print_r($_POST);
//print_r($_FILES);
//exit();
//print_r($_SESSION);
//exit();
$output = array("html" => "", "notices" => array(), "error" => "", "success" => "", "redirect" => "");

$id = htmlentities($_POST['id'], ENT_COMPAT, "UTF-8");
$email = htmlentities($_POST['email'], ENT_COMPAT, "UTF-8");
$birthday = strtotime($_POST['birthday']);
$gender = htmlentities($_POST['gender'], ENT_COMPAT, "UTF-8");

$allowedExts = array("jpg", "png");
$extension = end(explode(".", $_FILES["photo"]["name"]));
if (($_FILES["photo"]["size"] < 1000000)
    && in_array($extension, $allowedExts)) {
    if ($_FILES["photo"]["error"] > 0)
    {
        // echo "Return Code: " . $_FILES["upload"]["error"] . "<br />";
    }
    else
    {
        if ( ! is_dir("../../../medias/user/".$_SESSION["user"]["id"])) {
            mkdir("../../../medias/user/".$_SESSION["user"]["id"]);
        }
        move_uploaded_file($_FILES["photo"]["tmp_name"],
            "../../../medias/user/".$_SESSION["user"]["id"]."/".$_FILES["photo"]["name"]);
        $output['error'] =  "Stored in: "."media/user/". $_SESSION["user"]["id"] ."/".$_FILES["photo"]["name"];

//        if (file_exists("../../../medias/user/".$_FILES["photo"]["name"]))
//        {
//            $output['error'] = $_FILES["photo"]["name"] . " already exists. ";
//            header('Content-Type: application/json');
//            echo json_encode($output);
//            die;
//        }
//        else
//        {
//            move_uploaded_file($_FILES["photo"]["tmp_name"],
//                "../../../medias/user/".$_FILES["photo"]["name"]);
//          $output['error'] =  "Stored in: " . "Proposals/". $_SESSION["FirstName"] ."/". $_FILES["upload"]["name"];
//        }
    }
} else {
    $output['error'] =  "Invalid file";
    header('Content-Type: application/json');
    echo json_encode($output);
    die;
}

//$result_user = $db->query("SELECT * FROM pm_user WHERE id = ".$db->quote($id));
//if($result_user !== false && $db->last_row_count() > 0){
//    $rowuser = $result_user->fetch();
//}
if(count($output['notices']) == 0){
    $data = array();
    if (!empty($id))
        $data['id'] = $id;
    if (!empty($email))
        $data['email'] = $email;
    if (!empty($birthday))
        $data['birthday'] = $birthday;
    if (!empty($gender))
        $data['gender'] = $gender;
    if (!empty($_FILES['photo']['name']))
        $data['file'] = $_FILES['photo']['name'];

    $result_update = db_prepareUpdate($db, "pm_user", $data);

    $result_update->execute();
    $output['success'] = true;
}


header('Content-Type: application/json');
echo json_encode($output);

?>
