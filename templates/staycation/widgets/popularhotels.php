<?php
$Topliked = $db ->query("
SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
n.order_neighborhood AS neigborhood_order,
h.id AS hotel_id,
h.title AS hotel_title,
h.alias AS hotel_alias,
hf.file as hotel_file,
hf.id as hotel_file_id,
(SELECT COUNT(id) from pm_like where id_hotel=h.id) as count,
(SELECT AVG(price) FROM pm_room WHERE id_hotel = h.id) as price
FROM pm_neighborhood AS n
INNER JOIN pm_like as l
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
INNER JOIN pm_room as r ON r.id_hotel=h.id
AND h.id = hf.id_item
AND h.lang = 2
AND hf.lang = 2
ORDER BY COUNT DESC
");
 ?>

 <div class="widget">
          <h6 class="title">Popular Hotels</h6>
          <ul class="list-unstyled recent-posts">
            <?php $counter = 0 ?>
            <?php foreach ($Topliked as $key => $value) {?>
              <li>
                <a class="clearfix recent_item details"href="#" data-id="<?php echo $value['hotel_id']; ?>" data-name="<?php echo $value['hotel_title']; ?>"><span class="recent_photo"><img alt="" src="<?php echo DOCBASE."medias/hotel/small/".$value['hotel_file_id']."/".$value['hotel_file']; ?>"></span>
                  <span class="recent_txt"><span style="color:#00a0ae"><?php echo $value['hotel_title'] ?></span><br>
                  From <strong>$ <?php echo number_format($value['price'], '2') ?>/Night</strong></span></a>
                </li>
                <?php if ($counter >= 3) {
                  break;
                }
                $counter++;
              } ?>
          </ul>
      </div>
