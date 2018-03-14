<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
        <meta name="lang" content="es" />
        <meta name="author" content="diemarc" />
        <meta name="organization" content="diemarc" />
        <meta name="locality" content="Madrid" />
        <title><?php echo __APPNAME__;?>-Login</title>
        <!-- Bootstrap Core CSS -->
        <link href="/_styles/sb_admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            <div class="col-xs-10 col-sm-4 col-md-4 col-md-offset-4">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <form class="form-signin form-group-sm" 
                              action="go" method="post">
                            <h2 class="form-signin-heading text-primary"><?php echo __APPNAME__;?></h2>
                            <label for="f_username" class="sr-only">Username? </label>
                            <input type="text" id="f_username" name="f_username" class="form-control form-group-sm" 
                                   placeholder="username? " required autofocus>
                            <label for="f_password" class="sr-only">Password.?</label>
                            <input type="password" id="f_password" name="f_password" class="form-control" placeholder="Password?" required>
                           <hr/>
                            <button class="btn btn-lg btn-success btn-block" type="submit">OK</button>
                        </form>
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div> <!-- /container -->
    </body>
</html>
