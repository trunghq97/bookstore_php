<?php require_once 'elements/slider.php' ?>
<?php require_once 'elements/special_book.php' ?>
<?php require_once 'elements/categories.php' ?>
<?php require_once 'elements/service.php' ?>

<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Danh mục nổi bật</h2>
    <hr role="tournament6">
</div>
<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
            <div class="theme-tab">
                        <ul class="tabs tab-title">
                            <?php echo $xhtmlMenuCategories ?>
                        </ul>
                        <div class="tab-content-cls">
                            <?php echo $xhtmlBooks ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section> <!-- Tab product end -->

<?php require_once 'elements/quickview.php' ?>
