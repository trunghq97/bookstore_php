<?php
    $model = new Model;
    $query      = "SELECT `b`.`id`, `b`.`name`, `c`.`name` AS `category_name`, `b`.`picture`, `b`.`price`, `b`.`sale_off`, `b`.`category_id`"; 
    $query      .= "FROM `" . TBL_BOOK . "` AS `b`, `".TBL_CATEGORY."` AS `c`";
    $query      .= "WHERE `b`.`status`='active' AND `special` = 1 AND `b`.`category_id` = `c`.`id` ORDER BY `b`.`ordering` ASC LIMIT 0, 5";
    $listBooks  = $model->fetchAll($query);

    $xhtmlFeaturedBooks = '';
    foreach ($listBooks as $book) {
        $xhtmlFeaturedBooks .= HelperFrontend::specialBook($book);
    }
?>

<div class="theme-card">
    <h5 class="title-border">Sách nổi bật</h5>
    <div class="offer-slider slide-1">
        <?php echo $xhtmlFeaturedBooks ?>
    </div>
</div>




 


