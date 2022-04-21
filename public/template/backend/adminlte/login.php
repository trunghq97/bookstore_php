<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <title><?= $this->_title; ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <?php echo $this->_pluginsCssFiles; ?>
    <?php echo $this->_cssFiles; ?>
</head>

<body class="hold-transition login-page">

    <!-- /.login-box -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php require_once PATH_APPLICATION . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->


    <!-- jQuery -->
    <?php echo $this->_pluginsJsFiles; ?>
    <?php echo $this->_jsFiles; ?>
</body>

</html>