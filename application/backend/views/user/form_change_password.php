<?php
$dataForm           = $this->arrParams['form'] ?? '';

// Input
$inputID            = Form::cmsInput('text', 'form[id]', 'id', $dataForm['id'] ?? '', 'form-control', '', 'readonly');
$inputUserName      = Form::cmsInput('text', 'form[username]', 'username', $dataForm['username'] ?? '', 'form-control', '', 'readonly');
$inputEmail         = Form::cmsInput('text', 'form[email]', 'email', $dataForm['email'] ?? '', 'form-control', '', 'readonly');
$inputFullName      = Form::cmsInput('text', 'form[fullname]', 'fullname', $dataForm['fullname'] ?? '', 'form-control', '', 'readonly');
$inputPassword      = Form::cmsInput('text', 'form[password]', 'password', $dataForm['password'] ?? '', 'form-control');

// Row Form
$rowID              = Form::cmsRowForm('ID', $inputID);
$rowUserName        = Form::cmsRowForm('UserName', $inputUserName);

$linkChangePassword = URL::createLink('backend', 'user', 'formChangePassword', ['id' => $dataForm['id']]);
$btnChangePassword  = HelperBackend::buttonLink($linkChangePassword, '<i class="fas fa-sync">   Generate</i>', 'btn-primary btn-random-password');

$rowPassword        = Form::cmsRowForm('Password', $inputPassword);
$rowEmail           = Form::cmsRowForm('Email', $inputEmail);
$rowFullName        = Form::cmsRowForm('FullName', $inputFullName);

$inputToken         = Form::cmsInput('hidden', 'form[token]', 'token', time());

// Button Save & Cancel
$linkCancel     = URL::createLink('backend', 'user', 'index');
$btnCancel      = HelperBackend::buttonLink($linkCancel, 'Cancel', 'btn-danger');
$btnSave        = HelperBackend::button('submit', 'Save', 'btn-success');
?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->errors ?? '' ?>
                <form action="" method="POST">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <?= $rowID . $rowUserName . $rowEmail . $rowFullName . $rowPassword . $btnChangePassword ?>
                        </div>
                        <div class="card-footer">
                            <?= $btnSave . ' ' . $btnCancel . $inputToken?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>