<?php
$stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";
$javascripts[] = DOCBASE."js/widget.js";


$stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";

require(SYSBASE."templates/".TEMPLATE."/common/header.php"); ?>

<section id="page">

    <?php include(SYSBASE."templates/".TEMPLATE."/common/page_header.php"); ?>

    <div id="content" class="pt30 pb20">
        <div class="container">
            <div class="row">
              <?php
              displayWidgets("right", $page_id);
              displayWidgets("left", $page_id);
              ?>
            </div>
        </div>
    </div>
</section>
