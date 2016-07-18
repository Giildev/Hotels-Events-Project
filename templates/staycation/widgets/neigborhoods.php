<?php

$neigborhood = $db->query("
  SELECT * FROM `pm_neighborhood` WHERE widget_enable=1 order by order_neighborhood asc
");

$hotel = $db->query("
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
(SELECT COUNT(id) from pm_like where id_hotel=h.id AND like_count = 1) as count,
(SELECT AVG(price) FROM pm_room WHERE id_hotel = h.id) as price
FROM pm_neighborhood AS n
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
AND h.id = hf.id_item
WHERE n.widget_enable =1
AND h.featured_enable =1
AND h.lang =".LANG_ID."
AND hf.lang =".LANG_ID."
order by h.order_neighborhood
");
$countPrimary = 0;
$countSecond = 0;
$countPrimary1 = 0;
$countSecond1 = 0;
?>
<!--Sales-->
<section class="boxes" id="sales">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row">
            <div class="col-md-12 bordered_block grey_border">
                <div class="row gray_bck">
                    <h2 class="text-center">Featured Hotels</h2>
                </div>
            </div>
        </div>
        <div class="row gray_bck">
            <ul class="filter text-center">
                <?php
                $id_neighborhood = "";
                foreach ($neigborhood as $key => $value) {
                    if ($value['order_neighborhood'] == "1") {
                        $id_neighborhood = $value['id'];?>
                        <li style="text-decoration: underline;"><a href="" data-neigborhood="<?php echo $value['title']; ?>" class="featured-neigborhood ?>"><?php echo $value['title']; ?></a></li>
                    <?php
                    }else {?>
                        <li><a href="" data-neigborhood="<?php echo $value['title']; ?>" class="featured-neigborhood ?>"><?php echo $value['title']; ?></a></li>
                    <?php
                    }
                }?>
            </ul>
        </div>
        <div class="row w_title gray_bck">
            <form class="hotel-details" action="hotel-profile" method="post">
                <input type="hidden" id="hotel-id" name="hotel-id" value="">
                <?php foreach ($hotel as $key => $value) {?>
                <?php if ($id_neighborhood == $value['neigborhood_id']) {?>
                <?php //if ($value['order_featured'] == '1') {
                if ($countPrimary < 2) {
                ?>
                <div class="col-md-6 bordered_block grey_border image_bck image-hotel featured-hotel-<?php echo $value['neigborhood_id']; ?>" data-image="<?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?>" style="background-image: url("<?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?>");height: 250px;">
                <div class="container featured-hotel-<?php echo $value['neigborhood_id']; ?>">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft  animated like like-val" style="visibility: visible; animation-name: fadeInLeft;" data-idhotel="<?php echo $value['hotel_id'];?>" data-iduser="<?php echo $_SESSION['user']['id'];?>">
                            <div value="<?php echo $value['count']; ?>">
                                <?php
                                $countPrimary++;
                                //echo '$countPrimary '.$countPrimary++;
                                if ($countPrimary == 2)
                                {
                                    $countSecond = 0;
                                }
                                ?>
                                <?php if ($value['count'] >= 1) {?>
                                    <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;"><?php echo $value['count']; ?></span>
                                <?php }else {?>
                                    <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;">0</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInRight  text-right animated" style="visibility: visible; animation-name: fadeInRight;">
                            <span class="great_subtitle great_subtitle_big">$ <?php echo number_format($value['price'], '2') ?></span>
                            <span class="great_subtitle_big"><a href="#" class="btn btn-white">Book Now</a></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 wow fadeInLeft bottom-align-text bottom-margin-30 animated" style="visibility: visible; animation-name: fadeInLeft;">
                            <a href="#">
                                <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_title details"><?php echo $value['hotel_title']; ?></span>
                                <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_subtitle great_subtitle_big details"><?php echo $value['neigborhood_title'] ?></span>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
        <?php }elseif($countSecond <= 2 && $countPrimary > 1){?>
        <div class="col-md-4 bordered_block grey_border image_bck image-hotel featured-hotel-<?php echo $value['neigborhood_id']; ?>"  data-hotel="featured-hotel-<?php echo $value['neigborhood_id']; ?>" data-image="<?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?>" style="background-image: url(" <?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?> ");height: 250px;">
        <div class="container featured-hotel-<?php echo $value['neigborhood_id']; ?>">
            <div class="row">
                <div class="col-md-6 wow fadeInLeft animated like like-val" style="visibility: visible; animation-name: fadeInLeft;" data-idhotel="<?php echo $value['hotel_id'];?>" data-iduser="<?php echo $_SESSION['user']['id'];?>">

                    <?php
                    $countSecond++;
                    //echo '$countSecond '.$countSecond++;
                    if ($countSecond == 3)
                    {
                        $countPrimary = 0;
                    }
                    ?>
                    <div value="<?php echo $value['count']; ?>">
                        <?php if ($value['count'] >= 1) {?>
                            <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;"><?php echo $value['count']; ?></span>
                        <?php } else { ?>
                            <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;">0</span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInRight  text-right animated" style="visibility: visible; animation-name: fadeInRight;">
                    <span class="great_subtitle great_subtitle_big">$ <?php echo number_format($value['price'], '2') ?></span>
                    <span class="great_subtitle_big"><a href="#" class="btn btn-white">Book Now</a></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 wow fadeInLeft bottom-align-text bottom-margin-30 animated" style="visibility: visible; animation-name: fadeInLeft;">
                    <a href="#">
                        <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_title details"><?php echo $value['hotel_title']; ?></span>
                        <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_subtitle great_subtitle_big details"><?php echo $value['neigborhood_title'] ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <?php }else {?>
        <?php //if ($value['order_featured'] == '1') {
        if ($countPrimary1 < 2){
            ?>
            <div class="col-md-6 bordered_block grey_border image_bck image-hotel featured-hotel-<?php echo $value['neigborhood_id']; ?>" data-hotel="featured-hotel-<?php echo $value['neigborhood_id']; ?>" data-image="<?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?>" style="background-image: url('<?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?>');height: 250px; display: none;">
                <div class="container featured-hotel-<?php echo $value['neigborhood_id']; ?>">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft animated like like-val" style="visibility: visible; animation-name: fadeInLeft;" data-idhotel="<?php echo $value['hotel_id'];?>" data-iduser="<?php echo $_SESSION['user']['id'];?>">
                            <div value="<?php echo $value['count']; ?>">
                                <?php
                                $countPrimary1++;
                                //echo '$countPrimary1 '.$countPrimary1++;
                                if ($countPrimary1 == 2)
                                {
                                    $countSecond1 = 0;
                                }
                                ?>
                                <?php if ($value['count'] >= 1) {?>
                                    <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;"><?php echo $value['count']; ?></span>
                                <?php }else {?>
                                    <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;">0</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInRight  text-right animated" style="visibility: visible; animation-name: fadeInRight;">
                            <span class="great_subtitle great_subtitle_big">$ <?php echo number_format($value['price'], '2') ?></span>
                            <span class="great_subtitle_big"><a href="#" class="btn btn-white">Book Now</a></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 wow fadeInLeft bottom-align-text bottom-margin-30 animated" style="visibility: visible; animation-name: fadeInLeft;">
                            <a href="#">
                                <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_title details"><?php echo $value['hotel_title']; ?></span>
                                <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_subtitle great_subtitle_big details"><?php echo $value['neigborhood_title'] ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif($countSecond1 <= 2 && $countPrimary1 > 1) {?>
            <?php
            $countSecond1++;
            //echo '$countSecond1'.$countSecond1++;
            if ($countSecond1 == 3)
            {
                $countPrimary1 = 0;
            }
            ?>
            <div class="col-md-4 bordered_block grey_border image_bck image-hotel featured-hotel-<?php echo $value['neigborhood_id']; ?>"  data-hotel="featured-hotel-<?php echo $value['neigborhood_id']; ?>" data-image="<?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?>" style="background-image: url(' <?php echo DOCBASE."medias/hotel/big/".$value['hotel_file_id']."/".$value['hotel_file']; ?> ');height: 250px; display: none;">
                <div class="container featured-hotel-<?php echo $value['neigborhood_id']; ?>">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft  animated like like-val" style="visibility: visible; animation-name: fadeInLeft;" data-idhotel="<?php echo $value['hotel_id'];?>" data-iduser="<?php echo $_SESSION['user']['id'];?>">
                            <div value="<?php echo $value['count']; ?>">
                                <?php if ($value['count'] >= 1) {?>
                                    <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span id="<?php echo $value['hotel_id']; ?>"  class="" style="font-size:20px;color:#fff;"><?php echo $value['count']; ?></span>
                                <?php }else {?>
                                    <span  class="ti-heart" style="cursor: pointer; font-size:30px;color:#fff;margin-right:10px"></span> <span  id="<?php echo $value['hotel_id']; ?>" class="" style="font-size:20px;color:#fff;">0</span>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="col-md-6 wow fadeInRight  text-right animated" style="visibility: visible; animation-name: fadeInRight;">
                            <span class="great_subtitle great_subtitle_big">$ <?php echo number_format($value['price'], '2') ?></span>
                            <span class="great_subtitle_big"><a href="#" class="btn btn-white">Book Now</a></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 wow fadeInLeft bottom-align-text bottom-margin-30 animated" style="visibility: visible; animation-name: fadeInLeft;">
                            <a href="#">
                                <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_title details"><?php echo $value['hotel_title']; ?></span>
                                <span data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>" class="great_subtitle great_subtitle_big details"><?php echo $value['neigborhood_title'] ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    <?php } ?>
    <?php } ?>
    </form>

    </div>
    </div>
</section>
<!-- Row End -->
