<?php
session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../admin_login.php");
        exit();
    }

    include ('../configuration.php');

    $id = $_GET['id'];
    $oneAdmin = mysqli_query($database, "SELECT * FROM `admin` WHERE (`id` = '$id') ");
    $admin = mysqli_fetch_array($oneAdmin);

    $fullName = $admin['name'];
    $nameParts = explode(' ', $fullName, 2);

    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    if (isset($_POST['submit'])) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $name = $firstName . ' '. $lastName;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $update = mysqli_query($database, "UPDATE `admin` SET `name`='$name',`email`='$email',`password`='$password' WHERE `id` = '$id' ");
    
        if ($update) {
            $extra = 'index.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "You've successfully updated your details. Try logout and signin again to view changes!";
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

        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <b class="mr-3">Weldone!</b> <?= ($_SESSION['success']) ?>
            </div>
        <?php unset($_SESSION['success']); } ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Update your details</h1>
        </div>

        <!-- Content Row -->
        <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5" style="max-width: 50rem;">
            <form action="" method="post" class="px-3 py-4">
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
                        <input type="email" name="email" value="<?= htmlspecialchars($admin['email']); ?>" class="form-control text-black" id="email" placeholder="officer@example.com" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?= htmlspecialchars($admin['password']); ?>" class="form-control text-black" id="password" placeholder="your password" required>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="confirmPass">Confirm Password</label>
                        <input type="text" name="confirmPass" value="<?= htmlspecialchars($admin['password']); ?>" class="form-control text-black" id="confirmPass" placeholder="confirm your password" required>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-lg text-white form-control b fs-5 mt-3">UPDATE</button>
            </form>

        </div>

        <!-- Content Row -->

    </div>   
    <!-- /.container-fluid -->

<?php include("footer.php"); ?>