<?php
$userObj = Session::get('user');

$dataForm           = $this->arrParams['form'] ?? '';

// Input
$inputEmail         = Form::cmsInput('text', 'form[email]', 'email', $dataForm['email'] ?? '', 'form-control');
$inputFullName      = Form::cmsInput('text', 'form[fullname]', 'fullname', $dataForm['fullname'] ?? '', 'form-control');


$inputID            = '';
$rowID              = '';
if(isset($dataForm['id'])){
    $inputID        = Form::cmsInput('hidden', 'form[id]', 'id', $dataForm['id'] ?? '', 'form-control');
}

// Row Form
$rowEmail           = Form::cmsRowForm('Email', $inputEmail, true);
$rowFullName        = Form::cmsRowForm('FullName', $inputFullName);

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
                            <?= $rowEmail . $rowFullName . $inputID ?>
                        </div>
                        <div class="card-footer">
                            <?= $btnSave . ' ' . $btnCancel ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>