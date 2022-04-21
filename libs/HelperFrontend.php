<?php
class HelperFrontend{
    public static function createTitle($title){
        $xhtml = '<div class="breadcrumb-section" style="margin-top: 107px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title">
                                    <h2 class="py-2">'.$title.'</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        return $xhtml;
    }

    public static function specialBook($books){
        $bookID             = $books['id'];
        $categoryID         = $books['category_id'];
        $bookName           = $books['name'];
        $categoryName       = $books['category_name'] ?? '';
        $bookNameURL        = URL::filterURL($bookName);
        $categoryNameURL    = URL::filterURL($categoryName);
        $bookSaleOff        = $books['sale_off'];
        $linkBookDetail     = URL::createLink('frontend', 'book', 'detail', 
        ['category_id' => $categoryID, 'book_id' => $bookID], "$categoryNameURL/$bookNameURL-$categoryID-$bookID.html");
        $bookPrice          = $books['price'];
        $picture            = self::createImage('book', $books['picture'], ['class' => 'img-fluid blur-up lazyload']);
        $priceReal          = ($bookSaleOff > 0) ? (100-$bookSaleOff) * ($bookPrice/100) : $bookPrice;

        $xhtml = '
            <div>
                <div class="media">
                    <a href="'.$linkBookDetail.'">'.$picture.'</a>
                    <div class="media-body align-self-center">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="'.$linkBookDetail.'" title="'.$bookName.'">
                            <h6>'.$bookName.'</h6>
                        </a>
                        <h4 class="text-lowercase">'.number_format($priceReal).' đ <del>'.number_format($bookPrice).' đ</del></h4>
                    </div>
                </div>
            </div>';
        return $xhtml;
    }

    public static function productBox($itemBook){
        
        $bookID           = $itemBook['id'];
        $categoryID       = $itemBook['category_id'];
        $bookName         = $itemBook['name'];
        $categoryName     = $itemBook['category_name'] ?? '';
        $bookNameURL      = URL::filterURL($bookName);
        $categoryNameURL  = URL::filterURL($categoryName);



        $linkBookDetail   = URL::createLink('frontend', 'book', 'detail', ['category_id' => $categoryID, 'book_id' => $bookID], 
                            "$categoryNameURL/$bookNameURL-$categoryID-$bookID.html");
        $bookPrice        = $itemBook['price'];
        $bookSaleOff      = $itemBook['sale_off'];

        $priceReal        = $bookSaleOff > 0 ? (100-$bookSaleOff) * ($bookPrice/100) : $bookPrice;
        
        $picture = self::createImage('book', $itemBook['picture'], ['class' => 'img-fluid blur-up lazyload bg-img']);

        $xhtml = '
                    <div class="product-box">
                        <div class="img-wrapper">
                            <div class="lable-block">
                                <span class="lable4 badge badge-danger"> -'.$bookSaleOff.'%</span>
                            </div>
                            <div class="front">
                                <a href="'.$linkBookDetail.'">
                                    '.$picture.'
                                </a>
                            </div>
                            <div class="cart-info cart-wrap">
                                <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <a href="'.$linkBookDetail.'" title="'.$bookName.'">
                                <h6>'.$bookName.'</h6>
                            </a>
                            <h4 class="text-lowercase">' . number_format($priceReal) . ' đ <del>' . number_format($bookPrice) . ' đ</del></h4>
                        </div>
                    </div>';
        return $xhtml;
    }

    // Create Image
    public static function createImage($folder, $pictureName, $attribute = null){
        $class      = !empty($attribute['class'])  ? 'class='. "{$attribute['class']}"    : '';
        $width      = !empty($attribute['width'])  ? 'width='. "{$attribute['width']}"    : '';
        $height     = !empty($attribute['height']) ? 'height='. "{$attribute['height']}"   : '';
        $strAttribute = $class . $width . $height;

        $picturePath        = PATH_UPLOAD . $folder . DS . $pictureName; 
        if(file_exists($picturePath)){
            $picture        = '<img '.$strAttribute.' src="' . URL_UPLOAD . $folder . DS . $pictureName . '">';
        }else{
            $picture        = '<img '.$strAttribute.' src="' . URL_UPLOAD . $folder . DS . 'default-picture.jpg' . '">';
        }
        return $picture;
    }
}
?>