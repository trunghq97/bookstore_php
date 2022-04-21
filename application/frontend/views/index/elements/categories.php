<?php
$xhtmlMenuCategories = '';
$xhtmlBooks = '';
if(!empty($this->featuredCategories)){
    foreach($this->featuredCategories as $key => $categories){
        $categoryID     = $categories['id'];
        $categoryName   = $categories['name'];
        
        if($key == 0){
            $xhtmlMenuCategories .= '<li class="current"><a href="tab-category-'.$categoryID.'" class="my-product-tab" data-category="'.$categoryID.'">'.$categoryName.'</a></li>';
            $xhtmlBooks .= '<div id="tab-category-'.$categoryID.'" class="tab-content" style="display: block;">
            <div class="no-slider row tab-content-inside">';
        }else{
            $xhtmlMenuCategories .= '<li><a href="tab-category-'.$categoryID.'" class="my-product-tab" data-category="'.$categoryID.'">'.$categoryName.'</a></li>';
            $xhtmlBooks .= '<div id="tab-category-'.$categoryID.'" class="tab-content" style="display: none;">
            <div class="no-slider row tab-content-inside">';
        }
      
        foreach($categories['books'] as $books){
            $linkViewBooks  = URL::createLink('frontend', 'book', 'index', ['category_id' => $books['category_id']]);
            if($categories['id'] == $books['category_id']){
                $books['category_name'] = $categoryName;
                $xhtmlBooks .= HelperFrontend::productBox($books);
            }
        }
        $xhtmlBooks .= '</div><div class="text-center"><a href="'.$linkViewBooks.'" class="btn btn-solid">Xem tất cả</a></div></div>';
    }
}
?>