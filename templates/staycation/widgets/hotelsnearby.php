<?php

$neig_id = $db -> query("
select id_neighborhood from pm_hotel where id = ".$_GET['id']." and lang = 2
");

$nId = $neig_id->fetchAll();

$nerby = $db ->query("
SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
h.id AS hotel_id,
h.title AS hotel_title,
h.alias AS hotel_alias,
h.descr AS hotel_descr,
h.facilities AS hotel_facilities,
h.benefit AS hotel_benefit,
h.perk AS hotel_perk,
h.things AS hotel_things,
h.inside AS hotel_inside,
h.from_date AS hotel_from_date,
h.to_date AS hotel_to_date,
hf.file as hotel_file,
hf.id as hotel_file_id,
(SELECT AVG(price) FROM pm_room WHERE id_hotel = h.id) as price
FROM pm_neighborhood AS n
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
AND h.id = hf.id_item
WHERE n.id= ".$nId[0]['id_neighborhood']."
AND h.featured_enable =1
AND h.lang = ".LANG_ID."
AND hf.lang = ".LANG_ID."
");

 ?>
 <div class="widget">
          <h6 class="title">Hotels Nerby</h6>
          <ul class="list-unstyled recent-posts">
            <?php $i = 0 ?>
            <?php foreach ($nerby as $key => $value) {?>
              <li>
                <a class="clearfix recent_item details"href="#" data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>"><span class="recent_photo"><img alt="" src="<?php echo DOCBASE."medias/hotel/small/".$value['hotel_file_id']."/".$value['hotel_file']; ?>"></span>
                  <span class="recent_txt"><span style="color:#00a0ae"><?php echo $value['hotel_title'] ?></span><br>
                  From <strong>$ <?php echo number_format($value['price'], '2') ?>/Night</strong></span></a>
                </li>
                <?php if ($i >= 3) {
                  break;
                }
                $i++;
              } ?>
          </ul>
      </div>
