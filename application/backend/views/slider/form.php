<?php

$dataForm           = $this->arrParams['form'] ?? '';

// Input
$inputName          = Form::cmsInput('text',    'form[name]',   'name',     $dataForm['name'] ?? '',    'form-control');
$inputDescription   = '<textarea name="form[description]" class="form-control">' . @$dataForm['description'] . '</textarea>';
$inputPicture       = Form::cmsInput('file',    'picture',      'imgAdd', '', 'form-control');
$inputLink          = Form::cmsInput('text',    'form[link]',   'link',     $dataForm['link'] ?? '',    'form-control');
$inputToken         = Form::cmsInput('hidden',  'form[token]',  'token',    time());

// Selectbox Status & Show At Home
$statusValues       = ['default' => '- Select Status -', 'active' => 'Active', 'inactive' => 'Inactive'];
$slbtStatus         = Form::cmsSelectbox('form[status]', 'custom-select', $statusValues, $dataForm['status'] ?? '');

$previewImage   = !isset($this->arrParams['id']) ? '<img style="display: block;width: 100%; max-width: 700px" id="previewImg" src="">' : '';
$inputID        = '';
$picture        = '';
$inputPictureHidden = '';
if(isset($this->arrParams['id'])){
    $inputID     = Form::cmsInput('hidden', 'form[id]', 'id', $dataForm['id'] ?? '');
    @$picture    = '<img style="display: block;width: 100%; max-width: 700px" src="' . URL_UPLOAD . 'slider' . DS . $dataForm['picture'].'">';
    $inputPictureHidden   = Form::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden',  $dataForm['picture'] ?? '', 'form-control');

}
 
// Row Form
$rowName            = Form::cmsRowForm('Name'           ,$inputName,     true);
$rowDescription     = Form::cmsRowForm('Description'    ,$inputDescription);
$rowLink            = Form::cmsRowForm('Link'           ,$inputLink);
$rowPicture         = Form::cmsRowForm('Picture'        ,$inputPicture . $picture . $inputPictureHidden . $previewImage);
$rowStatus          = Form::cmsRowForm('Status'         ,$slbtStatus,  true);

$linkCancel     = URL::createLink('backend', 'slider', 'index');
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
                            <?= $rowName . $rowDescription . $rowLink . $rowPicture . $rowStatus . $inputID; ?>
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