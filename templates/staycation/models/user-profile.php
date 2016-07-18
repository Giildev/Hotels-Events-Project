<?php  require(SYSBASE."templates/".TEMPLATE."/common/header.php");

 ?>
<div class="page" id="page_userprofile">
        <div class="head_bck" data-color="#292929" data-opacity="0.5" style="opacity: 0.5; background-color: rgb(41, 41, 41);"></div>
    <?php  require(SYSBASE."templates/".TEMPLATE."/common/page_header.php");
    $result_user = $db->query("SELECT * FROM pm_user where id=".$_SESSION['user']['id']);
    $user_array = $result_user->fetchAll();
    $user = $user_array[0];
    $result_reservation =  $db->query("
    SELECT DISTINCT
    n.id AS neigborhood_id,
    n.title AS neigborhood_title,
    n.alias AS neigborhood_alias,
    n.order_neighborhood AS neigborhood_order,
    h.order_featured as order_featured,
    h.id AS hotel_id,
    h.title AS hotel_title,
    h.alias AS hotel_alias,
    hf.file as hotel_file,
    hf.id as hotel_file_id,
    rm.title as room_title,
    rm.price as room_price,
    bk.from_date as booking_checkin,
    bk.to_date as booking_checkout,
    bk.status as booking_status,
    (SELECT COUNT(id) from pm_like where id_hotel=h.id AND like_count = 1) as count
    FROM pm_neighborhood AS n
    INNER JOIN pm_hotel AS h
    INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
    INNER JOIN pm_room as rm ON rm.id_hotel = h.id
    INNER JOIN pm_booking as bk ON bk.id_room = rm.id
    AND h.id = hf.id_item
    WHERE
    bk.id IN (select id from pm_booking where id_user=".$_SESSION['user']['id'].")
    AND h.lang =".LANG_ID."
    AND hf.lang =".LANG_ID."
    AND rm.lang =".LANG_ID."
    order by h.order_featured;
    ");

    $result_favorites =  $db->query("
    SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
n.order_neighborhood AS neigborhood_order,
h.order_featured as order_featured,
h.id AS hotel_id,
h.title AS hotel_title,
h.alias AS hotel_alias,
hf.file as hotel_file,
hf.id as hotel_file_id,
h.descr as hotel_description,
(SELECT COUNT(id) from pm_like where id_hotel=h.id AND like_count = 1) as count
FROM pm_neighborhood AS n
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
AND h.id = hf.id_item
WHERE
h.id IN (select id_hotel from pm_like where id_user=".$_SESSION['user']['id']." AND like_count = 1)
AND h.lang =".LANG_ID."
AND hf.lang =".LANG_ID."
order by h.order_featured
    ");
    $favorites = $result_favorites->fetchAll();
    $reservation = $result_reservation->fetchAll();
//    $reservation = $arrayreservation[0];
//    print_r($reservation);
    $result_preferences_type = $db->query("
SELECT name,id FROM pm_preference_type
");
    $result_preferences = $db->query("
SELECT name as name_preference,id as id_preference, preference_type FROM pm_preference
");
    $preferences_type = $result_preferences_type->fetchAll();
    $preferences = $result_preferences->fetchAll();

    $result_user_preference =  $db->query("SELECT id_user,id_preference, active FROM pm_user_preference WHERE id_user=".$_SESSION['user']['id']);
    $user_preference = $result_user_preference->fetchAll();
//    print_r($user);
    ?>

        <!--Hotel-->
    <div class="modal fade in" id="modaledit-profile" tabindex="-1" role="dialog" style="display: none; padding-left: 0px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <!--<h4 class="modal-title">Modal title</h4>-->
                </div>
                <div class="modal-body">
                    <div class="auth-screen public-reg clearfix">
                        <h1 class="tenor form-header text-center" style="margin-bottom: 20px;margin-top:20px;">Edit Account</h1>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3" style="/* border-right: 1px solid #d1d1d1; */">
                                <div class="email-reg">
                                    <form id='form-edit'class="" action="#" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="id" class="form" name="id" value="<?php echo $_SESSION['user']['id']; ?>">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="text" id="email" class="form" name="email" placeholder="Email Address" value="<?php echo $user['email'] ?>" style="width: 80%;height: 42px;padding: 20px;font-size: 18px;font-family: 'Oswald';">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="date" id="birthday" class="form" name="birthday" min="1900-01-01" max="2016-01-01" value="<?php echo date("Y-m-d",intval($user['birthday'])) ?>" style="width: 80%;height: 42px;padding: 20px;font-size: 18px;font-family: 'Oswald';">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="radio" name="gender" value="Male" <?php echo (($user['gender'] =='Male')?'checked':''); ?>> Male<br>
                                                <input type="radio" name="gender" value="Female" <?php echo (($user['gender'] =='Female')?'checked':''); ?>> Female<br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="file" name="photo" id="photo">
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col-md-12 text-center">
                                                <input id="edit-continue" type="submit" class="btn btn-primary" data-dismiss="modal" value="Edit" style="width: 80%;height: 40px;font-size: 20px;background-color: #ffbf3b;border: 0;">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <section>
        <div>


    <input id="id_user" name="id_user" type="hidden" value="<?php echo $_SESSION['user']['id'];?>"/>
        <div class="container-fluid">
            <div class="row">
                <div class="bordered_block col-md-12 grey_border">
                    <div class="container" style="background-color:#fff; height:auto; margin: 90px 0;">
                        <div class="row">
                            <!--Sidebar-->
                            <div class="col-md-9 col-xs-12">
                                <!-- Carousel and Anons -->
                                <div class="row product_inside">
                                    <div class="col-md-4 col-xs-12">
                                        <!-- Carousel -->
                                        <div class="classes_inside_item text-center">
                                            <img alt="" src="<?php echo DOCBASE."medias/user/".$user['file']; ?>" style="max-height: 238px;max-width: 249px;">
                                        </div>
                                        <!-- Carousel End -->
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <h3 class="title" style="text-transform: capitalize;"><?=$user['name'];?></h3>
                                        <div class="meta-box clearfix">
                                            <div class="cat-list">
                                                <label>Email</label><span>:</span>
                                                <a class="btn btn-default default-font" href="#" style="text-transform: none;"><?php echo $user['email'] ?></a>
                                            </div>
                                            <div class="cat-list">
                                                <label>Birthday</label><span>:</span>
                                                <a class="btn btn-default default-font" href="#" style="text-transform: none;"><?php echo date("Y-m-d",intval($user['birthday'])) ?></a>
                                            </div>
                                            <div class="cat-list">
                                                <label>Location</label><span>:</span>
                                                <a class="btn btn-default default-font" href="#" style="text-transform: none;"><?php echo $user['address'] ?></a>
                                            </div>
                                            <div class="cat-list">
                                                <label>Gender</label><span>:</span>
                                                <a class="btn btn-default default-font" href="#" style="text-transform: none;"><?php echo $user['gender'] ?></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 50px;/* clear: both; */">
                                    <li class="active" role="presentation">
                                        <a aria-controls="reservations" aria-expanded="false" data-toggle="tab" href="#reservations" id="home-tab" role="tab">Reservations</a>
                                    </li>
                                    <li class="" role="presentation">
                                        <a aria-controls="favorites" aria-expanded="false" data-toggle="tab" href="#favorites" id="favorites-tab" role="tab">Favorites</a>
                                    </li>
                                    <li class="" role="presentation">
                                        <a aria-controls="interests" aria-expanded="false" data-toggle="tab" href="#interests" id="interests-tab" role="tab">Interests</a>
                                    </li>
                                    <!--<li role="presentation" class="">-->
                                    <!--<a aria-controls="preferences" data-toggle="tab" href="#preferences" id="preferences-tab" role="tab" aria-expanded="true">-->
                                    <!--Preferences</a>-->
                                    <!--</li>-->
                                </ul>
                                <form class="hotel-details" action="hotel-profile" method="post">
                                    <input type="hidden" id="hotel-id" name="hotel-id" value="">
                                    <div class="tab-content" id="myTabContent">
                                        <div aria-labelledby="reservations-tab" class="tab-pane fade active in" id="reservations" role="tabpanel" style="border-left: 1px solid #ddd;height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                                            <div class="button_tabs tabs">
                                                <ul class="tabs-ul list-inline" style="margin-left: 20px;">
                                                    <li class="active">
                                                        <a class="btn btn-default status" data-id="All" href="#">All</a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-default status" data-id="Current" href="#">Current</a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-default status" data-id="Past" href="#">Past</a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-default status" data-id="Cancelled" href="#">Cancelled</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" style="padding: 10px;">
                                                    <?php foreach($reservation as $reservation1 ): ?>
                                                        <div id="status_booking_<?=$reservation1['booking_status']; ?>" class="row status_booking booking_<?=$reservation1['booking_status']; ?>" style="border:1px solid #f1f1f1; margin-bottom:15px;">
                                                            <!-- Item -->
                                                            <div class="col-sm-12 booking_<?=$reservation1['booking_status']; ?>">
                                                                <div class="product_item text-left"><span class="product_photo"><img alt="" src="<?php echo DOCBASE."medias/hotel/big/".$reservation1['hotel_file_id']."/".$reservation1['hotel_file']; ?>"></span>
                                                        <span class="product_title" style="margin-top:0;font-size:25px"><?=$reservation1['hotel_title']; ?><span style="color:#999; font-size:12px">&nbsp;
                                                        &nbsp; &nbsp; <?=$reservation1['neigborhood_title']; ?></span></span>
                                                        <span class="product_price"><span style="margin-right: 20px;/* color: #d2d2d2; */">
                                                                <?=$reservation1['room_title']; ?>
                                                        </span><span style="color:#00a0ae;font-size: 15px;">$<?=$reservation1['room_price']; ?></span>
                                                        <span style="font-size: 15px;color:#a9a9a9;">
                                                        avg/night</span></span><span class="product_price"><span style="margin-right: 20px;/* color: #d2d2d2; */">Check-in:</span><span style="font-size: 15px;color:#a9a9a9;"><?=date("Y-m-d",intval($reservation1['booking_checkin']));?></span></span><span class="product_price"><span style="margin-right: 20px;/* color: #d2d2d2; */">Check-out:</span><span style="font-size: 15px;color:#a9a9a9;"><?=date("Y-m-d",intval($reservation1['booking_checkout']));?></span></span>
                                                                    <hr style="padding-left: 33px;">
                                                        <span class="product_title"><a href="#"><span class="details_reservation" style="margin-left: 20px;" data-id="<?php echo $reservation1['hotel_id']; ?>" ><i class="ti-layout-media-center-alt" style="color:#000;font-size: 27px;margin-right: 6px;"></i>Details</span></a>
                                                        <span><button class="btn btn-default" style="height: 45px;float:right;width: 160px;border: 0;background-color: #ffbf3b;color: #fff !important;font-size: 75%;" type="submit"><span>Give
                                                        Feedback</span></button></span></span>
                                                                    <span style="display: none">booking_<?=$reservation1['booking_status']; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach?>
                                                </div>
                                            </div>
                                        </div>
                                        <div aria-labelledby="favorites-tab" class="tab-pane fade" id="favorites" role="tabpanel" style="border-left: 1px solid #ddd;height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                                            <div class="tab-content" style="padding: 10px;">
                                                <?php foreach($favorites as $favorites1 ): ?>
                                                    <div class="row" style="border:1px solid #f1f1f1; margin-bottom:15px;">
                                                        <!-- Item -->
                                                        <div class="col-sm-12">
                                                            <div class="product_item text-left" href="#"><span class="product_photo"  style="margin-right:15px;"><img alt="" src="<?php echo DOCBASE."medias/hotel/big/".$favorites1['hotel_file_id']."/".$favorites1['hotel_file']; ?>"></span>
                                                        <span class="product_title details"  style="margin-top:0;font-size:25px"><?=$favorites1['hotel_title']; ?><span style="color:#999; font-size:12px">&nbsp;
                                                        &nbsp; &nbsp; <?=$favorites1['neigborhood_title']; ?></span></span>

                                                                <span class="product-price"><span class="description" style="margin: 25px 10px 20px 317px;line-height: 23px;"><?php echo $favorites1['hotel_description']; ?></span></span><hr style="padding-left: 33px;">
                                                        <span class="product_title"><a href="#"><span class="details_favorites" style="margin-left: 20px;" data-id="<?php echo $favorites1['hotel_id']; ?>"><i class="ti-layout-media-center-alt" style="color:#000;font-size: 27px;margin-right: 6px;"></i>Details</span></a>
                                                        <span><button class="btn btn-default" style="height: 45px;float:right;width: 160px;border: 0;background-color: #ffbf3b;color: #fff !important;font-size: 75%;" type="submit"><span style="/* float: right; */">Give
                                                        Feedback</span></button></span></span>
                                                                <span class="sale"><i class="fa fa-heart" style="margin-right:10px;"></i> <?=$favorites1['count']; ?></span></div>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                        <div aria-labelledby="interests-tab" class="tab-pane fade" id="interests" role="tabpanel" style="border-left: 1px solid #ddd;height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 1px;">
                                            <!--  Comments -->
                                            <div class="button_tabs tabs">
                                                <p style=" padding: 0 30px;">As Staycationers we want to customize your online experience and offer
                                                    you the best your area has to offer according to your preferences.
                                                    Please fill out as much information as you would like to below
                                                    so our travel experts can tailor offers to your needs.</p>
                                                <!--<ul class="tabs-ul list-inline" style=" margin-left: 20px; margin-top: 30px;">-->
                                                <!--<li class="active">-->
                                                <!--<a class="btn btn-default" href="#about2">All</a>-->
                                                <!--</li>-->
                                                <!--<li>-->
                                                <!--<a class="btn btn-default" href="#about2">Location</a>-->
                                                <!--</li>-->
                                                <!--<li>-->
                                                <!--<a class="btn btn-default" href="#services2">Amenities</a>-->
                                                <!--</li>-->
                                                <!--<li>-->
                                                <!--<a class="btn btn-default" href="#services2">Price</a>-->
                                                <!--</li>-->
                                                <!--</ul>-->

                                                <div class="tab-content" style="padding: 0 26px;">
                                                    <?php foreach($preferences_type as $preferences_type1):?>
                                                        <h3><?=$preferences_type1['name'];?></h3>
                                                        <div class="row" style="border:1px solid #f1f1f1; margin-bottom:15px;">
                                                            <div class="col-sm-12">
                                                                <div class="icon-section">
                                                                    <?php foreach($preferences as $preferences1): $validate = false;?>
                                                                        <?php if ($preferences_type1["id"] == $preferences1["preference_type"]) {?>
                                                                            <div class="icon-container">
                                                                                <label>
                                                                                    <?php foreach($user_preference as $user_preference1): ?>
                                                                                        <?//=$preferences1["id_preference"]?>
                                                                                        <?//=$user_preference1["id_preference"]?>
                                                                                        <?php if($preferences1["id_preference"] == $user_preference1["id_preference"] && $user_preference1["active"]=="1"){ ?>
                                                                                            <input id="preference_<?=$preferences1["id_preference"] ?>" name="preference_<?=$preferences1["id_preference"] ?>"data-id="<?=$preferences1["id_preference"] ?>" class="preference" type="checkbox" checked > <?=$preferences1["name_preference"] ?>
                                                                                            <?php $validate = true; break;?>
                                                                                        <?php }elseif($preferences1["id_preference"] == $user_preference1["id_preference"] && $user_preference1["active"]=="0"){?>
                                                                                            <input id="preference_<?=$preferences1["id_preference"] ?>" name="preference_<?=$preferences1["id_preference"] ?>"data-id="<?=$preferences1["id_preference"] ?>" class="preference" type="checkbox" > <?=$preferences1["name_preference"] ?>
                                                                                            <?php $validate = true; break;?>
                                                                                        <?php } ?>
                                                                                    <?php endforeach; ?>
                                                                                    <?php if($validate == false){?>
                                                                                        <input id="preference_<?=$preferences1["id_preference"] ?>" name="preference_<?=$preferences1["id_preference"] ?>"data-id="<?=$preferences1["id_preference"] ?>" class="preference" type="checkbox" > <?=$preferences1["name_preference"] ?>
                                                                                    <?php } ?>
                                                                                </label>
                                                                            </div>
                                                                        <?php }?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <!-- End Comments -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--Sidebar End-->
                            <!--Sidebar-->
                            <div class="col-md-3 hidden-xs hidden-sm">
                                <div class="widget">
                                    <h6 class="title">Profile Details</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="#" class="edit-profile" data-toggle="modal" data-target="#modaledit-profile">Edit Personal Information</a>
                                        </li>
                                        <li>
                                            <a href="#">Billing Information</a>
                                        </li><li>
                                            <a href="#">Invite Friends</a>
                                        </li>
                                        <li>
                                            <a href="#">Facebook Connect</a>
                                        </li>
                                        <li>
                                            <a href="#">Reset Password</a>
                                        </li>

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
                                <!--Sidebar End-->
                            </div>
                            <!--Row End-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <section class="boxes" id="contacts">
            <div class="container-fluid">
                <div class="row">
                    <!-- Contacts -->
                    <div class="col-md-4 bordered_block image_bck" data-color="#f2f2f2" style="height: 334px; background-color: rgb(242, 242, 242);">
                        <div class="col-md-12 simple_block text-left" style="height:auto; padding:81px 75px">
                            <h3>Hotels By Area</h3>
                            <ul style="list-style:none;-webkit-padding-start:0">
                                <li>
                                    <a href="#">Hotels in Miami & The Beaches</a>
                                </li>
                                <li>
                                    <a href="#">Hotels in Fort Lauderdale</a>
                                </li>
                                <li>
                                    <a href="#">Hotels in The Keys</a>
                                </li>
                                <li>
                                    <a href="#">Hotels in West Palm</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 bordered_block image_bck" data-color="#f2f2f2" style="height: 334px; background-color: rgb(242, 242, 242);">
                        <div class="col-md-12 simple_block text-left" style="height:auto; padding:81px 75px">
                            <h3>Featured Hotels</h3>
                            <ul style="list-style:none;-webkit-padding-start:0">
                                <li>
                                    <a href="#">Featured Hotels in Miami & The Beaches</a>
                                </li>
                                <li>
                                    <a href="#">Featured Hotels in Fort Lauderdale</a>
                                </li>
                                <li>
                                    <a href="#">Featured Hotels in The Keys</a>
                                </li>
                                <li>
                                    <a href="#">Featured Hotels in West Palm</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 bordered_block image_bck" data-color="#f2f2f2" style="height: 334px; background-color: rgb(242, 242, 242);">
                        <div class="col-md-12 simple_block text-left" style="height:auto; padding:81px 75px">
                            <h3>Upcoming Events</h3>
                            <ul style="list-style:none;-webkit-padding-start:0">
                                <li>
                                    <a href="#">Events in Miami & The Beaches</a>
                                </li>
                                <li>
                                    <a href="#">Events in Fort Lauderdale</a>
                                </li>
                                <li>
                                    <a href="#">Events in The Keys</a>
                                </li>
                                <li>
                                    <a href="#">Events in West Palm</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <style>
                .description{
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    line-height: 16px;     /* fallback */
                    max-height: 75px;      /* fallback */
                    -webkit-line-clamp: 3; /* number of lines to show */
                    -webkit-box-orient: vertical;
                }                }
            </style>
        </section>
          <!-- Row End -->
