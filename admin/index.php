<?php
session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../admin_login.php");
        exit();
    }

    include ('../configuration.php');

    $candidates = mysqli_query($database, " SELECT COUNT(*) AS row_count FROM `candidates` ");
    $candidate = mysqli_fetch_array($candidates); 

    $pending = mysqli_query($database, " SELECT COUNT(*) AS row_count FROM `candidates` WHERE `status` = 'pending' ");
    $unverified = mysqli_fetch_array($pending); 

    $voters = mysqli_query($database, " SELECT COUNT(*) AS row_count FROM `voters` ");
    $voter = mysqli_fetch_array($voters); 

    $officers = mysqli_query($database, " SELECT COUNT(*) AS row_count FROM `officers` ");
    $officer = mysqli_fetch_array($officers);



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
            <div class="col-xl-3 col-md-6 mb-4">
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

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="verify_candidate.php">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unverified Candidates</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $unverified['row_count']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
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

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="all_officers.php">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Officers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $officer['row_count']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->

<?php include("footer.php"); ?>