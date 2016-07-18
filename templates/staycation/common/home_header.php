<!-- Header -->
<header class="white_bck">

    <!-- Header Top Line -->

    <!-- Top Line End -->

    <!-- Logo -->
    <div class="logo pull-left">
        <a href="index">
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
        <div class="" style="margin-right: 60px;width: 100%;top: 0;position: absolute;right: -90%;">
            <span class="tl_item">
                <a href="#" style="text-transform: capitalize;padding: 0 10px;">About</a> | <a href="#" style="text-transform: capitalize;padding: 0 10px;">Contact</a></span>
        </div>

    </div><div class="sub_menu" style="width:100%;">
            <div class="sub_cont">
                <ul style="left: 35%;float:left;">
                    <li><a id="menu_book" href="#" class="">Book</a></li>
                    <li><a id="menu_hotels" href="/hotels" class="">Hotels</a></li>
                    <li><a id="menu_south" href="#" class="">South Florida</a></li>
                    <li><a id="menu_events" href="#" class="">Events</a></li>
                    <?php if ($_SESSION['user']['login'] == "") {?>
                      <li><a href="" id='login' data-toggle="modal" data-target="#modalLogin" class="">Login</a></li>
                    <?php }else {?>
                      <li><a href="" id='logout' class="">Logout</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['user']['login'] != "") {?><li><a href='user-profile' id='user-name' class=""><?php echo ucfirst($_SESSION['user']['login']); ?></a></li><?php }else{?> <li><a id='user-name' class=""></a></li> <?php } ?>
                    <li class="right_sub no_arrow sub_min_width"><a href="#" class="parents">
                      <i class="ti-search"></i></a>
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
        <style>
             /*.sub_menu_custom li,*/
            /*.rounded .sub_menu_custom li,*/
            /*.rounded .sub_menu_custom a:hover:before,*/
            /*.rounded .sub_menu_custom a.active:before*/
            /*{*/
                /*border-radius: 3px!important*/
            /*}*/
            /*.white_bck .sub_menu_custom a, .white_bck .sub_menu_custom {*/
                /*color: #3D3830;*/
                /*padding: 0;*/
                /*margin: 15px 10px 0 10px;*/
            /*}*/
            /*.white_bck .sub_menu_custom li  {*/
                /*color: #949494;*/
                /*border-left: 0px solid #e4e4e4*/
            /*}*/
            /*.black_bck .sub_menu_custom li, .black_bck .main_menu {*/
                /*border-left: 1px solid #222*/
            /*}*/
            /*.open.passp_green .sub_menu_custom li {*/
                /*background: #09c0a4*/
            /*}*/
            /*.open .sub_menu_custom li a:hover, .open .sub_menu li a.active {*/
                /*color: #fff*/
            /*}*/
            /*.sub_menu_custom {*/
                /*float: left;*/
                /*height:70px;*/
                /*position: relative;*/
                /*top:-20px*/
            /*}*/
            /*.sub_menu_custom ul ul i {*/
                /*display: inline-block;*/
                /*width: 22px*/
            /*}*/
            /*.sub_menu_custom ul li:last-child .mega_menu {*/
                /*right: 0!important*/
            /*}*/
            /*.sub_menu_custom ul ul li {*/
                /*float: none;*/
                /*border: 0!important;*/
                /*height: auto;*/

            /*}*/
            /*.sub_menu_custom ul ul li:last-child {*/
                /*border-bottom: 0!important*/
            /*}*/
            /*.sub_menu_custom ul ul li a {*/
                /*height: auto;*/
                /*padding:5px 10px;*/
                /*font-size: 14px*/
            /*}*/
            /*header.no_border .sub_menu_custom li {*/
                /*border: 1px solid rgba(255, 255, 255, 0.18);*/
                /*margin-left: 2px;*/
            /*}*/
            /*header.no_border .sub_menu_custom ul ul li {*/
                /*margin-left: 0*/
            /*}*/
            /*header.no_border .sub_menu_custom a {*/
                /*height: 46px*/
            /*}*/
            /*.open header.no_border .sub_menu_custom ul > li {*/
                /*background: rgba(41,41,41,0.8)*/
            /*}*/
            /*header.no_border .sub_menu {*/
                /*transition:0.3s all!important;*/
            /*}*/
            /*.sub_menu_custom a {*/
                /*padding:5px 10px!important;*/
                /*font-size: 14px!important;*/
                /*height: auto!important;*/
                /*margin-left: 0;*/
                /*color: #949494!important*/
            /*}*/
            /*.sub_menu_custom a.active, .sub_menu_custom a:hover {*/
                /*color: #fff!important;*/
                /*background: none*/
            /*}*/
            /*.sub_menu_custom a:before {*/
                /*display: none!important*/
            /*}*/
            /*.sub_menu_custom .search_block {*/
                /*opacity: 1;*/
                /*margin: 20px 0 40px;*/
                /*border: 0;*/
                /*padding: 0*/
            /*}*/
            /*.sub_menu_custom ul {*/
                /*list-style: none;*/
                /*margin: 0;*/
                /*padding: 0;*/
                /*transition:0.3s all;*/
                /*position: relative;*/
                /*transition-origin:100%;*/
                /*right: 0;*/
                /*height: 70px;*/
                /*float: left;*/
            /*}*/
            /*.sub_menu_custom li {*/
                /*float: left;*/
                /*border-left: 0px solid rgba(255,255,255,0.18);*/
                /*height: 70px;*/
                /*transition:0.3s all;*/
            /*}*/
            /*.sub_menu_custom a {*/
                /*font: 400 17px/24px Oswald;*/
                /*color: #3D3830;*/
                /*padding: 20px 15px 10px;*/
                /*display: block;*/
                /*position: relative;*/
                /*margin: 4px;*/
                /*text-decoration: none;*/
                /*text-transform: capitalized;*/
                /*transition:0.3s all;*/
                /*height: 35px;*/
            /*}*/
            /*.sub_menu_custom ul ul a {*/
                /*color: #949494*/
            /*}*/
            /*.sub_menu_custom a:hover, .sub_menu_custom a.active {*/
                /*transition:0.3s all;*/
                /*color: #262626;*/
                /*background: #fff url(../images/line.png) no-repeat 100% 100%;*/
                /*background-size: 150px 4px;*/
            /*}*/
            /*.sub_menu_custom a:before {*/
                /*transition:0.3s all;*/
                /*background: none;*/
                /*display: block;*/
                /*content: "";*/
                /*right: 100%;*/
                /*position: absolute;*/
                /*z-index: -1;*/
                /*left: 0;*/
                /*top: 0;*/
                /*bottom: 0;*/
                /*right: 0;*/
                /*border:0 solid rgba(255,255,255,0.18);*/
            /*}*/
            /*.sub_menu_custom a:hover:before, .sub_menu_custom a.active:before {*/
                /*background: #ededed;*/
            /*}*/
            /*.sub_menu_custom .search_block .form-control {*/
                /*position: absolute;*/
                /*width: 100%*/
            /*}*/
            /*.sub_menu_custom ul {*/
                /*right: 0!important;*/
                /*height: auto;*/
            /*}*/
            /*.sub_menu_custom li {*/
                /*float: none;*/
                /*height: auto;*/
                /*border: 0!important*/
            /*}*/

            /*.sub_menu_custom {*/
                /*position: fixed;*/
                /*width: 100%;*/
                /*height:0;*/
                /*text-align: left;*/
                /*border: 0;*/
                /*z-index: 5;*/
                /*left: 0;*/
                /*top:78px;*/
                /*transition:0.2s all;*/
                /*opacity: 0*/
            /*}*/
            /*.white_bck .sub_menu {*/
                /*top: 68px;*/
            /*}*/

            /*.sub_menu_custom ul ul {*/
                /*position: relative;*/
                /*width: 100%;*/
                /*background: none;*/
                /*padding-left:20px;*/
                /*border: 0;*/
                /*margin: 0!important*/
            /*}*/
            /*.sub_menu_custom ul ul li {*/
                /*border: 0!important;*/
            /*}*/
            /*.sub_menu_custom ul {*/
                /*width: 100%*/
            /*}*/
             /*.sub_menu_custom a {*/
                 /*padding:5px 10px!important;*/
                 /*font-size: 14px!important;*/
                 /*height: auto!important;*/
                 /*margin-left: 0;*/
                 /*color: #949494!important*/
             /*}*/
             /*.sub_menu_custom a.active, .sub_menu_custom a:hover {*/
                 /*color: #fff!important;*/
                 /*background: none*/
             /*}*/
             /*.sub_menu_custom a:before {*/
                 /*display: none!important*/
             /*}*/
             /*.sub_menu_custom .search_block {*/
                 /*opacity: 1;*/
                 /*margin: 20px 0 40px;*/
                 /*border: 0;*/
                 /*padding: 0*/
             /*}*/
             /*.sub_menu_custom .search_block .form-control {*/
                 /*position: absolute;*/
                 /*width: 100%*/
             /*}*/
             /*.tm .sub_menu_custom {*/
                 /*height: 100%;*/
                 /*opacity: 1*/

             /*}*/
             /*.sub_menu_custom ul {*/
                 /*right: 0!important;*/
                 /*height: auto;*/
             /*}*/
             /*.sub_menu_custom li {*/
                 /*float: none;*/
                 /*height: auto;*/
                 /*border: 0!important*/
             /*}*/
             /*.sub_menu_custom {*/
                 /*position: fixed;*/
                 /*width: 100%;*/
                 /*height:0;*/
                 /*text-align: left;*/
                 /*border: 0;*/
                 /*z-index: 5;*/
                 /*left: 0;*/
                 /*top:78px;*/
                 /*transition:0.2s all;*/
                 /*opacity: 0*/
             /*}*/
             /*.white_bck .sub_menu_custom {*/
                 /*top: 68px;*/
             /*}*/

             /*.sub_menu_custom ul ul {*/
                 /*position: relative;*/
                 /*width: 100%;*/
                 /*background: none;*/
                 /*padding-left:20px;*/
                 /*border: 0;*/
                 /*margin: 0!important*/
             /*}*/
             /*.sub_menu_custom ul ul li {*/
                 /*border: 0!important;*/
             /*}*/
        </style>
        <!-- Sub Menu End -->


    </div>
    <!-- Header Buttons End -->

    <!-- Up Arrow -->
    <a href="#page" class="up_block go"><i class="fa fa-angle-up"></i></a>

