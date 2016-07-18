<?php
/**
 * Created by PhpStorm.
 * User: cristopher
 * Date: 01-06-2016
 * Time: 09:11 AM
 */

require_once("../../../common/lib.php");
require_once("../../../common/define.php");
$output = array("html" => "", "notices" => array(), "error" => "", "success" => "", "redirect" => "");

$id_user = htmlentities($_POST['user'], ENT_COMPAT, "UTF-8");
$id_preference = htmlentities($_POST['preference'], ENT_COMPAT, "UTF-8");

$result_userpreference = $db->query("SELECT * FROM pm_user_preference WHERE id_user = ".$db->quote($id_user)." AND id_preference = ".$db->quote($id_preference));
$success;
if($result_userpreference !== false){
    $rowpreference = $result_userpreference->fetch();

//    if($hotel_id == $rowpreference['id_hotel'] && $rowpreference == $rowlike['id_user'])
//    {
//        if ($rowlike['like_count'] =="1")
//            $output['notices'] = "unlike";
//        else {
//            $output['notices'] = "like";
//        }
//    }

    if ($rowpreference =="" || $rowpreference == null)
    {
        $data = array();
        $data['id'] = "";
        $data['lang'] = 2;
        $data['id_user'] = intval($id_user);
        $data['id_preference'] = intval($id_preference);
        $data['id_profile'] = 0;
        $data['checked'] = 1;
        $data['rank'] = 1;
        $data['active'] = 1;

        $result_insert = db_prepareInsert($db, "pm_user_preference", $data);
        $success =  $result_insert->execute();

    }
    elseif($rowpreference['active']==1){
        $data = array();
        $data['id'] = $rowpreference['id'];
        $data['lang'] = 2;
        $data['id_user'] = intval($id_user);
        $data['id_preference'] = intval($id_preference);
        $data['id_profile'] = 0;
        $data['checked'] = 1;
        $data['rank'] = 1;
        $data['active'] = 0;
        $result_update = db_prepareUpdate($db,"pm_user_preference",$data);
        $success = $result_update->execute();
    }
    else{
        $data = array();
        $data['id'] = $rowpreference['id'];
        $data['lang'] = 2;
        $data['id_user'] = intval($id_user);
        $data['id_preference'] = intval($id_preference);
        $data['id_profile'] = 0;
        $data['checked'] = 1;
        $data['rank'] = 1;
        $data['active'] = 1;
        $result_update = db_prepareUpdate($db,"pm_user_preference",$data);
        $success = $result_update->execute();
    }
}
echo ($success) ? "true" : "false";