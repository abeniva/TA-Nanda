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
                <h3 class="text-themecolor m-b-0 m-t-0">Variabel</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Lihat Variabel</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Daftar Variabel</h4>
                        <?php
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
                        ?>
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Variabel</th>
                                        <th>Variabel</th>
                                        <th>Satuan</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        $query= mysqli_query($conn,"SELECT * FROM variabel ORDER BY jenis_variabel, id_variabel ASC");
                                        if(mysqli_num_rows($query)>0){
                                            while ($variabel = mysqli_fetch_assoc($query)) {
                                                echo '<tr>
                                                        <td>'.$i.'</td>
                                                        <td>'.$variabel['nama_variabel'].'</td>
                                                        <td>'.$variabel['jenis_variabel'].'</td>                                                        
                                                        <td>'.$variabel['satuan'].'</td>
                                                        <td>'.$variabel['bobot'].'</td>
                                                        <td>
                                                            <a href="ubah_variabel.php?id='.$variabel['id_variabel'].'" class="btn btn-warning btn-sm">Ubah</a>
                                                            <a href="../process/h_variabel.php?id='.$variabel['id_variabel'].'" onclick="return hapus()" class="btn btn-danger btn-sm">Hapus</a>
                                                        </td>
                                                    </tr>
                                                ';
                                                $i++;
                                            }
                                        } else {
                                            echo '
                                                <div class="alert alert-dismissible alert-warning">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <Strong>Data masih kosong</strong>. Silahkan tambah data variabel.
                                                </div>
                                            ';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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