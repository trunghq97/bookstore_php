<?php
    $dataForm           = $this->arrParams['form'] ?? '';

    $inputUserName      = FormFrontend::cmsInput('text', 'form[username]'   , 'username' , $dataForm['username'] ?? '', 'form-control');
    $inputEmail         = FormFrontend::cmsInput('text', 'form[email]'      , 'email'    , $dataForm['email'] ?? '', 'form-control');
    $inputFullName      = FormFrontend::cmsInput('text', 'form[fullname]'   , 'fullname' , $dataForm['fullname'] ?? '', 'form-control');
    $inputPassword      = FormFrontend::cmsInput('text', 'form[password]'   , 'password' , $dataForm['password'] ?? '', 'form-control');
    $inputToken         = FormFrontend::cmsInput('hidden', 'form[token]'    , 'token'    , time());

    // Row Form
    $rowUserName        = FormFrontend::cmsRowForm('username'   ,'Tên tài khoản', $inputUserName ,'require', 'col-md-6');
    $rowPassword        = FormFrontend::cmsRowForm('password'   ,'Mật khẩu'     , $inputPassword ,'require', 'col-md-6');
    $rowEmail           = FormFrontend::cmsRowForm('email'      ,'Email'        , $inputEmail    ,'require', 'col-md-6');
    $rowFullName        = FormFrontend::cmsRowForm('fullname'   ,'Họ và tên'    , $inputFullName, '', 'col-md-6');

    // Link
    $linkAction         = URL::createLink('frontend', 'index', 'register');

    $btnSubmit          = FormFrontend::button('submit', 'submit', 'form[submit]', 'Tạo tài khoản', 'btn btn-solid');

?>
<?php echo HelperFrontend::createTitle('Đăng ký tài khoản') ?>

<section class="register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Đăng ký tài khoản</h3>
                <div class="theme-card">
                    <?php echo $this->errors ?? '' ?>
                    <form action="<?= $linkAction ?>" method="POST" id="admin-form" name="admin-form" class="theme-form">
                        <div class="form-row">
                            <?= $rowUserName . $rowFullName . $rowEmail . $rowPassword ?>
                        </div>
                        <?= $inputToken . $btnSubmit ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>