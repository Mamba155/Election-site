<?php
session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: voter_login.php");
        exit();
    }

    include ('configuration.php');

    $voters = mysqli_query($database, "SELECT * FROM `voters` ORDER BY `id` DESC ");

?>

<?php include("header.php"); ?>

    <section class="px-lg-5 px-3 justify-content-center mb-5">

        <div class="container-fluid py-5">
            <h2 class="text-center mb-5"><i class="fa fa-users mr-2" aria-hidden="true"></i> All Voters</h2>

            <div class="row">
            <?php foreach ($voters as $voter) { ?>
                <div class="col-md-6 col-lg-4 mb-3 px-0 px-md-2 px-lg-2">
                    <div class="rounded border-primary shadow-lg bg-light p-3" style="border: 1px solid red;">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-3"><?= $voter['name']; ?></h5>
                            <a href="images/voters/<?= $voter['picture']; ?>" target="_blank"><img src="images/voters/<?= $voter['picture']; ?>" style="height:50px;"></img></a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> Email</p>
                            <p class="text-secondary"><?= $voter['email']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-user-tie" aria-hidden="true"></i> ID Number</p>
                            <p class="text-secondary"><?= $voter['id_number']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-home" aria-hidden="true"></i> Council</p>
                            <p class="text-secondary"><?= $voter['council']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="all_candidates.php" type="button" class="btn btn-lg btn-outline-dark mx-3"><i class="fa fa-eye" aria-hidden="true"></i> Candidates</a>
                <a href="all_voters.php" type="button" class="btn btn-lg btn-dark"><i class="fa fa-eye" aria-hidden="true"></i> Voters</a>
            </div>
        </div>

    </section>

<?php include("footer.php"); ?>