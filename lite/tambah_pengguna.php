<?php
    include 'layout.php';
?>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Pengguna</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Pengguna</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Tambah Pengguna</h4>
                        <?php
                        if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-exclamation"></span> <strong>Nama pengguna</strong> sudah terdaftar pada <strong>Departemen</strong> terpilih. Silahkan gunakan <strong>nama pengguna</strong> lain</div>';
                            }
                        ?>
                        <form class="form-material form-horizontal m-t-40" method="POST" action="../process/t_pengguna.php">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Username</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="username" placeholder="Panjang username 5-20 karakter" type="text" minlength="5" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Password</label>
                                <div class="col-10">
                                    <input class="form-control" type="password" name="password" placeholder="Panjang password 5-12 karakter" type="password" minlength="5" maxlength="12" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Departemen</label>
                                <div class="col-3">
                                    <select class="form-control" name="departemen">
                                        <option value=""> -- Pilih Departemen -- </option>
                                        <?php
                                            $query = mysqli_query($conn, "SELECT * FROM departemen");
                                            if(mysqli_num_rows($query)>0){
                                            while ($variabel = mysqli_fetch_assoc($query)) {
                                                echo '
                                                    <option value='.$variabel['id_departemen'].'>'.$variabel['nama_departemen'].'</option>
                                                ';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<?php include 'script.php';?>