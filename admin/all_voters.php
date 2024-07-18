<?php
session_start();

include ('../configuration.php');

    # DELETE BUTTON
    if((isset($_GET['func'])) && ($_GET['func'] == 'delete')){
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `voters` WHERE `id` = '$deleteID' ");
        
        if($delete){
            $extra = "all_voters.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have deleted this user successfully.";
            header("Location: $link"); 
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href='" . $link . "'; </script>";
        }
    }

    $voters = mysqli_query($database, "SELECT * FROM `voters` ORDER BY `id` DESC ");

?>

<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <b class="mr-3">Thank you!</b> <?= ($_SESSION['success']) ?>
            </div>
        <?php unset($_SESSION['success']); } ?>

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">All voters</h1>
                <!-- <h4>Add Candidate</h4> -->
            </div>

            <!-- Content Row -->
            
                <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="h6 m-0 font-weight-bold text-primary">Recently Added</h6>
                            <a href="add_voter.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm mr-2 text-white-50"></i> Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Picture</th>
                                            <th>Full Name</th>
                                            <th>Council</th>
                                            <th>ID Number</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Picture</th>
                                            <th>Full Name</th>
                                            <th>Council</th>
                                            <th>ID Number</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $id = 1; foreach ($voters as $voter) { ?>
                                        <tr>
                                            <td><?= $id++; ?></td>
                                            <td><a href="../images/voters/<?= $voter['picture']; ?>" target="_blank"><img src="../images/voters/<?= $voter['picture']; ?>" style="height:50px;"></img></a></td>
                                            <td><?= htmlspecialchars($voter['name']) ?></td>
                                            <td><?= htmlspecialchars($voter['council']) ?></td>
                                            <td><?= htmlspecialchars($voter['id_number']) ?></td>
                                            <td><?= htmlspecialchars($voter['email']) ?></td>
                                            <td><?= htmlspecialchars($voter['phone']) ?></td>
                                            <td><?= htmlspecialchars($voter['address']) ?></td>
                                            <td><a href="edit_voter.php?id=<?= $voter['id']; ?>" class="text-blue"><i class="fa fa-edit"></i></a></td>
                                            <td><a href="all_voters.php?id=<?= $voter['id']; ?>&func=delete" class="text-danger delete-link-<?= $voter['id']; ?>"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const deleteLinks = document.querySelectorAll('.delete-link-<?= $voter['id']; ?>');

                                                deleteLinks.forEach(function(link) {
                                                    link.addEventListener('click', function(event) {
                                                        // Prevent the default action of clicking the link
                                                        event.preventDefault();

                                                        // Ask for confirmation before proceeding
                                                        const confirmation = window.confirm("Are you sure you want to delete this user record?");
                                                        
                                                        // If user confirms, navigate to the specified link
                                                        if (confirmation) {
                                                            window.location.href = link.href;
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


            <!-- Content Row -->



            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

<?php include("footer.php"); ?>