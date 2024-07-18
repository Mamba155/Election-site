<?php
session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../officer_login.php");
        exit();
    }

    include ('../configuration.php');

    $candidates = mysqli_query($database, " SELECT COUNT(*) AS row_count FROM `candidates` ");
    $candidate = mysqli_fetch_array($candidates); 

    $voters = mysqli_query($database, " SELECT COUNT(*) AS row_count FROM `voters` ");
    $voter = mysqli_fetch_array($voters); 



?>


<?php include("header.php"); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <b class="mr-3">Weldone! </b> <?= ($_SESSION['success']) ?>
            </div>
        <?php unset($_SESSION['success']); } ?>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <a href="all_candidates.php">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number of candidates</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $candidate['row_count']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <a href="all_voters.php">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of Voters</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $voter['row_count']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>

        </div>

        <!-- Content Row -->

        

        <!-- Content Row -->
        
    </div>
    <!-- /.container-fluid -->

<?php include("footer.php"); ?>