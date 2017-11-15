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
                <h3 class="text-themecolor m-b-0 m-t-0">Efisiensi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda_admin.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Efisiensi</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Hasil Efisiensi</h4>
                            <?php 
                            if ($_SESSION['level'] == 'a') {
                                echo '<div class="row">';
                                # Menghitung Banyak DMU
                                $id_dmu = $departemen = $efisiensi = array();
                                $q = mysqli_query($conn, 'SELECT p.id_departemen, d.nama_departemen, p.nilai_efisiensi FROM perhitungan_efisiensi AS p, departemen AS d WHERE p.id_departemen=d.id_departemen GROUP BY p.id_departemen');
                                $n_dmu = mysqli_num_rows($q);
                                if ($n_dmu > 0) {
                                    $index = 0;
                                    while ($d = mysqli_fetch_assoc($q)) {
                                        $nama_departemen[$index] = $d['nama_departemen'];
                                        $id_dmu[$index] = $d['id_departemen'];
                                        $efisiensi[$index] = round($d['nilai_efisiensi'], 3);
                                        $index++;
                                    }
                                    for ($i=0; $i < $n_dmu; $i++) { 
                                        # Menampilkan Efisiensi dan Tabel Rekomendasi
                                        $persen = $efisiensi[$i] * 100;
                                        if ($efisiensi[$i] >= 0.9) {
                                            $alert = "alert-success";
                                            $progress = "progress-bar-success";
                                        } else {
                                            $alert = "alert-danger";
                                            $progress = "progress-bar-danger";
                                        }
                                        echo '
                                                <div class="col-sm-5">
                                                    <div class="alert alert-dismissible '.$alert.'">
                                                            <div class="row">
                                                                <div class="col-sm-9 col-xs-9">
                                                                    <h4 align="left"><strong>'.$nama_departemen[$i].'</strong></h4>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-3">
                                                                    <h4 align="right"><strong>'.$efisiensi[$i].'</strong></h4>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="progress">
                                                                        <div class="progress-bar '.$progress.'" role="progressbar" aria-valuenow="'.$persen.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$persen.'%">'.$persen.'%
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                        ';
                                        echo '
                                                <div class="col-sm-7">
                                                    <table class="table table-condensed table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Variabel</th>
                                                                <th>Nilai Awal</th>
                                                                <th>Rekomendasi</th>
                                                                <th>Satuan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                        ';
                                        $q = mysqli_query($conn, 'SELECT * FROM perhitungan_efisiensi AS p, variabel AS v, departemen AS d WHERE p.id_variabel=v.id_variabel AND d.id_departemen=p.id_departemen AND p.id_departemen="'.$id_dmu[$i].'" ORDER BY v.id_variabel ASC');
                                        if (mysqli_num_rows($q) > 0) {
                                            $j = 1;
                                            while ($data = mysqli_fetch_assoc($q)) {
                                                $departemen = $data['nama_departemen'];
                                                $var = $data['nama_variabel'];
                                                $nilai_awal = $data['nilai_awal'];
                                                $rekomendasi = $data['rekomendasi'];
                                                $satuan = $data['satuan'];
                                                echo '
                                                    <tr>
                                                        <td>'.$j.'</td>
                                                        <td>'.$var.'</td>
                                                        <td>'.$nilai_awal.'</td>
                                                        <td>'.$rekomendasi.'</td>
                                                        <td>'.$satuan.'</td>
                                                    </tr>
                                                ';
                                                $j++;
                                            }
                                        }
                                        echo '
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <br>
                                                </div>
                                        ';
                                    }
                                } else {
                                    echo '
                                            <div class="col-sm-12">
                                                <div class="alert alert-dismissible alert-warning">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        Belum dilakukan perhitungan efisiensi.
                                                </div>
                                            </div>
                                    ';
                                }
                                echo '</div>'; // End of row
                            } elseif ($_SESSION['level'] == 'm') {
                                    echo '<div class="row">';
                                    # Menghitung Banyak DMU
                                    $id_departemen = $_SESSION["id_departemen"];
                                    $q = mysqli_query($conn, 'SELECT p.id_departemen, d.nama_departemen, p.nilai_efisiensi FROM perhitungan_efisiensi AS p, departemen AS d WHERE p.id_departemen=d.id_departemen AND p.id_departemen="'.$id_departemen.'" GROUP BY p.id_departemen');
                                    if (mysqli_num_rows($q) > 0) {
                                        $d = mysqli_fetch_assoc($q);
                                        $nama_departemen = $d['nama_departemen'];
                                        $efisiensi = round($d['nilai_efisiensi'], 3);
                                        # Menampilkan Efisiensi dan Tabel Rekomendasi
                                        $persen = $efisiensi * 100;
                                        if ($efisiensi >= 0.9) {
                                                $alert = "alert-success";
                                                $progress = "progress-bar-success";
                                            } else {
                                                $alert = "alert-danger";
                                                $progress = "progress-bar-danger";
                                            }
                                            echo '
                                                    <div class="col-sm-5">
                                                        <div class="alert alert-dismissible '.$alert.'">
                                                                <div class="row">
                                                                    <div class="col-sm-9 col-xs-9">
                                                                        <h4 align="left"><strong>'.$nama_departemen.'</strong></h4>
                                                                    </div>
                                                                    <div class="col-sm-3 col-xs-3">
                                                                        <h4 align="right"><strong>'.$efisiensi.'</strong></h4>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="progress">
                                                                            <div class="progress-bar '.$progress.'" role="progressbar" aria-valuenow="'.$persen.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$persen.'%">'.$persen.'%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                            ';
                                        echo '
                                                <div class="col-sm-7">
                                                    <table class="table table-condensed table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Variabel</th>
                                                                <th>Nilai Awal</th>
                                                                <th>Rekomendasi</th>
                                                                <th>Satuan</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>
                                        ';
                                        $q = mysqli_query($conn, 'SELECT * FROM perhitungan_efisiensi AS p, variabel AS v, departemen AS d WHERE p.id_variabel=v.id_variabel AND d.id_departemen=p.id_departemen AND p.id_departemen="'.$id_departemen.'" ORDER BY p.id_variabel ASC');
                                        if (mysqli_num_rows($q) > 0) {
                                            $j = 1;
                                            while ($data = mysqli_fetch_assoc($q)) {
                                                $departemen = $data['nama_departemen'];
                                                $var = $data['nama_variabel'];
                                                $nilai_awal = $data['nilai_awal'];
                                                $rekomendasi = $data['rekomendasi'];
                                                $satuan = $data['satuan'];
                                                echo '
                                                    <tr>
                                                        <td>'.$j.'</td>
                                                        <td>'.$var.'</td>
                                                        <td>'.$nilai_awal.'</td>
                                                        <td>'.$rekomendasi.'</td>
                                                        <td>'.$satuan.'</td>
                                                    </tr>
                                                ';
                                                $j++;
                                            }
                                        }
                                        echo '
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <br>
                                                </div>
                                        ';
                                    } else {
                                        echo '
                                                <div class="col-sm-12">
                                                    <div class="alert alert-dismissible alert-warning">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        Belum dilakukan perhitungan efisiensi.
                                                    </div>
                                                </div>
                                        ';
                                    }
                                    echo '</div>'; // End of row
                                }
                            ?>
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