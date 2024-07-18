<?php
session_start();

    include ('configuration.php');

    $id = $_GET['id'];
    $oneCandidate = mysqli_query($database, "SELECT * FROM `candidates` WHERE (`id` = '$id') ");
    $candidate = mysqli_fetch_array($oneCandidate);

?>

<?php include("header.php"); ?>

    <section class="px-lg-5 px-3 justify-content-center mb-5">

        <div class="container-fluid py-5">
            <h2 class="text-center mb-5"><i class="fa fa-user-plus" aria-hidden="true"></i> <?= $candidate['name'] ?></h2>

            <div class="d-flex justify-content-center">
                <div class="col-md-10 col-lg-8 mb-3 px-0 px-md-2 px-lg-2">
                    <div class="rounded border-primary shadow-lg bg-light p-5" style="border: 1px solid red;">
                        
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-3"><?= $candidate['name'] ?></h5>
                            <a href="images/candidates/<?= $candidate['picture']; ?>" target="_blank"><img src="images/candidates/<?= $candidate['picture']; ?>" style="height:70px;" alt="profile"></img></a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> Email</p>
                            <p class="text-secondary"><?= $candidate['email'] ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-user-tie" aria-hidden="true"></i> Position</p>
                            <p class="text-secondary"><?= $candidate['position'] ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-flag-checkered" aria-hidden="true"></i> Party</p>
                            <p class="text-secondary"><?= $candidate['party'] ?></p>
                        </div>
                        <div class="text-secondary"><span class="mr-3 text-black"><i class="fa fa-paperclip" aria-hidden="true"></i> Manifesto:</span>
                            <?= $candidate['manifesto'] ?>
                        </div>

                        <hr class="mt-4 mb-5"/>

                        <div class="alert alert-warning" role="alert">
                            Stay tuned! Election day is coming up soon
                        </div>
                        
                        <!-- <div class="d-flex justify-content-between">
                            <a href="" type="button" class="btn btn-success col-12 py-3"><i class="fa fa-check-square mx-2" aria-hidden="true"></i> VOTE</a>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="all_candidates.php" type="button" class="btn btn-lg btn-dark mx-3"><i class="fa fa-eye" aria-hidden="true"></i> Candidates</a>
                <a href="all_voters.php" type="button" class="btn btn-lg btn-outline-dark"><i class="fa fa-eye" aria-hidden="true"></i> Voters</a>
            </div>
        </div>

    </section>

<?php include("footer.php"); ?>