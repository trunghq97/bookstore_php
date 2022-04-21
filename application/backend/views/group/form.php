<?php

$dataForm       = $this->arrParams['form'] ?? '';

// Input
$inputName      = Form::cmsInput('text', 'form[name]', 'name', $dataForm['name'] ?? '', 'form-control');
$inputToken     = Form::cmsInput('hidden', 'form[token]', 'token', time());

// Selectbox Status
$statusValues   = ['default' => '- Select Status -', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectStatus   = Form::cmsSelectbox('form[status]', 'custom-select', $statusValues, $dataForm['status'] ?? '');

// Selectbox Group ACP
$groupACPValues  = ['default' => '- Select Group ACP -', 1 => 'Yes', 0 => 'No'];
$selectGroupACP = Form::cmsSelectbox('form[group_acp]', 'custom-select', $groupACPValues, $dataForm['group_acp'] ?? '');

$inputID    = '';
if(isset($this->arrParams['id'])){
    $inputID        = Form::cmsInput('hidden', 'form[id]', 'id', $dataForm['id'] ?? '');
}

    
// Row Form
$rowName        = Form::cmsRowForm('Name', $inputName, true);
$rowStatus      = Form::cmsRowForm('Status', $selectStatus, true);
$rowGroupACP    = Form::cmsRowForm('Group ACP', $selectGroupACP, true);

$linkCancel     = URL::createLink('backend', 'group', 'index');
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
                            <?= $rowName . $rowStatus . $rowGroupACP . $inputID; ?>
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