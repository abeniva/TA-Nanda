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
                                            echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Perhitungan efisiensi berhasil</div>';
                                            }
                                        ?>
                                        <h3 class="card-title text-center">SELAMAT DATANG</h3>
                                        <h2 class="card-subtitle text-center">Sistem Evaluasi Tenaga Kependidikan dan Non Kependidikan</h2>
                                        <p>Penyelenggaraan satu sistem pendidikan nasional diamanatkan untuk Pemerintah melalui Undang-Undang Dasar 1945 dan telah diatur dengan undang-undang. Undang-undang yang dimaksud adalah Undang-Undang No.2 / 1989 tentang Sistem Pendidikan Nasional, Undang-Undang No.20 / 2003, dan Undang-Undang No.12 / 2012 tentang Pendidikan Tinggi. BAN-PT merupakan lembaga non-struktural di bawah Menteri Pendidikan dan Kebudayaan yang menunjang penyelenggaraan perguruan tinggi guna pembinaan penyelenggaraan perguruan tinggi, melayani kepentingan masyarakat, dan kemajuan ilmu pengetahuan dan teknologi untuk meningkatkan taraf kehidupan masyarakat serta memperkaya kebudayaan nasional (BAN-PT, 2014). BAN-PT memiliki sebelas tugas dan wewenang berdasarkan Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi Nomor 32 tahun 2016 salah satunya adalah melakukan akreditasi Perguruan Tinggi.</p>
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