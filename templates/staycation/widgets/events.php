<?php
$neigborhood = $db->query("
  SELECT * FROM `pm_neighborhood` WHERE widget_enable=1 order by order_neighborhood desc
");

$event = $db->query("
SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
n.order_neighborhood AS neigborhood_order,
e.order_featured as order_featured,
e.title AS article_title,
e.text AS article_text,
e.date AS article_date,
e.url AS article_url,
e.alias AS article_alias,
ef.file as article_file,
ef.id as article_file_id
FROM pm_neighborhood AS n
INNER JOIN pm_article AS e
INNER JOIN pm_article_file AS ef ON n.id = e.id_neighborhood
AND e.id = ef.id_item
WHERE n.widget_enable =1
AND e.featured_enable =1
AND e.lang =".LANG_ID."
AND ef.lang =".LANG_ID."
");

?>
<!--News-->
<section class="boxes" id="news">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 bordered_block grey_border">
                <div class="row gray_bck">
                    <h2 class="text-center">Events</h2>
                </div>
            </div>
        </div>
        <div class="row gray_bck">
            <ul class="filter text-center">
                <?php
                $id_neighborhood = "";
                foreach ($neigborhood as $key => $value) {
                    if ($value['order_neighborhood'] == "1") {
                        $id_neighborhood = $value['id']?>
                        <li style="text-decoration: underline;"><a href="#" data-event="<?php echo $value['title']; ?>" class="featured-event"><?php echo $value['title']; ?></a></li>
                    <?php
                    }else {?>
                        <li><a href="#" data-event="<?php echo $value['title']; ?>" class="featured-event"><?php echo $value['title']; ?></a></li>
                    <?php  } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="row">
            <!-- col -->
            <div class="col-md-12 bordered_block grey_border image-event" style="display:block">
                <div class="container white">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="masonry row">
                                <?php foreach($event as $i => $value){ ?>
                                    <?php if ($id_neighborhood == $value['neigborhood_id']) {?>
                                        <!--Item-->
                                        <div class="col-sm-4 post-snippet image-event">
                                            <span style="display:none"><?php echo $value['neigborhood_title'] ?></span>
                                            <a href="#">
                                                <img alt="" src="<?php echo DOCBASE."medias/article/big/".$value['article_file_id']."/".$value['article_file']; ?>" />
                                            </a>
                                            <div class="inner">
                                                <a href="#">
                                                    <h4 class="title"><?php echo $value['article_title'] ?></h4>
                                                    <span class="date"><?php echo date("Y-m-d",intval($value['article_date'])) ?></span>
                                                </a>
                                                <p>
                                                    <?php echo $value['article_text'] ?>
                                                </p>
                                                <a class="btn btn-default" target="_blank" href="<?php echo $value['article_url'] ?>">Read More</a>
                                            </div>
                                        </div>
                                    <?php }else {?>
                                        <!--Item-->
                                        <div class="col-sm-4 post-snippet  image-event" style="display:none">
                                            <span style="display:none"><?php echo $value['neigborhood_title'] ?></span>
                                            <a href="#">
                                                <img alt="" src="<?php echo DOCBASE."medias/article/big/".$value['article_file_id']."/".$value['article_file']; ?>" />
                                            </a>
                                            <div class="inner">
                                                <a href="#">
                                                    <h4 class="title"><?php echo $value['article_title'] ?></h4>
                                                    <span class="date"><?php echo $value['article_date'] ?></span>
                                                </a>
                                                <p>
                                                    <?php echo $value['article_text'] ?>
                                                </p>
                                                <a class="btn btn-default" target="_blank" href="<?php echo $value['article_url'] ?>">Read More</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Col End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                <!--News End-->
