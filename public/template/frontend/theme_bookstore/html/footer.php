<?php
    $model          = new Model;
    $query          = "SELECT `id`, `name` FROM `".TBL_CATEGORY."` WHERE `status` = 'active' AND `show_at_home` = 1 ORDER BY `ordering` ASC";
    $listCategory   = $model->fetchAll($query);
    $categoryID     = $this->arrParams['category_id'] ?? '';    // category_id là thuộc tính của bảng Book 

    $xhtmlCategoriesFooter = '';
    foreach ($listCategory as $itemCategory) {
        $id             = $itemCategory['id'];
        $categoryName   = $itemCategory['name'];
        $nameURL        = URL::filterURL($categoryName);
        $linkCategory   = URL::createLink('frontend', 'book', 'index', ['category_id' => $id], "$nameURL-$id.html");
        $xhtmlCategoriesFooter .= '<li><a href="'.$linkCategory.'">'.$categoryName.'</a></li>';
    }
?>

<footer class="footer-light mt-5">
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row footer-theme partition-f">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-title footer-mobile-title">
                        <h4>Giới thiệu</h4>
                    </div>
                    <div class="footer-contant">
                        <div class="footer-logo">
                            <h2 style="color: #5fcbc4">BookStore</h2>
                        </div>
                        <p>Tự hào là website bán sách trực tuyến lớn nhất Việt Nam, cung cấp đầy đủ các thể loại
                            sách, đặc biệt với những đầu sách độc quyền trong nước và quốc tế</p>
                    </div>
                </div>
                <div class="col offset-xl-1">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Danh mục nổi bật</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <?php echo $xhtmlCategoriesFooter ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Chính sách</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li><a href="#">Điều khoản sử dụng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Hợp tác phát hành</a></li>
                                <li><a href="#">Phương thức vận chuyển</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Thông tin</h4>
                        </div>
                        <div class="footer-contant">
                            <ul class="contact-list">
                                <li><i class="fa fa-phone"></i>Hotline: <a href="tel:0378444108">0378444108</a></li>
                                <li><i class="fa fa-envelope-o"></i>Email: <a href="mailto:trunghq110997@gmail.com" class="text-lowercase">trunghq110997@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
<!-- footer end -->

<!-- tap to top -->
<div class="tap-top top-cls">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top end -->