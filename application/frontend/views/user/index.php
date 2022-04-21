<?php

    $userObj	= Session::get('user');
    $userInfo   = $userObj['info'];    
    // Input
    $inputEmail     = FormFrontend::cmsInput('text', 'form[email]', 'email', $userInfo['email'] ?? '', 'form-control', 'readonly');
    $inputFullName  = FormFrontend::cmsInput('text', 'form[fullname]', 'fullname', $userInfo['fullname'] ?? '', 'form-control');
    $inputPhone     = FormFrontend::cmsInput('text', 'form[phone]', 'phone', '0' . $userInfo['phone'] ?? '', 'form-control');
    $inputAddress   = FormFrontend::cmsInput('text', 'form[address]', 'address', $userInfo['address'] ?? '', 'form-control');
    $inputToken     = FormFrontend::cmsInput('hidden', 'form[token]', 'token', time());

    // Row Form
    $rowEmail       = FormFrontend::cmsRowForm('email', 'Email', $inputEmail, '', 'form-group');
    $rowFullName    = FormFrontend::cmsRowForm('fullname', 'Họ tên', $inputFullName, '', 'form-group');
    $rowPhone       = FormFrontend::cmsRowForm('phone', 'Số điện thoại', $inputPhone, '', 'form-group');
    $rowAddress     = FormFrontend::cmsRowForm('address', 'Địa chỉ', $inputAddress, '', 'form-group');

    // Link
    // $linkChangePassword = URL::createLink('frontend', 'user', 'change_password', ['id' => $dataForm['id']]);
    $linkInfoUser       = URL::createLink('frontend', 'user', 'index', ['id' => $userInfo['id']]);
    $linkChangePassword = URL::createLink('frontend', 'user', 'formChangePassword', ['id' => $userInfo['id']]);
    $linkLogout         = URL::createLink('frontend', 'index', 'logout');
    $btnSubmit          = FormFrontend::button('submit', 'submit', 'submit', 'Cập nhật thông tin', 'btn btn-solid btn-sm');
    
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

    $linkAction = URL::createLink('frontend', 'user', 'index', ['id' => $userInfo['id']]);
?>

<?php echo HelperFrontend::createTitle('THÔNG TIN TÀI KHOẢN') ?>
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
                            <?php echo $rowEmail . $rowFullName . $rowPhone . $rowAddress ?>
                            <?php echo $inputToken . $btnSubmit ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
