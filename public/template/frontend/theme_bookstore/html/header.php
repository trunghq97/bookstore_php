<?php

    $categoryID     = $this->arrParams['category_id'] ?? '';

    $imageURL       = $this->_dirImg;
    $linkHome       = URL::createLink('frontend', 'index', 'index', null, 'index.html');
    $linkCategory   = URL::createLink('frontend', 'category', 'index', null, 'danh-muc.html');
    $linkBook       = URL::createLink('frontend', 'book', 'index', null, 'sach.html');
    $linkLogin      = URL::createLink('frontend', 'index', 'login', null, 'dang-nhap.html');
    $linkRegister   = URL::createLink('frontend', 'index', 'register', null, 'dang-ky.html');
    $linkLogout     = URL::createLink('frontend', 'index', 'logout');
    $linkAdminPage  = URL::createLink('backend', 'index', 'index');

    $userObj        = Session::get('user');
    $userNameLogged = $userObj['info']['username'] ?? '';
    $linkUser       = URL::createLink('frontend', 'user', 'index', ['id' => $userObj['info']['id'] ?? ''], 'tai-khoan.html');


    $arrayMenuUserUser      = [];
    if(isset($userObj['login']) == true){
        $arrayMenuUser[]    = ['link' => $linkUser,     'name' => 'Tài khoản',  'class' => ''];
        // $arrayMenuUser[] = ['link' => $linkAdminPage,'name' => 'Trang quản trị', 'class' => ''];
        $arrayMenuUser[]    = ['link' => $linkLogout,   'name' => 'Đăng xuất',  'class' => ''];
    }else{
        $arrayMenuUser[]    = ['link' => $linkRegister, 'name' => 'Đăng ký',    'class' => ''];
        $arrayMenuUser[]    = ['link' => $linkLogin,    'name' => 'Đăng nhập',  'class' => ''];
    }

    $xhtml = '';
    foreach($arrayMenuUser as $key => $value){
        $xhtml .= sprintf('<li><a href="%s" class="%s">%s</a></li>', $value['link'], $value['class'], $value['name']);
    }

    require_once PATH_LIBRARY_EXT . 'XML.php';
    $categoryList = XML::getContentXML('categories.xml');

    $xhtmlCategoryList = '';
    if(!empty($categoryList)){
        foreach($categoryList as $key => $value){
            $id         = $value->id;        
            $name       = $value->name;
            $nameURL    = URL::filterURL($name);
            $link       = URL::createLink('frontend', 'book', 'index', ['category_id' => $id], "$nameURL-$id.html");
    
            if($categoryID == $id){
                $xhtmlCategoryList .= '<li><a class="my-menu-link active" href="'.$link.'">'.$name.'</a></li>';
            }else{
                $xhtmlCategoryList .= '<li><a href="'.$link.'">'.$name.'</a></li>';
            }
            // '<li><a title="'.$name.'" href="'.$link.'">'.$name.'</a></li>';
        }
    }

    $controller = !empty($this->arrParams['controller']) ? $this->arrParams['controller'] : '';
    $action     = !empty($this->arrParams['action']) ? $this->arrParams['action'] : '';



?>
<!-- <div class="loader_skeleton">
    <div class="typography_section">
        <div class="typography-box">
            <div class="typo-content loader-typo">
                <div class="pre-loader"></div>
            </div>
        </div>
    </div>
</div> -->
<header class="my-header sticky">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="brand-logo">
                            <a href="<?php echo $linkHome ?>">
                                <h2 class="mb-0" style="color: #5fcbc4">BookStore</h2>
                            </a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li><div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div></li>
                                    <li><a href="<?php echo $linkHome ?>" data-active='index-index'>Trang chủ</a></li>
                                    <li><a href="<?php echo $linkBook ?>" data-active='book-index' >Sách</a></li>
                                    <li>
                                        <a href="<?php echo $linkCategory ?>" data-active='category-index'>Danh mục</a>
                                        <ul><?php echo $xhtmlCategoryList ?></ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="top-header">
                            <ul class="header-dropdown">
                                <li class="onhover-dropdown mobile-account">
                                    <img src="<?= $imageURL ?>avatar.png" alt="avatar">
                                    <span><?php echo $userNameLogged ?></span>
                                    <ul class="onhover-show-div">
                                        <?php echo $xhtml; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div>
                                            <img src="<?= $imageURL ?>search.png" onclick="openSearch()" class="img-fluid blur-up lazyload" alt="">
                                            <i class="ti-search" onclick="openSearch()"></i>
                                        </div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div>
                                                <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form action="" method="GET">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="search" id="search-input" placeholder="Tìm kiếm sách...">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart">
                                        <div>
                                            <a href="cart.html" id="cart" class="position-relative">
                                                <img src="<?= $imageURL ?>cart.png" class="img-fluid blur-up lazyload" alt="cart">
                                                <i class="ti-shopping-cart"></i>
                                                <span class="badge badge-warning">0</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
