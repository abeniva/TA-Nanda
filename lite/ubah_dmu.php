<?php
    include 'layout.php';

    $id= $_GET['id'];
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
                    <li class="breadcrumb-item active">Ubah DMU</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Ubah DMU</h4>
                        <form class="form-material form-horizontal m-t-40" method="POST" action="<?php echo "../process/u_dmu.php?id=".$id.""; ?>">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Departemen</label>
                                <div class="col-sm-6">
                                    <select name="id_departemen" class="form-control" style="margin-bottom: 10px;" disabled>
                                        <option value=""> -- Pilih Departemen -- </option>
                                        <?php
                                            $query = mysqli_query($conn, 'SELECT * FROM departemen');
                                            if (mysqli_num_rows($query) > 0) {
                                                // output data of each row
                                                while($departemen = mysqli_fetch_assoc($query)) {
                                                    $id_departemen = $departemen['id_departemen'];
                                                    if ($id_departemen == $id) {
                                                        echo '<option value="'.$id_departemen.'" selected>'.$departemen["nama_departemen"].'</option>';    
                                                    } else {
                                                        echo '<option value="'.$id_departemen.'">'.$departemen["nama_departemen"].'</option>';    
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            <?php
                                $input = 0;
                                $output = 0;
                                $query = mysqli_query($conn, 'SELECT * FROM variabel v, detail_dmu d WHERE v.id_variabel=d.id_variabel AND d.id_departemen='.$id.' ORDER BY v.jenis_variabel ASC, v.id_variabel ASC');
                                if (mysqli_num_rows($query) > 0) {
                                    while ($var = mysqli_fetch_assoc($query)) {
                                        $name = str_replace(' ','_',$var['nama_variabel']);
                                        $satuan = $var['satuan'];
                                        $value = $var['nilai_variabel'];
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
                                                    <input class="form-control" name="'.$name.'" type="number" min="1" step="0.5" value="'.$value.'" required>
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
                            <a href="lihat_dmu.php" class="btn btn-inverse waves-effect waves-light">Batal</a>
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