<?php
    include 'layout.php';

    if (ISSET($_GET['id'])) {
        $id = $_GET['id'];
    }

    $query = mysqli_query($conn, 'SELECT * FROM variabel WHERE id_variabel="'.$id.'"');
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $nama_variabel = $data['nama_variabel'];
            $jenis_variabel = $data['jenis_variabel'];
            $satuan = $data['satuan'];
            $bobot = $data['bobot'];

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
                <h3 class="text-themecolor m-b-0 m-t-0">Variabel</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Variabel</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Ubah Variabel</h4>
                        <?php
                        if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-exclamation"></span> <strong>Nama variabel</strong> sudah terdaftar. Silahkan gunakan <strong>nama variabel</strong> lain</div>';
                            }
                        ?>
                        <form class="form-material form-horizontal m-t-40" method="POST" action="<?php echo "../process/u_variabel.php?id=".$id.""; ?>" >
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Nama Variabel</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="nama_variabel" value="<?php echo $nama_variabel; ?>" placeholder="Panjang maksimal 50 karakter" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Jenis Variabel</label>
                                <div class="col-2">
                                    <select name="jenis_variabel" class="form-control">
                                        <option disabled>- Pilih Jenis Variabel -</option>
                                        <?php
                                            if ($jenis_variabel == 'Input') {
                                                echo '<option value="Input" selected="selected">Input</option><option value="Output">Output</option>';
                                            } elseif ($jenis_variabel == 'Output') {
                                                echo '<option value="Input">Input</option><option value="Output" selected="selected">Output</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Satuan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="satuan" value="<?php echo $satuan; ?>" placeholder="Panjang maksimal 20 karakter" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Bobot</label>
                                <div class="col-10">
                                    <input class="form-control" type="number" name="bobot" value="<?php echo $bobot; ?>" placeholder="Bobot antara 1-5" min="1" max="5" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                            <a href="lihat_variabel.php" class="btn btn-inverse waves-effect waves-light">Batal</a>
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