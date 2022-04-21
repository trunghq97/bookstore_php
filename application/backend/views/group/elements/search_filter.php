<?php
$btnSearch          = HelperBackend::button('submit', 'Search');
$linkClear          = URL::createLink($arrParams['module'], $arrParams['controller'], $arrParams['action']);
$btnClear           = HelperBackend::buttonLink($linkClear, 'Clear', 'btn-danger');
$xhtmlFilterStatus  = HelperBackend::showFilterStatus($arrParams['module'], $arrParams['controller'], $this->itemsStatusCount, $arrParams['status'] ?? 'all', trim(@$arrParams['search'] ?? ''));

// SELECT GROUP ACP
$arrGroupACP        = ['default' => '- Select Group ACP -', 1 => 'Yes', 0 => 'No'];
$selectboxGroupACP  = Form::cmsSelectbox('group_acp', 'custom-select w-auto filter-attribute', $arrGroupACP, $arrParams['group_acp'] ?? 'default');
?>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Search & Filter</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="area-filter-status mb-2">
                    <?= $xhtmlFilterStatus ?>
                </div>
                <div>
                    <form action="" method="GET" id="filter-form">
                            <input type="hidden" name="module" value="<?= $arrParams['module'] ?>">
                            <input type="hidden" name="controller" value="<?= $arrParams['controller'] ?>">
                            <input type="hidden" name="action" value="<?= $arrParams['action'] ?>">
                            <?= $selectboxGroupACP ?>
                    </form>
                </div>
                <div class="area-search mb-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="hidden" name="module" value="<?= $arrParams['module'] ?>">
                            <input type="hidden" name="controller" value="<?= $arrParams['controller'] ?>">
                            <input type="hidden" name="action" value="<?= $arrParams['action'] ?>">
                            <input type="text" class="form-control" name="search" value="<?= @$arrParams['search'] ?>">
                            <span class="input-group-append">
                                <?= $btnSearch . $btnClear ?>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>