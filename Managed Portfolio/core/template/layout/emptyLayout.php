<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= $title ?></title>    
        <!-- Bootstrap Core CSS -->
        <link href="<?= WEB_SITE ?>css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?= WEB_SITE ?>metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= CSS_PATH ?>sb-admin-2.css" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="<?= WEB_SITE ?>morrisjs/morris.css" rel="stylesheet">    <!-- Custom Fonts -->
        <link href="<?= WEB_SITE ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <body>
        <div class="container">

            <div class="row">

                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title"><?= $title ?></h3>
                        </div>
                        <div class="panel-body">
                            <?= $core ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?= JS_PATH ?>jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= JS_PATH ?>bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?= WEB_SITE?>metisMenu/metisMenu.min.js"></script>
        <!-- Morris Charts JavaScript -->
        <script src="<?= JS_PATH ?>raphael-min.js"></script>
        <script src="<?= WEB_SITE ?>morrisjs/morris.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= JS_PATH ?>sb-admin-2.js"></script>
        <script src="<?= JS_PATH ?>agency.js"></script>
    </body>
</html>