<?php
    include '../process/db_login.php';
    session_start();
    if (ISSET($_SESSION['level'])) {
        header('Location: ../lite/beranda.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Evaluasi Tenaga Kependidikan dan Non Kependidikan</title>

        <!-- CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
        <link href="../lite/css/style.css" rel="stylesheet">
        <link href="../lite/css/cssku.css" rel="stylesheet">
        <link href="css/colors/blue.css" id="theme" rel="stylesheet">
        
    </head>
    <body>
    <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <section id="wrapper">
            <div class="login-register" style="background-color: #eee;">        
                <div class="login-box pad card">
                    <div class="card-body">
                        <?php 
                            if (ISSET($_SESSION['error'])) {
                                // Terdapat Error Saat Login
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span>  '.$_SESSION['error'].'</div>';
                            }
                        ?>
                        <form class="form-horizontal form-material" id="loginform" method="POST" action="../process/login.php">
                            <h3 class="box-title m-b-20 text-center">Login</h3>
                            <h4 class="box-title m-b-20 text-center">Sistem Evaluasi Tenaga Kependidikan dan Non Kependidikan</h4>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="username" placeholder="Username" required> </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" placeholder="Password" required> </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-md text-uppercase waves-effect waves-light" name="login" type="submit">LOGIN</button>
                                </div>
                            </div>
                        </form>
                        <hr />
                        <h5 id="copyright">&copy; 2017 All Rights Reserved.</h5>
                    </div>
                </div>
            </div>

        </section>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->



<?php include 'script.php'; ?>