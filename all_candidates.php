<?php
session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: voter_login.php");
        exit();
    }

    include ('configuration.php');

    $candidates = mysqli_query($database, "SELECT * FROM `candidates` WHERE `status` = 'verified' ORDER BY `id` DESC ");

?>

<?php include("header.php"); ?>

    <section class="px-lg-5 px-3 justify-content-center mb-5">

        <div class="container-fluid py-5">
            <h2 class="text-center mb-5"><i class="fa fa-user-tie mr-2" aria-hidden="true"></i> All Candidates</h2>

            <div class="row">
            <?php foreach ($candidates as $candidate) { ?>
                <div class="col-md-6 col-lg-4 mb-3 px-0 px-md-2 px-lg-2">
                    <div class="rounded border-primary shadow-lg bg-light p-3" style="border: 1px solid red;">
                        
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-3"><?= $candidate['name']; ?></h5>
                            <a href="images/candidates/<?= $candidate['picture']; ?>" target="_blank"><img src="images/candidates/<?= $candidate['picture']; ?>" style="height:50px;"></img></a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> Email</p>
                            <p class="text-secondary"><?= $candidate['email']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-user-tie" aria-hidden="true"></i> Position</p>
                            <p class="text-secondary"><?= $candidate['position']; ?></p>
                        </div>
                        <div class="text-secondary"><?= $candidate['manifesto']; ?></div>

                        <hr class="mt-0 mt-2"/>
                        
                        <div class="d-flex justify-content-between">
                            <a href="single_candidate.php?id=<?= $candidate['id']; ?>">View full details</a>
                            <span class="badge text-bg-success"><?= $candidate['status'] ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
                
            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="all_candidates.php" type="button" class="btn btn-lg btn-dark mx-3"><i class="fa fa-eye" aria-hidden="true"></i> Candidates</a>
                <a href="all_voters.php" type="button" class="btn btn-lg btn-outline-dark"><i class="fa fa-eye" aria-hidden="true"></i> Voters</a>
            </div>
        </div>

    </section>

<?php include("footer.php"); ?>