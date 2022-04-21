<?php

$dataForm           = $this->arrParams['form'] ?? '';

// Input
$inputName          = Form::cmsInput('text',    'form[name]',   'name',     $dataForm['name'] ?? '',    'form-control');
$inputPicture       = Form::cmsInput('file',    'picture',      'imgAdd', '', 'form-control');
$inputToken         = Form::cmsInput('hidden',  'form[token]',  'token',    time());

// Selectbox Status & Show At Home
$statusValues       = ['default' => '- Select Status -', 'active' => 'Active', 'inactive' => 'Inactive'];
$slbtStatus         = Form::cmsSelectbox('form[status]', 'custom-select', $statusValues, $dataForm['status'] ?? '');
$showAtHomeValues   = ['default' => '- Select Show At Home -', 1 => 'Yes', 0 => 'No'];
$slbShowAtHome      = Form::cmsSelectbox('form[show_at_home]', 'custom-select', $showAtHomeValues, $dataForm['show_at_home'] ?? '');

$previewImage   = !isset($this->arrParams['id']) ? '<img style="display: block; width: 100%; max-width: 400px;" id="previewImg" src="">' : '';

$inputID        = '';
$picture        = '';
$inputPictureHidden = '';
if(isset($this->arrParams['id'])){
    $inputID     = Form::cmsInput('hidden', 'form[id]', 'id', $dataForm['id'] ?? '');
    @$picture    = '<img src="' . URL_UPLOAD . 'category' . DS . $dataForm['picture'].'">';
    $inputPictureHidden   = Form::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden',  $dataForm['picture'] ?? '', 'form-control');
}
 
// Row Form
$rowName            = Form::cmsRowForm('Name'           ,$inputName,     true);
$rowPicture         = Form::cmsRowForm('Picture'        ,$inputPicture . $picture . $inputPictureHidden . $previewImage);
$rowStatus          = Form::cmsRowForm('Status'         ,$slbtStatus,  true);
$rowShowAtHome      = Form::cmsRowForm('Show At Home'   ,$slbShowAtHome, true);


$linkCancel     = URL::createLink('backend', 'category', 'index');
$btnCancel      = HelperBackend::buttonLink($linkCancel, 'Cancel', 'btn-danger');

$btnSave        = HelperBackend::button('submit', 'Save', 'btn-success');
?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->errors ?? '' ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <?= $rowName . $rowPicture . $rowStatus . $rowShowAtHome . $inputID; ?>
                        </div>
                        <div class="card-footer">
                            <?= $btnSave . ' ' . $btnCancel ?>
                            <?= $inputToken ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>