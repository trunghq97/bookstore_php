<?php
// Link
$linkHome = URL::createLink('frontend', 'index', 'index');

$message = '';
switch ($this->arrParams['type']) {
    case 'register-success':
        $message = 'Tài khoản của bạn đã được tạo thành công. Xin vui lòng chờ kích hoạt từ quản trị!';
        break;
    case 'not-permission':
        $message = 'Bạn không có quyền truy cập vào chức năng này!';
        break;
    case 'not-url':
        $message = 'Đường dẫn không hợp lệ!';
        break;
    case 'update-info-user-success':
        $message = 'Tài khoản của bạn đã được cập nhật thành công!';
        break;
}
?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2"><?php echo $message ?></h2>
                </div>
            </div>
        </div>
        <div>
            <a href="<?php echo $linkHome ?>" class="btn btn-solid">Quay lại trang chủ</a>
        </div>
    </div>
</div>
<!-- <section class="p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="error-section">
                    <h1>404</h1>
                    <h2>Đường dẫn không hợp lệ</h2>
                    <a href="index.html" class="btn btn-solid">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</section>

