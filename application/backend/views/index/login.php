<?php
    $linkAction = URL::createLink('backend', 'index', 'login');
    $dataForm   = $this->arrParams['form'] ?? '';

    $xhtmlMessage = '';
    if(!empty($this->errors)){
           $xhtmlMessage .= '  <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Thông báo!</h5>
            '.$this->errors.'
        </div>';
    }
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b><?php echo $this->_title ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php echo $xhtmlMessage; ?>
            <form action="<?php echo $linkAction ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="text" name="form[username]" value ="<?php echo $dataForm['username'] ?? '' ?>" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="form[password]" value ="<?php echo $dataForm['password'] ?? '' ?>" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="form[token]" value="<?php echo time(); ?>" />

                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>