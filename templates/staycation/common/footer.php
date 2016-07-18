<?php
require(SYSBASE."templates/".TEMPLATE."/common/login.php");
require(SYSBASE."templates/".TEMPLATE."/common/signup.php");
?>

<input type="hidden" id="logout-user" value="<?php echo $_SESSION['user'] ?>">
<!-- Footer -->
<div class="footer white_txt image_bck" data-color="#0e0e0e" style="padding-top:0;margin-top:0">
    <div class="container"  style="height:auto; padding:60px; background-color: rgb(14, 14, 14);">

        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class=" text-left">
                    <a href="index"><img style="margin-bottom:20px" src="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/images/logo-white.png"/></a>
                </div>
                We provide amazing experiences when it comes to booking a hotel at the last minute!
            </div>

            <div class="col-md-3 col-sm-3 hidden-xs">
                <div class="widget">
                    <h4>Recent Posts</h4>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#">Labore et dolore magna aliqua</a>
                            <span class="date">July
                                <span class="number">22, 2015</span>
                            </span>
                        </li>
                        <li>
                            <a href="#">Labore et dolore magna aliqua</a>
                            <span class="date">July
                                <span class="number">14, 2015</span>
                            </span>
                        </li>
                        <li>
                            <a href="#">Labore et dolore magna aliqua</a>
                            <span class="date">July
                                <span class="number">11, 2015</span>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="col-md-3 col-sm-3 hidden-xs">
                <div class="widget">
                    <h4>Latest Updates</h4>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#">Labore et dolore magna aliqua</a>
                            <span class="date">July
                                <span class="number">22, 2015</span>
                            </span>
                        </li>
                        <li>
                            <a href="#">Labore et dolore magna aliqua</a>
                            <span class="date">July
                                <span class="number">14, 2015</span>
                            </span>
                        </li>
                        <li>
                            <a href="#">Labore et dolore magna aliqua</a>
                            <span class="date">July
                                <span class="number">11, 2015</span>
                            </span>
                        </li>
                    </ul>
                </div>
                <!--end of widget-->
            </div>

            <div class="col-md-3 col-sm-3 hidden-xs">
                <div class="widget">
                    <h4>Contacts</h4>
                    <span class="contacts_ti ti-mobile"></span>+11 (0) 200 1111 001<br />
                    <span class="contacts_ti ti-mobile"></span>+11 (0) 200 1111 002<br />
                    <span class="contacts_ti ti-email"></span><a href="mailto:support@theberg.com">support@theberg.com</a><br />
                    <span class="contacts_ti ti-location-pin"></span>Australia place nice, RD nice DHA Road, state pace 786
                </div>
                <!--end of widget-->
            </div>

        </div>
        <!--Row End-->

    </div>
    <!-- Container End -->

    <!-- Footer Copyrights -->
    <div class="footer_end"  style="margin-top:0;padding-top:0">
        <div class="container" style="height:auto; padding:80px; margin:0;">
            <div class="row">
                <div class="col-sm-6">
                    <span class="sub">&copy; Copyright 2018 - Staycation</span>
                </div>
                <div class="col-sm-6 text-right">
                    <ul class="list-inline social-list">

                        <li>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="ti-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <i class="ti-twitter-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Dribbble">
                                <i class="ti-dribbble"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Vimeo">
                                <i class="ti-vimeo-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyrights End -->


</div>
</div>
<!-- Footer End -->

<!-- Template -->

<!-- JQuery UI -->
<script src="js/jquery-1.11.3.min.js"></script>
<!-- JQuery UI -->
<script src="js/jquery-ui.js"></script>
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>
<!-- Textillate -->
<script src="js/jquery.lettering.js"></script>
<!-- plugin -->
<script src="js/jquery.plugin.min.js"></script>
<!-- Magnific Popup core JS file -->
<!-- <script src="js/jquery.magnific-popup.js"></script> -->
<!-- WL Carousel JS -->
<script src="js/owl.carousel.min.js"></script>
<!-- Countdown -->
<script src="js/jquery.countdown.min.js"></script>
<!-- PrefixFree -->
<script src="js/prefixfree.min.js"></script>
<!-- modernizr -->
<script src="/common/js/modernizr-2.6.1.min.js"></script>
<!-- Wow -->
<script src="js/wow.js"></script>
<!-- Masonry -->
<script src="js/masonry.pkgd.min.js"></script>
<!-- Theme JS -->
<script src="js/script.js"></script>
<!-- custom -->
<script src="js/custom.js"></script>


<!-- Nuestros -->

<!-- search -->
<script src="js/search.js"></script>
<!-- featured -->
<script src="js/featured.js"></script>
<!-- login-signup -->
<script src="js/login-signup.js"></script>
<!-- likes -->
<script src="js/likes.js"></script>
<!-- hotel-details -->
<script src="js/hotel-details.js"></script>
<!-- User Profile -->
<script src="js/uprofile.js"></script>
<!-- Filter -->
<script src="js/filter.js"></script>
<!-- js\handlebars-v4.0.5.js -->
<script src="js/handlebars-v4.0.5.js"></script>
<!-- js\bootstrap-paginator.js -->
<script src="js/bootstrap-paginator.js"></script>
<!-- Google Map Api -->
<!--<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMBll-dqly2M_3tigoMDeX9ZxUxLUpNjc"></script>-->
</body>
</html>
