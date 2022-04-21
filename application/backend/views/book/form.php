<?php
$dataForm               = $this->arrParams['form'] ?? '';

// Input
$inputName              = Form::cmsInput('text', 'form[name]', 'name', $dataForm['name'] ?? '', 'form-control');
$inputPicture           = Form::cmsInput('file',    'picture', 'imgAdd', '', 'form-control');
// $inputDescription       = '<textarea name="form[description]" class="form-control">' . @$dataForm['description'] . '</textarea>';
$inputPrice             = Form::cmsInput('text', 'form[price]', 'price', $dataForm['price'] ?? '', 'form-control');
$inputSaleOff           = Form::cmsInput('text', 'form[sale_off]', 'sale_off', $dataForm['sale_off'] ?? '', 'form-control');
$textAreaDes            = HelperBackend::cmsTextArea('form[description]', @$dataForm['description'], false, '', 'editorDesc');
$rowDescription         = Form::cmsRowForm('Description', $textAreaDes);
$inputToken             = Form::cmsInput('hidden', 'form[token]', 'token', time());

// Selectbox
$arrCategoryName            = $this->slbCategory ?? '';
$arrCategoryName['default'] = "- Select Category -";
ksort($arrCategoryName);

$statusValues       = ['default' => '- Select Status -', 'active' => 'Active', 'inactive' => 'Inactive'];
$specialValues      = ['default' => '- Select Special -', 1 => 'Yes', 0 => 'No'];
$slbStatus          = Form::cmsSelectbox('form[status]', 'custom-select', $statusValues, $dataForm['status'] ?? '');
$slbSpecial         = Form::cmsSelectbox('form[special]', 'custom-select', $specialValues, $dataForm['special'] ?? '');
$slbCategory        = Form::cmsSelectbox('form[category_id]', 'custom-select', $arrCategoryName, $dataForm['category_id'] ?? '');

$previewImage       = !isset($this->arrParams['id']) ? '<img style="display: block; width: 100%; max-width: 400px;" id="previewImg" src="">' : '';

$inputID            = '';
$picture            = '';
$inputPictureHidden = '';
if(isset($this->arrParams['id']) || isset($dataForm['id'])){
    $inputID        = Form::cmsInput('hidden', 'form[id]', 'id', $dataForm['id'] ?? '', 'form-control');
    @$picture       = '<img style="display: block; width: 100%; max-width: 400px;" src="' . URL_UPLOAD . 'book' . DS . $dataForm['picture'].'">';
    $inputPictureHidden   = Form::cmsInput('hidden', 'form[picture_hidden]', 'picture_hidden',  $dataForm['picture'] ?? '', 'form-control');
}
 
// Row Form
$rowName            = Form::cmsRowForm('Name', $inputName, true);
$rowPicture         = Form::cmsRowForm('Picture',   $inputPicture . $picture . $inputPictureHidden . $previewImage);
// $rowDescription     = Form::cmsRowForm('Description', $inputDescription);
$rowPrice           = Form::cmsRowForm('Price', $inputPrice, true);
$rowSaleOff         = Form::cmsRowForm('SaleOff', $inputSaleOff);
$rowStatus          = Form::cmsRowForm('Status', $slbStatus, true);
$rowSpecial         = Form::cmsRowForm('Special', $slbSpecial, true);
$rowCategory        = Form::cmsRowForm('Category', $slbCategory, true);

// Button Save & Cancel
$linkCancel         = URL::createLink('backend', 'book', 'index');
$btnCancel          = HelperBackend::buttonLink($linkCancel, 'Cancel', 'btn-danger');
$btnSave            = HelperBackend::button('submit', 'Save', 'btn-success');
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
                            <?= $rowName . $rowPicture . $rowDescription . $rowPrice . $rowSaleOff . $rowStatus . $rowSpecial . $rowCategory . $inputID ?>
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