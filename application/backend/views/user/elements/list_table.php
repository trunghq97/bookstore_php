<?php
$xhtml = '';
foreach ($this->items as $key => $item) {
    $id                 = $item['id'];
    $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
    $arrInfoUser        = [
                            'Name'      => HelperBackend::highlight(@$arrParams['search'], $item['username']),
                            'Fullname'  => HelperBackend::highlight(@$arrParams['search'], $item['fullname']),
                            'Email'     => HelperBackend::highlight(@$arrParams['search'], $item['email'])
                        ];
    $infoUser   = HelperBackend::showInfoUser($arrInfoUser);                   

    // GROUP
    $groupValues   = $this->slbGroup;
    $urlChangeGroupAjax = URL::createLink($arrParams['module'], $arrParams['controller'], 'ajaxChangeGroup', ['id' => $id, 'group_id' => 'value_new']);
    $attribute  = sprintf('data-url="%s"', $urlChangeGroupAjax);
    $groupname = Form::cmsSelectbox('groupname', 'custom-select slb-ajax-group', $groupValues, $item['group_id'] ?? '', $style = '', $attribute);

    $status             = HelperBackend::itemStatus($arrParams['module'], $arrParams['controller'], $id, $item['status']);
    $created            = HelperBackend::itemHistory($item['created_by'], $item['created']);
    $modified           = HelperBackend::itemHistory($item['modified_by'], $item['modified']);

    $optionsBtnAction   = ['small' => true, 'circle' => true];

    $linkEdit           = URL::createLink('backend', 'user', 'form', ['id' => $id]);
    $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);

                        
    $linkChangePassword = URL::createLink('backend', 'user', 'formChangePassword', ['id' => $id]);
    $btnChangePassword  = HelperBackend::buttonLink($linkChangePassword, '<i class="fas fa-key"></i>', 'btn-warning', $optionsBtnAction);

    $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
    $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);

    $xhtml .= '
    <tr>
        <td>' . $ckb . '</td>
        <td>' . $id . '</td>
        <td style="text-align:left">' . $infoUser .'</td>
       
        <td class="position-relative">' . $groupname . '</td>
        <td class="position-relative">' . $status . '</td>
        <td>' . $created . '</td>
        <td>' . $modified . '</td>
        <td>
            ' . $btnChangePassword . '
            ' . $btnEdit . '
            ' . $btnDelete . '
        </td>
    </tr>';
}
?>

<form action="" method="post" id="table-form">
    <div class="table-responsive">
        <table class="table align-middle text-center table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all-cid"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $xhtml ?>
            </tbody>
        </table>
    </div>
</form>