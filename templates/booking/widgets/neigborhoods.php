<ul class="nostyle">
    <?php
    $result = $db->query("
    SELECT
    n.id AS neigborhood_id,
    n.title AS neigborhood_title,
    n.alias AS neigborhood_alias,
    n.order_neighborhood AS neigborhood_order,
    h.title AS hotel_title,
    h.alias AS hotel_alias,
    hf.file as hotel_file,
    hf.id as hotel_file_id
    FROM pm_neighborhood AS n
    INNER JOIN pm_hotel AS h
    INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
    AND h.id = hf.id_item
    WHERE n.widget_enable =1
    AND h.featured_enable =1
    AND h.lang =".LANG_ID."
    AND hf.lang =".LANG_ID."
    ");

    if($result !== false){
      foreach($result as $i => $row){
        $neigborhood_id = $row['neigborhood_id'];
        $neigborhood_title = $row['neigborhood_title'];
        $neigborhood_alias = $row['neigborhood_alias'];
        $neigborhood_order = $row['neigborhood_order'];
        $hotel_title = $row['hotel_title'];
        $hotel_alias = $row['hotel_alias'];
        $hotel_file = $row['hotel_file'];
        $hotel_file_id = $row['hotel_file_id'];
        ?>
        <li>
          <span href="" class="neigborhood fake-link">
            <input type="hidden" id="neigborhood" value="<?php echo $neigborhood_id;?>">
            <?php  echo $neigborhood_title ?>
          </span>
          <a href="<?php echo "hotels/".$hotel_alias; ?>" title="<?php echo $hotel_title; ?>" class="img-container md">
            <input type="hidden" class="img" value="<?php echo $neigborhood_id;?>">
            <img src="<?php echo DOCBASE."medias/hotel/small/".$hotel_file_id."/".$hotel_file; ?>">
          </a>
        </li>
        <?php
      }
    }
    ?>
</ul>
