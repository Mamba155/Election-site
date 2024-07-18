<?php

    include ('configuration.php');

    $messages = mysqli_query($database, "SELECT * FROM `announcement` ORDER BY `id` DESC ");

?>


<?php include("header.php"); ?>

<section class="hero px-md-5 mt-5 pb-5">
    <div class="container px-md-5">
        <div class="row">
            <div class="col-md-6">
                <h4 class="fw-bold secondaryC size2">Secure Your</h4>
                <h1 class="fw-bold text-gray size1">Vote</h1>
                <h5 class="fw-semibold ms-md-5 secondaryC" style="margin-top: -20px;">Through Digital platform</h5>
            </div>
            <div class="col-md-6">
                <div class="card shadow" style="width: 15rem; background-color:whitesmoke;">
                    <div class="card-body">
                        <div class="d-flex">
                            <i class="fa-solid fa-chart-line text-info fs-3 me-2"></i>
                            <h5 class="card-title  fw-bold fs-2">
                                80%
                            </h5>
                        </div>
                        <p class="card-text fs-6 text-black">
                            Increased voter Turnout
                        </p>
                    </div>
                </div>
                <div class="card shadow mt-5 ms-md-5" style="width: 18rem; background-color:whitesmoke">
                    <div class="card-body">
                        <h5 class="card-title fw-bold fs-2">
                            240+
                        </h5>
                        <p class="card-text text-black fs-6">
                            Higher User Satisfaction
                        </p>
                        <div class="b bg-info rounded-2 shadow p-2">
                            <div class="d-flex">
                                <div class="one">
                                    <p class="text-white fw-semibold fs-5">Cast Your Vote Now</p>
                                    <small class="fw-semibold" style="margin-top: -10px;">Voting is open ..</small>
                                </div>
                                <i class="fa-solid fa-arrow-right secondaryC fs-1 ms-3 mt-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-5">
    <div class="container mb-5">
        <div class="mb-5">
            <h2 class="text-center fw-bold"><i class="fa fa-user-tie" aria-hidden="true"></i> Latest Announcements</h2>
        </div>

        <?php foreach ($messages as $message) { ?>
        <div class="row mb-4">
            <div class="card bg-dark shadow-lg p-4" style="background-color: #344054 !important;">
                <div class="mb-3 d-flex justify-content-between">
                    <h3 class="text-info"><i class="fa fa-bullhorn text-warning px-3"></i> <?= $message['topic']; ?></h3>
                    <p class="text-warning"><?= $message['created_at']; ?></p>
                </div>
                <div class=""><p class="text-white"><?= $message['content']; ?></p></div>
            </div>
        </div>
        <?php } ?>
        
    </div>
</section>


<?php include("footer.php"); ?>