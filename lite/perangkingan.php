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
                <h3 class="text-themecolor m-b-0 m-t-0">Perangkingan</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda_admin.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Perangkingan</li>
                </ol>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-body pad">
                        <h4 class="card-title">Hasil Perangkingan</h4>
                            <?php
                                $query = mysqli_query($conn, 'SELECT * FROM perhitungan_efisiensi WHERE nilai_efisiensi=1 GROUP BY id_departemen');
                                if (mysqli_num_rows($query)>1) {
                                    echo '
                                        <div class="table-responsive m-t-40">
                                            <table id="myTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Departemen</th>
                                                        <th>Nilai Preferensi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                    ';
                                    $i=1;
                                    $query= mysqli_query($conn,"SELECT d.nama_departemen, p.nilai_perangkingan FROM perangkingan AS p, departemen AS d WHERE d.id_departemen=p.id_departemen ORDER BY p.nilai_perangkingan DESC");
                                    if(mysqli_num_rows($query)>0){
                                        while ($variabel = mysqli_fetch_assoc($query)) {
                                            echo '
                                                <tr>
                                                    <td>'.$i.'</td>
                                                    <td>'.$variabel['nama_departemen'].'</td>
                                                    <td>'.$variabel['nilai_perangkingan'].'</td>
                                                </tr>
                                            ';
                                            $i++;
                                        }
                                        echo '
                                                </tbody>
                                                </table>
                                            </div>
                                            <p><b>Catatan: Perangkingan berdasarkan perhitungan TOPSIS karena nilai efisiensi > 1</b></p>
                                        ';
                                    } else {
                                        echo '
                                            <div class="alert alert-dismissible alert-warning">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <Strong>Data masih kosong</strong>. Silahkan lakukan perhitungan perangkingan.
                                            </div>
                                        ';
                                   }
                               } else {
                                    echo '
                                        <div class="table-responsive m-t-40">
                                            <table id="myTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Departemen</th>
                                                        <th>Nilai Efisiensi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                    ';
                                    $i=1;
                                    $query= mysqli_query($conn,"SELECT d.nama_departemen, p.nilai_efisiensi FROM perhitungan_efisiensi AS p, departemen AS d WHERE d.id_departemen=p.id_departemen GROUP BY p.id_departemen ORDER BY p.nilai_efisiensi DESC");
                                    if(mysqli_num_rows($query)>0){
                                        while ($variabel = mysqli_fetch_assoc($query)) {
                                            echo '
                                                <tr>
                                                    <td>'.$i.'</td>
                                                    <td>'.$variabel['nama_departemen'].'</td>
                                                    <td>'.$variabel['nilai_efisiensi'].'</td>
                                                </tr>
                                            ';
                                            $i++;
                                        }
                                        echo '
                                                </tbody>
                                                </table>
                                            </div>
                                            <p><b>Catatan: Perangkingan berdasarkan nilai efisiensi karena nilai efisiensi <= 1</b></p>
                                        ';
                                    }
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