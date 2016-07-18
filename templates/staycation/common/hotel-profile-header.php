<!-- Header -->
<header class="white_bck">


    <!-- Header Top Line -->

    <!-- Top Line End -->

    <!-- Logo -->
    <div class="logo pull-left">
        <a href="<?php echo DOCBASE; ?>">
    <img src="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/images/logo.png">
        </a>
    </div>


    <!-- Header Buttons -->
    <div class="header_btns_wrapper">


        <!-- Main Menu Btn -->
        <div class="main_menu"><i class="ti-menu"></i><i class="ti-close"></i></div>

        <!-- Sub Menu -->
        <div class="top_line clearfix">

        <!-- Address -->


        <!-- Mail -->
        <span class="tl_item">

        </span>

        <!-- Phone -->
        <div class="" style="margin-right: 60px;width: 100%;top: 0;position: absolute;right: -79%;">
            <div class="tl_item" style="width: 25%;">
                <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" style="text-transform: capitalize;padding: 0 10px;">About</a> | <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" style="text-transform: capitalize;padding: 0 10px;">Contact</a><div class="col-md-6 text-left" style=" float: right; margin-top: 8px; ">
                <ul class="list-inline social-list">

                    <li>
                        <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" title="" data-original-title="Facebook">
                            <i class="ti-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" title="" data-original-title="Twitter">
                            <i class="ti-twitter-alt"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" title="" data-original-title="instagram">
                            <i class="ti-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" title="" data-original-title="google">
                            <i class="ti-google"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#" title="" data-original-title="Twitter">
                            <i class="ti-pinterest-alt"></i>
                        </a>
                    </li>



                </ul>
            </div></div>

        </div>

    </div><div class="sub_menu" style="width:100%;">
            <div class="sub_cont">
                <ul style="left: 35%;float:left;">
                    <li><a href="#" class="parents">Book</a></li>
                    <li><a href="hotels" class="parents">Hotels</a></li>
                    <li><a href="#" class="parents">South Florida</a></li>
                    <li><a href="#" class="parents">Events</a></li>
                    <?php if ($_SESSION['user']['login'] == "") {?>
                      <li><a href="" id='login' data-toggle="modal" data-target="#modalLogin" class="parents">Login</a></li>
                    <?php }else {?>
                      <li><a href="" id='logout' class="parents">Logout</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['user']['login'] != "") {?>
                      <li><a href='user-profile' id='user-name' class="parents"><?php echo ucfirst($_SESSION['user']['login']); ?></a></li>
                    <?php }else{?>
                       <li><a id='user-name' class="parents"></a></li>
                    <?php } ?>
                     <ul class="mega_menu" style="display: none; height: 58px; padding-top: 10px; margin-top: 0px; padding-bottom: 10px; margin-bottom: 0px;">
                            <li class="mega_sub bask_menu">
                                <form>
                                    <input type="text" class="form-control" placeholder="Enter Your Keywords">
                                    <button type="submit" class="se_btn">
                                      <i class="ti-search"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li></ul>
      <ul style="float:right;/* margin-top: 29px; */">



                    <!-- Search -->

                    <!-- Search End-->

                </ul>

            </div>
        </div>
        <!-- Sub Menu End -->


    </div>
    <!-- Header Buttons End -->

    <!-- Up Arrow -->
    <a href="http://www.staycationsouthfl.com/mock/hotel-profile.html#page" class="up_block go"><i class="fa fa-angle-up"></i></a>

</header>
<!-- Header End -->

<section class="intro">
    <!-- Down Arrow -->

    <!-- Wrapper -->
    <div class="intro_wrapper owl-carousel owl-theme" style="opacity: 1; display: block;">

        <!-- Item -->
        <div class="owl-wrapper-outer">
            <div class="owl-wrapper" style="width: 26642px; left: 0px; display: block;">
                <div class="owl-item active" style="width: 1903px;">
                    <div class="intro_item">
                        <!-- Over -->
                        <div class="over" data-opacity="0.1" data-color="#292929" style="opacity: 0.1; background-color: rgb(41, 41, 41);">
                        </div>
                        <div class="into_back into_zoom image_bck" data-image="<?php echo DOCBASE."medias/hotel/big/".$hotel_file_id."/".$hotel_file?>" style="background-image: url(&quot;<?php echo DOCBASE."medias/hotel/big/".$hotel_file_id."/".$hotel_file?>&quot;);">
                        </div>
                        <div class="text_content">
                            <div class="row" style="padding-top:0">
                                <div class="col-md-12 wow fadeInRight text-right hero_text animated" style="position: absolute; right: 0px; height: 100%; padding: 40px; width: 100%; visibility: visible; animation-name: fadeInRight;">
                                    <span class="great_title" style="font-size:35px; line-height:20px;"><?php echo $hotel_title?></span>
                                    <span class="great_subtitle great_subtitle_big" style="font-size:16px;"><?php echo $hotel_address.' , '.$neigborhood_title?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item" style="width: 1903px;">
                    <div class="intro_item">
                        <!-- Over -->
                        <div class="over" data-opacity="0.1" data-color="#292929" style="opacity: 0.1; background-color: rgb(41, 41, 41);"></div>
                        <div class="into_back into_zoom image_bck" data-image="<?php echo DOCBASE."medias/hotel/big/".$hotel_file_id."/".$hotel_file?>" style="background-image: url(&quot;<?php echo DOCBASE."medias/hotel/big/".$hotel_file_id."/".$hotel_file?>&quot;);"></div>
                        <div class="text_content">
                            <div class="row" style="padding-top:0">
                                <div class="col-md-12 wow fadeInRight text-right hero_text animated" style="position: absolute; right: 0px; height: 100%; padding: 40px; width: 100%; visibility: visible; animation-name: fadeInRight;">
                                    <span class="great_title" style="font-size:35px; line-height:20px;">SLS South Beach</span>
                                    <span class="great_subtitle great_subtitle_big" style="font-size:16px;">1701 Collins Ave, Miami Beach, FL 33139</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="owl-item" style="width: 1903px;">
                    <div class="intro_item">
                        <!-- Over -->
                        <div class="over" data-opacity="0.1" data-color="#292929" style="opacity: 0.1; background-color: rgb(41, 41, 41);"></div>
                        <div class="into_back into_zoom image_bck" data-image="images/hotels/SLS/Villawithview_hires.jpg" style="background-image: url(&quot;images/hotels/SLS/Villawithview_hires.jpg&quot;);"></div>
                        <div class="text_content">
                            <div class="row" style="padding-top:0">
                                <div class="col-md-12 wow fadeInRight text-right hero_text animated" style="position: absolute; right: 0px; height: 100%; padding: 40px; width: 100%; visibility: visible; animation-name: fadeInRight;">
                                    <span class="great_title" style="font-size:35px; line-height:20px;">SLS South Beach</span>
                                    <span class="great_subtitle great_subtitle_big" style="font-size:16px;">1701 Collins Ave, Miami Beach, FL 33139</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-controls clickable">
            <div class="owl-pagination">
                <div class="owl-page active">
                    <span class=""></span>
                </div>
                <div class="owl-page">
                    <span class=""></span>
                </div>
                <div class="owl-page">
                    <span class=""></span>
                </div>
                <div class="owl-page">
                    <span class=""></span>
                </div>
                <div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div><div class="owl-buttons"><div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div></div>
        </div>
    </div>
    <!-- Wrapper End -->
</section>
