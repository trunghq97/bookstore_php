<?php
    $userObj  = Session::get('user');
    $userInfo = $userObj['info']; 

    $arrMenu = [
        ['Thông tin tài khoản', URL::createLink('frontend', 'user', 'index', ['id' => $userInfo['id']]), 'user-index'],
        ['Thay đổi mật khẩu',   URL::createLink('frontend', 'user', 'formChangePassword', ['id' => $userInfo['id']]),  'user-formChangePassword'],
        ['Lịch sử mua hàng',    URL::createLink('frontend', 'user', 'history', null, 'lich-su-mua-hang.html'), 'user-history'],
        ['Đăng xuất',           URL::createLink('frontend', 'index', 'logout'), 'index-logout']
    ];

    $xhtmlMenu = '';
    foreach($arrMenu as $value){
        $xhtmlMenu .= '<li data-active="'.$value[2].'"><a href="'.$value[1].'">'.$value[0].'</a></li>';
    }

    $controller = !empty($this->arrParams['controller']) ? $this->arrParams['controller'] : '';
    $action     = !empty($this->arrParams['action']) ? $this->arrParams['action'] : '';
?>

<ul>
    <?php echo $xhtmlMenu ?>
</ul>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let controller = '<?php echo $controller ?>';
        let action     = '<?php echo $action ?>';
        let dataActive = controller + '-' + action;
        $(`li[data-active=${dataActive}]`).addClass('my-menu-link active');
    });
</script>