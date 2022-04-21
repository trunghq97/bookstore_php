<?php
    require_once PATH_LIBRARY_EXT . 'XML.php';
    $data           = XML::getContentXML('categories.xml');

    if(isset($this->arrParams['category_id'])){
        $categoryID = $this->arrParams['category_id'];    // category_id là thuộc tính của bảng Book
    }

    $xhtmlCategories = '';
    if(!empty($data)){
        foreach ($data as $itemCategory) {
            $id             = $itemCategory->id;
            $categoryName   = $itemCategory->name;
            $nameURL        = URL::filterURL($categoryName);
            $linkDetailCategory  = URL::createLink('frontend','book','index',['category_id' => $id], "$nameURL-$id.html");
            $xhtmlCategories    .= '<div class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">';
    
            if($categoryID == $id){
                $xhtmlCategories .= '<a class="my-text-primary" href="'.$linkDetailCategory.'">'.$categoryName.'</a>';
            }else{
                $xhtmlCategories .= '<a class="text-dark" href="'.$linkDetailCategory.'">'.$categoryName.'</a>';
            }
            $xhtmlCategories .= '</div>';
        }
    }
?>
<div class="collection-collapse-block open">
    <h3 class="collapse-block-title">Danh mục</h3>
    <div class="collection-collapse-block-content">
        <div class="collection-brand-filter">
            <?php echo $xhtmlCategories; ?>
            <div class="custom-control custom-checkbox collection-filter-checkbox pl-0 text-center">
                <span class="text-dark font-weight-bold" id="btn-view-more">Xem thêm</span>
            </div>
        </div>
    </div>
</div> 