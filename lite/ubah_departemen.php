<?php
    include 'layout.php';
    $id = $_GET['id'];
    $query = mysqli_query($conn, 'SELECT * FROM departemen WHERE id_departemen="'.$id.'"');
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $nama_departemen = $data['nama_departemen'];
        }
    }
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
                <h3 class="text-themecolor m-b-0 m-t-0">Departemen</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Departemen</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Ubah Departemen</h4>
                        <?php
                            if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
                               echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span><strong>Nama Departemen</strong> sudah terdaftar. Silahkan gunakan <strong>Nama Departemen</strong> lain</div>';
                            }
                        ?>
                        <form class="form-material form-horizontal m-t-40" method="post" action="<?php echo "../process/u_departemen.php?id=".$id.""; ?>">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-3 col-form-label">Nama Departemen</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" name="nama_departemen" value="<?php echo $nama_departemen; ?>" placeholder="Panjang maksimal 40 karakter" maxlength="40" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                            <a href="lihat_departemen.php" class="btn btn-inverse waves-effect waves-light">Batal</a>
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