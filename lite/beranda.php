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
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap">
                                    <div class="text-justify">
                                        <?php
                                            if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
                                            echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Perhitungan berhasil</div>';
                                            }
                                        ?>
                                        <h3 class="card-title text-center">SELAMAT DATANG</h3>
                                        <h2 class="card-title text-center">Sistem Evaluasi Tenaga Kependidikan dan Non Kependidikan</h2>
                                        <h4 id="deskripsi">Sistem Evaluasi Tenaga Kependidikan dan Non Kependidikan merupakan sebuah sistem yang berfungsi untuk menghitung efisiensi kinerja departemen serta menentukan departemen yang terbaik. 
                                        <em>Output</em> dari sistem ini yaitu :
                                        <ul>
                                        	<li>Mendapatkan nilai efisiensi departemen</li>
                                        	<li>Mendapatkan rekomendasi untuk departemen belum efisien</li>
                                        	<li>Mendapatkan perangkingan dari departemen yang efisien</li>
                                        </ul>
                                        Departemen yang sudah efisien akan menjadi <em>benchmarking</em> bagi departemen lain yang belum efisien melalui rekomendasi yang dihasilkan. Sistem ini dibuat guna membantu pihak departemen dalam mengambil keputusan sebagai upaya dalam meningkatkan kinerja departemen.</h4>
                                    </div>
                                </div>
                            </div>
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
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<?php include 'script.php'; ?>