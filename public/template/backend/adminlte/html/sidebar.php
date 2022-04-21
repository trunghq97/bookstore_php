<?php

    $dashboardList  = URL::createLink('backend', 'index', 'index');


    // GROUP
    $groupList      = URL::createLink('backend', 'group', 'index');
    $groupForm      = URL::createLink('backend', 'group', 'form');

    // USER
    $userList       = URL::createLink('backend', 'user', 'index');
    $userForm       = URL::createLink('backend', 'user', 'form');

    // CATEGORY
    $categoryList   = URL::createLink('backend', 'category', 'index');
    $categoryForm   = URL::createLink('backend', 'category', 'form');

    // BOOK
    $bookList       = URL::createLink('backend', 'book', 'index');
    $bookForm       = URL::createLink('backend', 'book', 'form');

    // SLIDER
    $sliderList     = URL::createLink('backend', 'slider', 'index');
    $sliderForm     = URL::createLink('backend', 'slider', 'form');
?>

<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="<?= $this->_dirImg ?>logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Admin Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $this->_dirImg ?>avatar.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">ZendVN</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo $dashboardList ?>" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Group
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $groupList ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?php //$groupForm ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $userList ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $userForm ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $categoryList ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $categoryForm ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Book
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $bookList ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $bookForm ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $sliderList ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $sliderForm ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>