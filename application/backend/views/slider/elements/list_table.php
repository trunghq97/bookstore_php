<?php
$xhtml = '';
foreach ($this->items as $key => $item) {
    $id                 = $item['id'];
    $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
    $name               = HelperBackend::highlight(@$arrParams['search'], $item['name']);

    $picture            = HelperBackend::createImage('slider', $item['picture'], ['class' => 'item-image w-100']);
 
    $status             = HelperBackend::itemStatus($arrParams['module'], $arrParams['controller'], $id, $item['status']);
    $urlChangeOrderingAjax = URL::createLink($arrParams['module'], $arrParams['controller'], 'ajaxChangeOrdering', ['id' => $id, 'ordering' => 'value_new']);
    $attribute  = sprintf('data-url="%s"', $urlChangeOrderingAjax);
    $ordering           = Form::cmsInput('number', 'ordering', 'ordering', $item['ordering'] ?? '', 'form-control input-ajax-ordering', '', $attribute);
    $created            = HelperBackend::itemHistory($item['created_by'], $item['created']);
    $modified           = HelperBackend::itemHistory($item['modified_by'], $item['modified']);

    // Link & Button (Edit & Delete)
    $optionsBtnAction   = ['small' => true, 'circle' => true];
    $linkEdit           = URL::createLink('backend', 'slider', 'form', ['id' => $id]);
    $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);
    $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
    $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);

    $arrInfoSlider = [
        'Name'          => HelperBackend::highlight(@$arrParams['search'], $item['name']),
        'Description'   => HelperBackend::highlight(@$arrParams['search'], $item['description']),
        'Link'          => HelperBackend::highlight(@$arrParams['search'], $item['link'])
    ];

    $infoSlider   = HelperBackend::showInfoUser($arrInfoSlider); 
    $xhtml .= ' 
        <tr>
            <td>' . $ckb . '</td>
            <td>' . $id . '</td>
            <td style="text-align:left; max-width:350px;">' . $infoSlider . $picture .'</td>
            <td class="position-relative">' . $status . '</td>
            <td style="width: 8%" class="position-relative">' . $ordering . '</td>
            <td>' . $created . '</td>
            <td>' . $modified . '</td>
            <td>
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
                    <th>Status</th>
                    <th>Ordering</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $xhtml ?>
            </tbody>
        </table>
    </div>
</form>