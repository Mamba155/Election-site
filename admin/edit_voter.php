<?php
session_start();

    include ('../configuration.php');

    $id = $_GET['id'];
    $oneVoter = mysqli_query($database, "SELECT * FROM `voters` WHERE (`id` = '$id') ");
    $oldVoter = mysqli_fetch_array($oneVoter);

    $fullName = $oldVoter['name'];
    $nameParts = explode(' ', $fullName, 2);

    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    if (isset($_POST['submit'])) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $name = $firstName . ' '. $lastName;
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $idNo = $_POST['idNo'];
        $council = $_POST['council'];
        $password = $_POST['password'];
        $directory = "../images/voters/";
        $picture = $_FILES["picture"]["name"];
        $model = $_FILES["picture"]["tmp_name"];
        if($picture){
            $extension = strtolower(pathinfo($picture,PATHINFO_EXTENSION));
            $pictureLink = 'voter'.'_'.rand(10000,99999).'.'.$extension;
            move_uploaded_file($model,$directory.$pictureLink);
        }else{
            die('please update voter picture!');
        }
    
        $update = mysqli_query($database, "UPDATE `voters` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address',`id_number`='$idNo',`council`='$council',`picture`='$pictureLink',`password`='$password' WHERE `id` = '$id' ");

        if ($update) {
            $extra = 'all_voters.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "You've successfully updated voter details";
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
                <h1 class="h5 mb-0 text-gray-800">Update voter's details</h1>
            </div>

            <!-- Content Row -->
            <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5" style="max-width: 50rem;">
                <form action="" method="post" class="px-3 py-4" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" value="<?= htmlspecialchars($firstName); ?>" class="form-control text-black" id="firstName" placeholder="Adams">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" value="<?= htmlspecialchars($lastName); ?>" class="form-control text-black" id="lastName" placeholder="Williams">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($oldVoter['email']); ?>" class="form-control text-black" id="email" placeholder="voter@example.com">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="phone">Phone Number</label>
                            <input type="phone" name="phone" value="<?= htmlspecialchars($oldVoter['phone']); ?>" class="form-control text-black" id="phone" placeholder="09012345678">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="<?= htmlspecialchars($oldVoter['address']); ?>" class="form-control text-black" id="address" placeholder="2, street, town, state.">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="idNo">ID Number</label>
                            <input type="text" name="idNo" value="<?= htmlspecialchars($oldVoter['id_number']); ?>" class="form-control text-black" id="idNo" placeholder="09012345678" maxlength="11" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">
                        </div>
                        <div class="col-12 col-md-6 mb-3 rounded">
                            <label for="council">Council/Region</label>
                            <select name="council" class="form-control text-black" id="council">
                                <option value="" disabled>Select your region</option>
                                <option value="Manchester City Council" <?php echo ($oldVoter['council'] == 'Manchester City Council') ? 'selected' : ''; ?>>Manchester City Council</option>
                                <option value="Salford City Council" <?php echo ($oldVoter['council'] == 'Salford City Council') ? 'selected' : ''; ?>>Salford City Council</option>
                                <option value="Bolton Council" <?php echo ($oldVoter['council'] == 'Bolton Council') ? 'selected' : ''; ?>>Bolton Council</option>
                                <option value="Bury Council" <?php echo ($oldVoter['council'] == 'Bury Council') ? 'selected' : ''; ?>>Bury Council</option>
                                <option value="Oldham Council" <?php echo ($oldVoter['council'] == 'Oldham Council') ? 'selected' : ''; ?>>Oldham Council</option>
                                <option value="Wigan Council" <?php echo ($oldVoter['council'] == 'Wigan Council') ? 'selected' : ''; ?>>Wigan Council</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="picture">Voter picture</label>
                            <input type="file" name="picture"  class="form-control">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="<?= htmlspecialchars($oldVoter['password']); ?>" class="form-control text-black" id="password" placeholder="your password">
                        </div>
                        <div class="col-12 col-md-6 mb-4 rounded">
                            <label for="confirmPass">Confirm Password</label>
                            <input type="text" name="confirmPass" value="<?= htmlspecialchars($oldVoter['password']); ?>" class="form-control text-black" id="confirmPass" placeholder="confirm your password">
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg text-white form-control b fs-5 mt-3">UPDATE</button>
                </form>

            </div>

            <!-- Content Row -->



            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

<?php include("footer.php"); ?>