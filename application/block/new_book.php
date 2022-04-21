<?php
    $model      = new Model;
    $query      = "SELECT `b`.`id`, `b`.`name`, `c`.`name` AS `category_name`, `b`.`picture`, `b`.`price`, `b`.`sale_off`, `b`.`category_id`"; 
    $query      .= "FROM `" . TBL_BOOK . "` AS `b`, `".TBL_CATEGORY."` AS `c`";
    $query      .= "WHERE `b`.`status`='active' AND `sale_off` >= 0 AND `b`.`category_id` = `c`.`id` ORDER BY `b`.`ordering` DESC LIMIT 0, 5";
    $newBooks   = $model->fetchAll($query);
    
    $xhtmlNewBooks = '';
    foreach ($newBooks as $books) {
        $xhtmlNewBooks      .= HelperFrontend::specialBook($books);
    }
?>

<div class="theme-card mt-4">
    <h5 class="title-border">Sách mới</h5>
    <div class="offer-slider slide-1">
        <?php echo $xhtmlNewBooks ?>
    </div>
</div>