</header>
<!-- Header End -->
<section class="booking-form" style="
    /* top: 50%; */
    position: absolute;
    height: auto;
    z-index: 4;
    bottom: 0;
">
    <div class="container-fluid" style="background-color: rgba(0,160,174,0.8);height: 146px;/* margin: 0 50px; */">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center" style="color:#fff;text-transform:capitalize;margin-top:15px;margin-bottom:10px;font-size: 30px;">Ready to play tourist? <span style="
    font-size: 22px;
">Book your next staycation and get great perks</span></h3>

                <form class="form-inline" style="
    margin: 15px 38px;
">
                    <div class="col-md-5">
                        <label class="sr-only" for="exampleInputEmail3" style="color: #fff;">Email address</label>
                        <div class="form-group" style="width: 100%;">
                            <div class="input-group" style="
    width: 100%;
">
                                <div class="input-group-addon" style="border: 0;background-color: #fff;border-radius: 0;"><i class="fa fa-search" style="
    font-size: 22px;
"></i></div>
                                <input type="text" class="form-control " id="locationSearch" placeholder="Where do you want to go?" style="width: 100%;border: 0;height: 45px;font-size: 16px;">
                                <span style="opacity: 1; left: 451px; top: 16px; width: 19px; min-width: 19px; height: 13px; position: absolute; border: none; display: inline; visibility: visible; z-index: 2; background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAANCAYAAABLjFUnAAAACXBIWXMAAAsTAAALEwEAmpwYAAABMmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarZG9SsNQGIaf04qCQxAJbsLBQVzEn61j0pYiONQokmRrkkMVbXI4Of508ia8CAcXR0HvoOIgOHkJboI4ODgECU4i+EzP9w4vL3zQWPE6frcxB6PcmqDnyzCK5cwj0zQBYJCW2uv3twHyIlf8RMD7MwLgadXr+F3+xmyqjQU+gc1MlSmIdSA7s9qCuATc5EhbEFeAa/aCNog7wBlWPgGcpPIXwDFhFIN4BdxhGMXQAHCTyl3AtercArQLPTaHwwMrN1qtlvSyIlFyd1xaNSrlVp4WRhdmYFUGVPuq3Z7Wx0oGPZ//JYxiWdnbDgIQC5M6q0lPzOn3D8TD73fdMb4HL4Cp2zrb/4DrNVhs1tnyEsxfwI3+AvOlUD7FY+VVAAAAIGNIUk0AAHolAACAgwAA9CUAAITRAABtXwAA6GwAADyLAAAbWIPnB3gAAAECSURBVHjapNK9K8UBFIfxD12im8LEYLgZjcpgUFgUCUlZTJRkMpqUxR+hDFIGhWwGwy0MFiUxSCbZ5DXiYjnqdvvpvnim0+mcZ/ieU9U6tySBNEbQjBpMoANZnGIdl4VLKcm8YCPqbgzhAT1ox1mSrFpxjtCHLdygH5tJgymlMYhhtKH+r6FishYsYBpN0dvFHu5wi9okWToC/0AmcpqM+pd7PKMRDajDNb5xlS97Qyem0BsL8IT9uOAhXpGLvL/wGXO5fFkOO7FwHvJtLOOilGALM8vE1d6xiFVlkP8aXTjAI8bKFeXLBuJ3shjFiQpIYR6zWMFaXFOlsnHM4Ng/+RkAdVE2mEeC7WYAAAAASUVORK5CYII=&quot;); background-position: 0px 0px; background-repeat: no-repeat;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker4">

                <span class="input-group-addon" style="
    border: 0;
    border-radius: 0;
    background-color: #fff;
"><span class="fa fa-calendar"></span>
                </span>
                                <input type="text" class="form-control" id="date-from" name="date-from" placeholder="Check In" style="
    border: 0;
    height: 45px;
    font-size: 16px;
">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker4">

                <span class="input-group-addon" style="
    border: 0;
    border-radius: 0;
    background-color: #fff;
"><span class="fa fa-calendar"></span>
                </span>
                                <input type="text" class="form-control" id="date-to" name="date-to" placeholder="Check Out" style="
    border: 0;
    height: 45px;
    font-size: 16px;
">
                            </div>
                        </div>
                    </div>
                    <!-- <script type="text/javascript">
                        $(function() {
                            // Bootstrap DateTimePicker v4
                            jQuery('#datetimepicker').datetimepicker({
                                format: 'DD/MM/YYYY'
                            });
                        });

                    </script> -->

                    <div class="col-md-3 text-center">
                        <button type="submit" class="btn btn-default bookbtn" style="
    height: 45px;
    width: 200px;
    border: 0;
    background-color: #ffbf3b;
    color: #fff !important;
    font-size: 140%;
">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
