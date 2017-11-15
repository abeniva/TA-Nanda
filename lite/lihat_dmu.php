<?php
    include '../process/db_login.php';
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
                    <li class="breadcrumb-item"><a href="beranda_admin.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Lihat DMU</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Daftar DMU</h4>
                        <?php
                            // Notifikasi
                            if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
                                echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-check"></span> Data berhasil ditambahkan</div>';
                            } elseif (ISSET($_GET['balasan']) AND ($_GET['balasan']==2)) {
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-exclamation"></span> Kesalahan telah terjadi</div>';
                            } elseif (ISSET($_GET['balasan']) AND ($_GET['balasan']==3)) {
                                echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-check"></span> Data berhasil dihapus</div>';
                            } elseif (ISSET($_GET['balasan']) AND ($_GET['balasan']==4)) {
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-exclamation"></span> Gagal menghapus data</div>';
                            } elseif (ISSET($_GET['balasan']) AND ($_GET['balasan']==5)) {
                                echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-check"></span> Data berhasil diubah</div>';
                            } elseif (ISSET($_GET['balasan']) AND ($_GET['balasan']==6)) {
                                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="mdi mdi-exclamation"></span> Gagal mengubah data</div>';
                            }

                            // Menghitung jumlah var input dan output
                            $query = mysqli_query($conn, "SELECT * FROM variabel ORDER BY jenis_variabel ASC, id_variabel ASC");
                            $list_var = '';
                            $input = 0;
                            $output = 0;
                            if (mysqli_num_rows($query) > 0) {
                                while($var = mysqli_fetch_assoc($query)) {
                                    if ($var['jenis_variabel'] == 'Input') {
                                        $input++;
                                    } else {
                                        $output++;
                                    }
                                    $nama = str_replace('_',' ',$var['nama_variabel']);
                                    $list_var .= "<th style='font-size: 12px; font-weight: bold;'>$nama</th>";
                                }
                            }

                            // Menampilkan Data Tabel
                            $i = 1;
                            $query = mysqli_query($conn, 'SELECT * FROM departemen');
                            if (mysqli_num_rows($query) > 0) {
                                echo '
                                    <table id="myTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">DMU</th>
                                                <th colspan="'.$input.'">Input</th>
                                                <th colspan="'.$output.'">Output</th>
                                                <th rowspan="2">Aksi</th>
                                            </tr>
                                            <tr>
                                                '.$list_var.'
                                            </tr>
                                        </thead>
                                        <tbody>
                                ';
                                while ($departemen = mysqli_fetch_assoc($query)) {
                                    echo '
                                        <tr>
                                            <td>'.$i.'</td>
                                            <td>'.$departemen["nama_departemen"].'</td>
                                    ';
                                    $id_departemen = $departemen['id_departemen'];

                                    // Variabel Input
                                    $query_input = mysqli_query($conn, 'SELECT d.nilai_variabel FROM detail_dmu AS d, variabel AS v WHERE d.id_variabel=v.id_variabel AND id_departemen='.$id_departemen.' AND v.jenis_variabel="Input" ORDER BY v.jenis_variabel ASC, d.id_variabel');
                                    $count = 0;
                                    if (mysqli_num_rows($query_input)) {
                                        while ($nilai_var = mysqli_fetch_assoc($query_input)) {
                                            echo '<td>'.$nilai_var["nilai_variabel"].'</td>';
                                            $count++;
                                        }
                                    }
                                    if ($count < $input) {
                                        for ($k=$count; $k < $input; $k++) { 
                                            echo '<td></td>';
                                        }
                                    }

                                    // Variabel Output
                                    $query_output = mysqli_query($conn, 'SELECT d.nilai_variabel FROM detail_dmu AS d, variabel AS v WHERE d.id_variabel=v.id_variabel AND id_departemen='.$id_departemen.' AND v.jenis_variabel="Output" ORDER BY v.jenis_variabel ASC, d.id_variabel');
                                    $count = 0;
                                    if (mysqli_num_rows($query_output)) {
                                        while ($nilai_var = mysqli_fetch_assoc($query_output)) {
                                            echo '<td>'.$nilai_var["nilai_variabel"].'</td>';
                                            $count++;
                                        }
                                    }
                                    if ($count < $output) {
                                        for ($j=$count; $j < $output; $j++) { 
                                            echo '<td></td>';
                                        }
                                    }
                                    echo '
                                            <td>
                                                <a href="ubah_dmu.php?id='.$id_departemen.'" class="btn btn-warning btn-sm" style="margin-bottom: 4px;">Ubah</a>
                                                <a href="../process/h_dmu.php?id='.$id_departemen.'" onclick="return hapus()" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                    ';
                                    $i++;
                                }

                                //
                                $q = mysqli_query($conn, 'SELECT id_departemen FROM detail_dmu GROUP BY id_departemen');
                                if (mysqli_num_rows($q) == 1) {
                                    echo '
                                            </tbody>
                                        </table>
                                    <button class="btn btn-info" type="button" disabled>Hitung Efisiensi</button>
                                    ';
                                } else {
                                    echo '
                                            </tbody>
                                        </table>
                                    <a href="../process/simplex.php" class="btn btn-info" type="button">Hitung Efisiensi</a>
                                    ';
                                }
                                
                            } else {
                                echo '
                                    <div class="alert alert-dismissible alert-warning">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <Strong>Data masih kosong</strong>. Silahkan tambah data pengguna.
                                    </div>
                                ';
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