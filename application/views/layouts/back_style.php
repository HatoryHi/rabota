<?php require_once 'const.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo BACK_TITLE ?></title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_BACK ?>">
    <link href="<?php echo GOOGLE_FONTS; ?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo AJAX; ?>"></script>

    <script type="text/javascript" src="<?php echo JQ_JS; ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo JQ_CSS ?>"/>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</head>
<body>