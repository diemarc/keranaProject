<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
        <meta name="lang" content="es" />
        <meta name="author" content="diemarc" />
        <meta name="organization" content="diemarc" />
        <meta name="locality" content="Madrid" />
        <title>:-( Kerana-Ooops, shit happens!!!!</title>
        <link href="/_styles/sb_admin2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="col-xs-10 col-sm-5 col-md-7 col-sm-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h2 class="text-danger">
                            <i class="glyphicon glyphicon-remove-sign"></i> 
                            <?php echo $title; ?>
                        </h2>
                    </div>
                    <div class="panel-body">
                        <p>
                            <?php echo $description; ?>
                        </p>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default"  onclick='history.back()'>GoBack</button>
                    </div>
                </div>
            </div>
    </body>
</html>
<?php
die();
