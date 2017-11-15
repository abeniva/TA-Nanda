<?php
    include '../process/db_login.php';
    session_start();
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
<body class="card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                  <h1 class="navbar-brand" style="color: white;">
                      <?php
                        if ($_SESSION['level'] == 'm') {
                            echo "Manajer";
                        } elseif ($_SESSION['level'] == 'a') {
                            echo "Admin";
                        }
                      ?>
                  </h1>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0"></ul>
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav navbar-right pull-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-muted waves-effect waves-dark" href="../process/logout.php" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-logout"></i><span></span> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="beranda.php" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Beranda</span></a>
                        </li>
                        <?php
                            if ($_SESSION['level'] == 'a') {
                                echo '
                                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-city"></i><span class="hide-menu">Departemen</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="tambah_departemen.php">Tambah Departemen</a></li>
                                            <li><a href="lihat_departemen.php">Lihat Departemen</a></li>
                                        </ul>
                                    </li>
                                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Variabel</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="tambah_variabel.php">Tambah Variabel</a></li>
                                            <li><a href="lihat_variabel.php">Lihat Variabel</a></li>
                                        </ul>
                                    </li>
                                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-view-list"></i><span class="hide-menu">DMU</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="tambah_dmu.php">Tambah DMU</a></li>
                                            <li><a href="lihat_dmu.php">Lihat DMU</a></li>
                                        </ul>
                                    </li>
                                    <li> <a class="waves-effect waves-dark" href="efisiensi.php" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Efisiensi</span></a>
                                    </li>
                                    <li> <a class="waves-effect waves-dark" href="perangkingan.php" aria-expanded="false"><i class="mdi mdi-format-list-numbers"></i><span class="hide-menu">Perangkingan</span></a>
                                    </li>
                                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Pengguna</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="tambah_pengguna.php">Tambah Pengguna</a></li>
                                            <li><a href="lihat_pengguna.php">Lihat Pengguna</a></li>
                                        </ul>
                                    </li>
                                ';
                            } elseif ($_SESSION['level'] == 'm') {
                                echo '
                                    <li> <a class="waves-effect waves-dark" href="efisiensi.php" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Efisiensi</span></a>
                                    </li>
                                    <li> <a class="waves-effect waves-dark" href="perangkingan.php" aria-expanded="false"><i class="mdi mdi-format-list-numbers"></i><span class="hide-menu">Perangkingan</span></a>
                                    </li>
                                ';
                            }
                        ?>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer"> © 2017 Sistem Evaluasi Tenaga Kependidikan dan Non Kependidikan </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End wrapper  -->
    <!-- ============================================================== -->