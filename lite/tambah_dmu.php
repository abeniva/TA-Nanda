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
                <h3 class="text-themecolor m-b-0 m-t-0">DMU</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah DMU</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Tambah DMU</h4>
                        <?php
                        if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-exclamation"></span> <strong>DMU</strong> telah terisi datanya. Silahkan gunakan <strong>DMU</strong> lain</div>';
                            }
                        ?>
                        <form class="form-material form-horizontal m-t-40" method="POST" action="../process/t_dmu.php">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Departemen</label>
                                <div class="col-sm-6">
                                    <select name="id_departemen" class="form-control" style="margin-bottom: 10px;" required>
                                        <option value=""> -- Pilih Departemen -- </option>
                                        <?php
                                            $query = mysqli_query($conn, 'SELECT * FROM departemen');
                                            if (mysqli_num_rows($query) > 0) {
                                                // output data of each row
                                                while($departemen = mysqli_fetch_assoc($query)) {
                                                    $id_departemen = $departemen['id_departemen'];
                                                    echo '<option value="'.$id_departemen.'">'.$departemen["nama_departemen"].'</option>';    
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            <?php
                                $input = 0;
                                $output = 0;
                                $query = mysqli_query($conn, "SELECT * FROM variabel ORDER BY jenis_variabel ASC, id_variabel ASC");
                                if (mysqli_num_rows($query) > 0) {
                                    while ($var = mysqli_fetch_assoc($query)) {
                                        $name = str_replace(' ','_',$var['nama_variabel']);
                                        $satuan = $var['satuan'];
                                        // Pemisah var
                                        if (($var['jenis_variabel'] == 'Input') AND ($input == 0)) {
                                            echo '<div class="form-group"><legend class="col-sm-8 col-sm-offset-2">Variabel Input</legend></div>';
                                            $input = 1;
                                        } elseif (($var['jenis_variabel'] == 'Output') AND ($output == 0)) {
                                            echo '<div class="form-group"><legend class="col-sm-8 col-sm-offset-2">Variabel Output</legend></div>';
                                            $output = 1;
                                        }
                                        echo '
                                            <div class="form-group row kiri">
                                                <label class="col-sm-4 control-label">'.$var["nama_variabel"].'</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="'.$name.'" type="number" min="1" step="0.5" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <h5>'.$satuan.'</h4> 
                                                </div>
                                            </div>
                                        ';
                                    }
                                }
                            ?>
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