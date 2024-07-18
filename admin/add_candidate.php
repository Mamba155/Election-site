<?php
session_start();

    include ('../configuration.php');

    if (isset($_POST['submit'])) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $name = $firstName . ' '. $lastName;
        $email = $_POST['email'];
        $position = $_POST['position'];
        $party = $_POST['party'];
        $manifesto = $_POST['manifesto'];
        $directory = "../images/candidates/";
        $picture = $_FILES["picture"]["name"];
        $model = $_FILES["picture"]["tmp_name"];
        if($picture){
            $extension = strtolower(pathinfo($picture,PATHINFO_EXTENSION));
            $pictureLink = 'candidate'.'_'.rand(10000,99999).'.'.$extension;
            move_uploaded_file($model,$directory.$pictureLink);
        }else{
            die('no image');
        }
        $insert = mysqli_query($database, "INSERT INTO `candidates` (`name`, `email`, `position`, `party`, `picture`, `manifesto`) VALUES ('$name','$email','$position','$party','$pictureLink','$manifesto')");
    
        if ($insert) {
            $extra = 'all_candidates.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "Successfully added a candidate";
            header("Location: $link"); 
            exit();
        } else {
            echo "<script>alert('Invalid registration credentials. Please try again.'); window.location.href='" . $_SERVER['PHP_SELF'] . "'; </script>";
        }

    }

?>

<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Add a new candidate</h1>
                <!-- <h4>Add Candidate</h4> -->
            </div>

            <!-- Content Row -->
            <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5" style="max-width: 50rem;">
                <form action="" method="POST" class="px-3 py-4" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" class="form-control text-black" id="firstName" placeholder="Adams">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" class="form-control text-black" id="lastName" placeholder="Williams">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control text-black" id="email" placeholder="candidate@example.com">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="position">Position</label>
                            <select name="position" class="form-control text-black" id="position">
                                <option value="" disabled selected>Select a position</option>
                                <option value="Mayor">Mayor</option>
                                <option value="Councillor">Councillor</option>
                                <option value="Treasurer">Treasurer</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Chairperson">Chairperson</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="party">Party Affiliation</label>
                            <select name="party" class="form-control text-black" id="party">
                                <option value="" disabled selected>Select party</option>
                                <option value="Labour Party">Labour Party</option>
                                <option value="Liberal Democrats">Liberal Democrats</option>
                                <option value="Green Party">Green Party</option>
                                <option value="UK Independence Party">UK Independence Party (UKIP)</option>
                                <option value="Scottish National Party">Scottish National Party (SNP)</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="picture">Candidate picture</label>
                            <input type="file" name="picture"  class="form-control">
                        </div>
                        <div class="col-12 mb-4 rounded">
                            <label for="manifesto">Manifesto</label>
                            <textarea name="manifesto" class="form-control text-black" id="manifesto" rows="4" maxlength="150" placeholder="Enter your manifesto with maximum of 150 characters"></textarea>
                        </div>

                        <script>
                            document.getElementById('manifesto').addEventListener('input', function () {
                                if (this.value.length > 150) {
                                    this.value = this.value.slice(0, 150);
                                }
                            });
                        </script>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg text-white form-control b fs-5 mt-3">REGISTER</button>
                </form>

            </div>

            <!-- Content Row -->



            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

<?php include("footer.php"); ?>