<?php
//$inputUserName      = FormFrontend::cmsInput('text', 'form[username]'   , 'username' , $dataForm['username'] ?? '', 'form-control');
$inputEmail         = FormFrontend::cmsInput('text', 'form[email]', 'email', NULL, 'form-control');
$inputPassword      = FormFrontend::cmsInput('text', 'form[password]', 'password', NULL, 'form-control');
$inputToken         = FormFrontend::cmsInput('hidden', 'form[token]', 'token', time());

// Row Form
// $rowUserName        = FormFrontend::cmsRowForm('username'   ,'Tên tài khoản', $inputUserName ,'require');
$rowPassword        = FormFrontend::cmsRowForm('password', 'Mật khẩu', $inputPassword, 'required', 'form-group');
$rowEmail           = FormFrontend::cmsRowForm('email', 'Email', $inputEmail, 'required', 'form-group');

// Link
$linkAction     = URL::createLink('frontend', 'index', 'login');
$linkRegister   = URL::createLink('frontend', 'index', 'register');

$btnSubmit          = FormFrontend::button('submit', 'submit', 'form[submit]', 'Đăng nhập', 'btn btn-solid');

?>
<?php echo HelperFrontend::createTitle('Đăng nhập tài khoản') ?>
<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Đăng nhập</h3>
                <div class="theme-card">
                    <?php echo $this->errors ?? '' ?>
                    <form action="" method="post" id="admin-form" class="theme-form">
                        <?php echo $rowEmail . $rowPassword ?>
                        <?= $inputToken . $btnSubmit ?> 
                    </form>
                </div>
            </div>
            <div class="col-lg-6 right-login">
                <h3>Khách hàng mới</h3>
                <div class="theme-card authentication-right">
                    <h6 class="title-font">Đăng ký tài khoản</h6>
                    <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                        able to order from our shop. To start shopping click register.</p>
                    <a href="<?php echo $linkRegister ?>" class="btn btn-solid">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</section>