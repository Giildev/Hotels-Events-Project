<?php
define("ADMIN", true);
require_once("../common/lib.php");
require_once("../common/define.php");
define("TITLE_ELEMENT", $texts['DASHBOARD']);

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}elseif($_SESSION['user']['type'] == "registered"){
    $_SESSION['msg_error'] = "Access denied.<br/>";
    header("Location: login.php");
    exit();
}

require_once("includes/fn_module.php"); ?>
<!DOCTYPE html>
<head>
    <?php include("includes/inc_header_common.php"); ?>
</head>
<body>
    <div id="wrapper">
        <?php include("includes/inc_top.php"); ?>
        <div id="page-wrapper">
            <div class="page-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1><i class="fa fa-dashboard"></i> <?php echo $texts['DASHBOARD']; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="alert-container">
                    <div class="alert alert-success alert-dismissable"></div>
                    <div class="alert alert-warning alert-dismissable"></div>
                    <div class="alert alert-danger alert-dismissable"></div>
                </div>
                <div class="row">
                    <?php
                    if($db !== false){
                        foreach($modules as $module){ //$modules @ fn_module para pintar el index
                            //                                                           print_r($title,$name,etc) =
                            $title = $module->getTitle();          // PagesArray ( [nb] => 14 [0] => 14 [last_add_date] => 1459483440 [1] => 1459483440 [2] => 1459483440 )
                            $name = $module->getName();            // ArticlesArray ( [nb] => 2 [0] => 2 [last_add_date] => 1459483440 [1] => 1459483440 [2] => 1459483440 )
                            $dir = $module->getDir();              // MediasSlideshowWidgetsTagsTextsLanguagesLocationsCommentsArray ( [nb] => 0 [0] => 0 [last_add_date] => [1] => [2] => )
                            $dates = $module->isDates();           //MessagesArray ( [nb] => 0 [0] => 0 [last_add_date] => [1] => [2] => )
                            $count = 0;
                            $last_date = "";
                            $rights = $module->getPermissions($_SESSION['user']['type']); // $rights = Array ( [0] => all )

                            if($module->isDashboard() && !in_array("no_access", $rights) && !empty($rights)){     //isDashboard @ includes/Module.class
                                $query = "SELECT count(id) AS nb";
                                if($dates) $query .= ", MAX(add_date) AS last_add_date, MAX(edit_date) AS last_add_date";
                                $query .= " FROM pm_".$name."";
                                if($module->isMultilingual()) $query .= " WHERE lang = ".DEFAULT_LANG;

                                if(!in_array($_SESSION['user']['type'], array("administrator", "manager", "editor")) && db_column_exists($db, "pm_".$name, "id_user"))
                                    $query .= " AND id_user = ".$_SESSION['user']['id'];

                                $result = @$db->query($query);
                                if($result !== false && $db->last_row_count() == 1){
                                    $row = $result->fetch();
                                    $count = $row[0];
                                    if($dates){
                                        $last_add_date = (!is_null($row[1])) ? $row[1] : 0;
                                        $last_edit_date = (!is_null($row[2])) ? $row[2] : 0;

                                        $last_date = max($last_edit_date, $last_add_date);
                                        $last_date = ($last_date == 0) ? "" : date("Y-m-d g:ia", $last_date);
                                    } ?>

                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <h3><?php echo $title; ?></h3>      <!-- Titulo de las cajas en el index (no en en el dropdown, son diferente)  -->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><i class="fa fa-<?php echo $module->getIcon(); ?>"></i> <?php echo $count; ?></div>     <!-- Icono y Cantidad de items  -->
                                                        <?php
                                                        if($last_date != ""){
                                                            echo "<i class=\"fa fa-clock-o\"></i> <small>".$last_date."</small>";
                                                        }else echo "<small>&nbsp;</small>"; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo $dir; ?>/index.php?view=list">    <!-- view=list  @ modules/default/list  -->
                                                <div class="panel-footer">
                                                    <span class="pull-left"><?php echo $texts['SHOW']; ?></span>
                                                    <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                            <a href="<?php echo $dir; ?>/index.php?view=form&id=0">
                                                <div class="panel-footer">
                                                    <span class="pull-left"><?php echo $texts['ADD']; ?></span>
                                                    <span class="pull-right"><i class="fa fa-plus-circle"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    } ?>
                </div>
            </div>
        </div>
        <!-- <pre> -->
          <?php
            // print_r($modules);
           ?>
        <!-- </pre> -->
    </div>
</body>
</html>
<?php
$_SESSION['msg_error'] = "";
$_SESSION['msg_success'] = "";
$_SESSION['msg_notice'] = ""; ?>
