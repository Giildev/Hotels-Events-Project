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
                    <li><a id="menu_book" name="book-name" href="book" class="parents">Book</a></li>
                    <li><a id="menu_hotels" name="hotels-name" href="hotels" class="parents">Hotels</a></li>
                    <li><a id="menu_south" href="#" class="parents">South Florida</a></li>
                    <li><a id="menu_events" href="#" class="parents">Events</a></li>
                    <?php if ($_SESSION['user']['login'] == "") {?>
                      <li><a href="" id='login' data-toggle="modal" data-target="#modalLogin" class="parents">Login</a></li>
                    <?php }else {?>
                      <li><a href="/" id='logout' class="parents">Logout</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['user']['login'] != "") {?><li><a href="user-profile" id="user-name" name="user-name" class="parents"><?php echo ucfirst($_SESSION['user']['login']); ?></a></li><?php } ?>
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
    <a href="#page" class="up_block go"><i class="fa fa-angle-up"></i></a>

</header>
<!-- Header End -->

<section class="booking-form">
    <div class="container-fluid" style="background-color: rgba(0,160,174,0.8);height: 220px;">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center" style="color:#fff; text-transform:capitalize; margin-top:15px;margin-bottom:10px; font-size:35px;">
                It's time for a nice vacation!</h3>
                <h4 class="text-center" style="color:#fff;text-transform:capitalize;font-size: 23px;">
                Book your next vacation and get great perks</h4>
                <form class="form-inline" style="margin: 38px;">
                    <div class="col-md-5">
                        <label class="sr-only" for="exampleInputEmail3" style="color: #fff;">Email address</label>
                        <div class="form-group" style="width: 100%;">
                            <div class="input-group" style="width: 100%;">
                                <div class="input-group-addon" style="border: 0;background-color: #fff;border-radius: 0;">
                                    <i class="fa fa-search" style="font-size: 22px;"></i>
                                </div>
                                <input class="form-control" id="locationSearch" placeholder="Where do you want to go?"
                                style="width: 100%;border: 0;height: 45px;font-size: 16px;" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker4">
                                <span class="input-group-addon" style="border: 0;border-radius: 0;background-color: #fff;">
                                <span class="fa fa-calendar"></span></span>
                                <input class="form-control" id="date-from" name="date-from" placeholder="Check In" style="border: 0;height: 45px;font-size: 16px;"
                                type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker4">
                                <span class="input-group-addon" style="border: 0;border-radius: 0;background-color: #fff;">
                                <span class="fa fa-calendar"></span></span>
                                <input class="form-control" id="date-to" name="date-from" placeholder="Check Out" style="border: 0;height: 45px;font-size: 16px;"
                                type="text">
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                    // $(function() {
                    //     // Bootstrap DateTimePicker v4
                    //     $('#datetimepicker').datetimepicker({
                    //         format: 'DD/MM/YYYY'
                    //     });
                    // });

                    </script>
                    <div class="col-md-3 text-center">
                        <button class="btn btn-default bookbtn" style="height: 45px;float:right;width: 200px;border: 0;background-color: #ffbf3b;color: #fff !important;font-size: 140%;"
                        type="submit">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
