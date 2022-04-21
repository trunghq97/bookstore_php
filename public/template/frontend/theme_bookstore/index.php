<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <title><?= $this->_title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
    <?php echo $this->_cssFiles; ?>
</head>

<body>

    <?php require_once 'html/header.php' ?>

    <div class="row">
        <div class="col-12">
            <?php require_once PATH_APPLICATION . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
        </div>
    </div>
    <?php require_once 'html/contact.php'; ?>
    <?php require_once 'html/footer.php' ?>

    <?php echo $this->_jsFiles; ?>
    <script>
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
            document.getElementById("search-input").focus();
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }

        $(document).ready(function () {
            let controller = '<?php echo $controller ?>';
            let action     = '<?php echo $action ?>';
            let dataActive = controller + '-' + action;
            $(`a[data-active=${dataActive}]`).addClass('my-menu-link active');
        });
    </script>
</body>

</html>