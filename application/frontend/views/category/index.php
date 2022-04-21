<?php
    $xhtmlCategories = '';
    if(isset($this->items)){
        foreach($this->items as $itemCategory){
            $categoryName       = $itemCategory->name;
            $id                 = $itemCategory->id;
            $nameURL            = URL::filterURL($categoryName);
            $linkCategoryDetail = URL::createLink('frontend', 'book', 'index', ['category_id' => $itemCategory->id], "$nameURL-$id.html");
            $picture            = HelperFrontend::createImage('category', $itemCategory->picture, ['class' => 'img-fluid blur-up lazyload bg-img']);

            $xhtmlCategories .= '
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="'.$linkCategoryDetail.'">'.$picture.'</a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <a href="'.$linkCategoryDetail.'"><h4>'.$categoryName.'</h4></a>
                    </div>
                </div>';
        }
    }
?>

<!-- TITLE -->
<?php echo HelperFrontend::createTitle('Danh mục sách') ?>
<section class="ratio_asos j-box pets-box section-b-space" id="category">
    <div class="container">
        <div class="no-slider five-product row">
            <?php echo $xhtmlCategories ?>
        </div>
        <!-- Start Show Pagination Category Page -->
        <?php echo $this->pagination->showPaginationFrontend();?>
        <!-- End Show Pagination Category Page -->
    </div>
</section>