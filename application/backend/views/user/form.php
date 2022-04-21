<?php
$dataForm           = $this->arrParams['form'] ?? '';

// Input
$inputUserName      = Form::cmsInput('text', 'form[username]', 'username', $dataForm['username'] ?? '', 'form-control');
$inputEmail         = Form::cmsInput('text', 'form[email]', 'email', $dataForm['email'] ?? '', 'form-control');
$inputFullName      = Form::cmsInput('text', 'form[fullname]', 'fullname', $dataForm['fullname'] ?? '', 'form-control');
$inputPassword      = Form::cmsInput('text', 'form[password]', 'password', $dataForm['password'] ?? '', 'form-control');
$inputToken         = Form::cmsInput('hidden', 'form[token]', 'token', time());

$rowPassword        = Form::cmsRowForm('Password', $inputPassword, true);

// Selectbox
$statusValues       = ['default' => '- Select Status -', 'active' => 'Active', 'inactive' => 'Inactive'];
$slbStatus          = Form::cmsSelectbox('form[status]', 'custom-select', $statusValues, $dataForm['status'] ?? '');
$slbGroup           = Form::cmsSelectbox('form[group_id]', 'custom-select', $this->slbGroup, $dataForm['group_id'] ?? '');

$inputID            = '';
$rowID              = '';
if(isset($this->arrParams['id']) || isset($dataForm['id'])){
    $rowPassword    = '';
    $inputID        = Form::cmsInput('hidden', 'form[id]', 'id', $dataForm['id'] ?? '', 'form-control');
    $inputUserName  = Form::cmsInput('text', 'form[username]', 'username', $dataForm['username'] ?? '', 'form-control', '', 'readonly');
    $inputEmail     = Form::cmsInput('text', 'form[email]', 'email', $dataForm['email'] ?? '', 'form-control', '', 'readonly');
    $rowID          = Form::cmsRowForm('ID', $inputID);
}

// Row Form
$rowUserName        = Form::cmsRowForm('UserName', $inputUserName, true);
$rowEmail           = Form::cmsRowForm('Email', $inputEmail, true);
$rowFullName        = Form::cmsRowForm('FullName', $inputFullName);
$rowStatus          = Form::cmsRowForm('Status', $slbStatus, true);
$rowGroup           = Form::cmsRowForm('Group', $slbGroup, true);

// Button Save & Cancel
$linkCancel         = URL::createLink('backend', 'user', 'index');
$btnCancel          = HelperBackend::buttonLink($linkCancel, 'Cancel', 'btn-danger');
$btnSave            = HelperBackend::button('submit', 'Save', 'btn-success');
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
                            <?= $rowUserName . $rowPassword . $rowEmail . $rowFullName . $rowStatus . $rowGroup . $inputID ?>
                        </div>
                        <div class="card-footer">
                            <?= $btnSave . ' ' . $btnCancel . $inputToken ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>