<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>LOGIN ADMINISTRATOR | Sistem Informasi Akademik - AMA Yogyakarta</title>
        <!-- Bootstrap Core CSS -->
        <link href="stylesheet/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="stylesheet/sb-admin-2.css" rel="stylesheet">
        <link href="stylesheet/site.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                <div class="col-md-4 col-md-offset-4">                    
                    <div class="login-panel panel">
                        <center>
                            <img src="images/logo.png" width="150" class="img-responsive" style="padding-top: 10px;"/>
                            <br/><b>LOGIN ADMINISTRATOR<br/>SISTEM INFORMASI AKADEMIK<br/>AMA YOGYAKARTA</b><br />
                        </center>
                        <div class="panel-body">
                            <form method="post" action="proses_login.php">
                                <fieldset>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <input type="submit" name="login" class="btn btn-primary btn-block" value="MASUK">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
    </body>
</html>