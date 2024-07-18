<?php
session_start();

    include ('../configuration.php');

    $id = $_GET['id'];
    $oneOfficer = mysqli_query($database, "SELECT * FROM `officers` WHERE (`id` = '$id') ");
    $oldOfficer = mysqli_fetch_array($oneOfficer);

    $fullName = $oldOfficer['name'];
    $nameParts = explode(' ', $fullName, 2);

    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    if (isset($_POST['submit'])) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $name = $firstName . ' '. $lastName;
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $council = $_POST['council'];
        $password = $_POST['password'];
        $directory = "../images/officers/";
        $picture = $_FILES["picture"]["name"];
        $model = $_FILES["picture"]["tmp_name"];
        if($picture){
            $extension = strtolower(pathinfo($picture,PATHINFO_EXTENSION));
            $pictureLink = 'officer'.'_'.rand(10000,99999).'.'.$extension;
            move_uploaded_file($model,$directory.$pictureLink);
        }else{
            die('please update officer picture!');
        }

        $update = mysqli_query($database, "UPDATE `officers` SET `name`='$name',`email`='$email',`phone`='$phone',`council`='$council',`picture`='$pictureLink',`password`='$password' WHERE `id` = '$id' ");
    
        if ($update) {
            $extra = 'all_officers.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "You've successfully updated officer details";
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
            <h1 class="h5 mb-0 text-gray-800">Update election officer details</h1>
        </div>

        <!-- Content Row -->
        <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5" style="max-width: 50rem;">
            <form action="" method="post" class="px-3 py-4" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" value="<?= $firstName ?>" class="form-control text-black" id="firstName" placeholder="Adams" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" value="<?= $lastName ?>" class="form-control text-black" id="lastName" placeholder="Williams" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($oldOfficer['email']); ?>" class="form-control text-black" id="email" placeholder="officer@example.com" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="phone">Phone Number</label>
                        <input type="phone" name="phone" value="<?= htmlspecialchars($oldOfficer['phone']); ?>" class="form-control text-black" id="phone" placeholder="09012345678" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3 rounded">
                        <label for="council">Council/Region</label>
                        <select name="council" class="form-control text-black" id="council" required>
                            <option value="" disabled>Select your region</option>
                            <option value="Manchester City Council" <?php echo ($oldOfficer['council'] == 'Manchester City Council') ? 'selected' : ''; ?>>Manchester City Council</option>
                            <option value="Salford City Council" <?php echo ($oldOfficer['council'] == 'Salford City Council') ? 'selected' : ''; ?>>Salford City Council</option>
                            <option value="Bolton Council" <?php echo ($oldOfficer['council'] == 'Bolton Council') ? 'selected' : ''; ?>>Bolton Council</option>
                            <option value="Bury Council" <?php echo ($oldOfficer['council'] == 'Bury Council') ? 'selected' : ''; ?>>Bury Council</option>
                            <option value="Oldham Council" <?php echo ($oldOfficer['council'] == 'Oldham Council') ? 'selected' : ''; ?>>Oldham Council</option>
                            <option value="Wigan Council" <?php echo ($oldOfficer['council'] == 'Wigan Council') ? 'selected' : ''; ?>>Wigan Council</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="picture">Officer picture</label>
                        <input type="file" name="picture"  class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?= htmlspecialchars($oldOfficer['password']); ?>" class="form-control text-black" id="password" placeholder="your password" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="confirmPass">Confirm Password</label>
                        <input type="text" name="confirmPass" value="<?= htmlspecialchars($oldOfficer['password']); ?>" class="form-control text-black" id="confirmPass" placeholder="confirm your password" required>
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