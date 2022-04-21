<?php

    $userObj	= Session::get('user');
    $userInfo   = $userObj['info'];

    // Input
    $inputOldPassword   = FormFrontend::cmsInput('text', 'form[oldpassword]', 'oldpassword',  '', 'form-control');
    $inputNewPassword   = FormFrontend::cmsInput('text', 'form[newpassword]', 'newpassword',  '', 'form-control');
    $inputToken     = FormFrontend::cmsInput('hidden', 'form[token]', 'token', time());

    // Row Form
    $rowOldPassword = FormFrontend::cmsRowForm('oldpassword', 'Nhập mật khẩu cũ', $inputOldPassword, '', 'form-group');
    $rowNewPassword = FormFrontend::cmsRowForm('newpassword', 'Nhập mật khẩu mới', $inputNewPassword, '', 'form-group');
   
    // Link
    $linkChangePassword = URL::createLink('frontend', 'user', 'formChangePassword', ['id' => $userInfo['id']]);
    $linkInfoAccount    = URL::createLink('frontend', 'user', 'index', ['id' => $userInfo['id']]);
    $linkLogout         = URL::createLink('frontend', 'index', 'logout');
    $btnSubmit          = FormFrontend::button('submit', 'submit', 'submit', 'ĐỔI MẬT KHẨU', 'btn btn-solid btn-sm btn-change');

    $message = Session::get('message');
    if(!empty($message)){
        $message = '<div class="alert alert-success" id="frontend-message" role="alert">
        '.$message['content'].'
        <button type="button" class="close">&times;</button>
        <strong>Sucess!</strong> Values updated!!
        <span aria-hidden="true">&times;</span>
        </div>';
    }else{
        $message = '';
    }
    $linkAction = URL::createLink('frontend', 'user', 'formChangePassword', ['id' => $userInfo['id']]);
?>

<?php echo HelperFrontend::createTitle('THAY ĐỔI MẬT KHẨU') ?>
<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="account-sidebar">
                    <a class="popup-btn">Menu</a>
                </div>
                <h3 class="d-lg-none">Tài khoản</h3>
                <div class="dashboard-left">
                    <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                aria-hidden="true"></i> Ẩn</span></div>
                    <div class="block-content">
                        <ul>
                            <?php require_once 'elements/menu.php' ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <?php echo $message ?>
                        <form action="<?php echo $linkAction ?>" method="POST" id="admin-form" class="theme-form">
                            <?php echo $rowOldPassword . $rowNewPassword ?>
                            <?php echo $inputToken . $btnSubmit ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
