<?php
session_start();

    include ('../configuration.php');

    $id = $_GET['id'];
    $oneCandidate = mysqli_query($database, "SELECT * FROM `candidates` WHERE (`id` = '$id') ");
    $oldCandidate = mysqli_fetch_array($oneCandidate);

    $fullName = $oldCandidate['name'];
    $nameParts = explode(' ', $fullName, 2);

    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    if (isset($_POST['submit'])) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $name = $firstName . ' '. $lastName;
        $email = $_POST['email'];
        $position = $_POST['position'];
        $party = $_POST['party'];
        $manifesto = $_POST['manifesto'];
        $status = $_POST['status'];
        $directory = "../images/candidates/";
        $picture = $_FILES["picture"]["name"];
        $model = $_FILES["picture"]["tmp_name"];
        if($picture){
            $extension = strtolower(pathinfo($picture,PATHINFO_EXTENSION));
            $pictureLink = 'candidate'.'_'.rand(10000,99999).'.'.$extension;
            move_uploaded_file($model,$directory.$pictureLink);
        }else{
            die('please update candidate picture!');
        }
    
        $update = mysqli_query($database, "UPDATE `candidates` SET `name`='$name',`email`='$email',`position`='$position',`party`='$party',`picture`='$pictureLink',`manifesto`='$manifesto',`status`='$status' WHERE `id` = '$id' ");

        if ($update) {
            $extra = 'all_candidates.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "You've successfully updated candidate details";
            header("Location: $link"); 
            exit();
        } else {
            echo "<script>alert('Invalid credentials. Please try again.'); window.location.href='" . $_SERVER['PHP_SELF'] . "'; </script>";
        }

    }

?>

<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Update candidate's details</h1>
                <!-- <h4>Add Candidate</h4> -->
            </div>

            <!-- Content Row -->
            <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5" style="max-width: 50rem;">
                <form action="" method="POST" class="px-3 py-4" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" value="<?= $firstName ?>" class="form-control text-black" id="firstName" placeholder="Adams">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" value="<?= $lastName ?>" class="form-control text-black" id="lastName" placeholder="Williams">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" value="<?= $oldCandidate['email'] ?>" class="form-control text-black" id="email" placeholder="candidate@example.com">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="position">Position</label>
                            <select name="position" class="form-control text-black" id="position">
                                <option value="" disabled>Select a position</option>
                                <option value="Mayor" <?php echo ($oldCandidate['position'] == 'Mayor') ? 'selected' : ''; ?>>Mayor</option>
                                <option value="Councillor" <?php echo ($oldCandidate['position'] == 'Councillor') ? 'selected' : ''; ?>>Councillor</option>
                                <option value="Treasurer" <?php echo ($oldCandidate['position'] == 'Treasurer') ? 'selected' : ''; ?>>Treasurer</option>
                                <option value="Secretary" <?php echo ($oldCandidate['position'] == 'Secretary') ? 'selected' : ''; ?>>Secretary</option>
                                <option value="Chairperson" <?php echo ($oldCandidate['position'] == 'Chairperson') ? 'selected' : ''; ?>>Chairperson</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="party">Party Affiliation</label>
                            <select name="party" class="form-control text-black" id="party">
                                <option value="" disabled>Select party</option>
                                <option value="Labour Party" <?php echo ($oldCandidate['party'] == 'Labour Party') ? 'selected' : ''; ?>>Labour Party</option>
                                <option value="Liberal Democrats" <?php echo ($oldCandidate['party'] == 'Liberal Democrats') ? 'selected' : ''; ?>>Liberal Democrats</option>
                                <option value="Green Party" <?php echo ($oldCandidate['party'] == 'Green Party') ? 'selected' : ''; ?>>Green Party</option>
                                <option value="UK Independence Party" <?php echo ($oldCandidate['party'] == 'UK Independence Party (UKIP)') ? 'selected' : ''; ?>>UK Independence Party (UKIP)</option>
                                <option value="Scottish National Party" <?php echo ($oldCandidate['party'] == 'Scottish National Party (SNP)') ? 'selected' : ''; ?>>Scottish National Party (SNP)</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="picture">Candidate picture</label>
                            <input type="file" name="picture"  class="form-control">
                        </div>
                        <div class="col-12 col-md-9 mb-4 rounded">
                            <label for="manifesto">Manifesto</label>
                            <textarea name="manifesto" class="form-control text-black" id="manifesto" rows="4" maxlength="150" placeholder="Enter your manifesto with maximum of 150 characters"><?= $oldCandidate['manifesto'] ?></textarea>
                        </div>
                        <div class="col-12 col-md-3 mb-4 rounded">
                            <label for="status">Status</label>
                            <select name="status" class="form-control text-black" id="status">
                                <option value="pending" <?php echo ($oldCandidate['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="verified" <?php echo ($oldCandidate['status'] == 'verified') ? 'selected' : ''; ?>>Verify</option>
                            </select>
                        </div>

                        <script>
                            document.getElementById('manifesto').addEventListener('input', function () {
                                if (this.value.length > 150) {
                                    this.value = this.value.slice(0, 150);
                                }
                            });
                        </script>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg text-white form-control b fs-5 mt-3">UPDATE</button>
                </form>

            </div>

            <!-- Content Row -->



            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->


<?php include("footer.php"); ?>