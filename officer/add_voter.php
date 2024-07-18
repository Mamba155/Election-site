<?php
session_start();

    include ('../configuration.php');

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
            die('no image');
        }
        $insert = mysqli_query($database, "INSERT INTO `voters` (`name`, `email`, `phone`, `address`, `id_number`, `council`, `picture`, `password`) VALUES ('$name','$email','$phone','$address','$idNo','$council','$pictureLink','$password')");
    
        if ($insert) {
            $extra = 'all_voters.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "Successfully added a new voter";
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
            <h1 class="h5 mb-0 text-gray-800">Register a new voter</h1>
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
                        <input type="email" name="email" class="form-control text-black" id="email" placeholder="voter@example.com">
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="phone">Phone Number</label>
                        <input type="phone" name="phone" class="form-control text-black" id="phone" placeholder="09012345678">
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control text-black" id="address" placeholder="2, street, town, state.">
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="idNo">ID Number</label>
                        <input type="text" name="idNo" class="form-control text-black" id="idNo" placeholder="09012345678" maxlength="11" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">
                    </div>
                    <div class="col-12 col-md-6 mb-3 rounded">
                        <label for="council">Council/Region</label>
                        <select name="council" class="form-control text-black" id="council">
                            <option value="" disabled selected>Select your region</option>
                            <option value="Manchester City Council">Manchester City Council</option>
                            <option value="Salford City Council">Salford City Council</option>
                            <option value="Bolton Council">Bolton Council</option>
                            <option value="Bury Council">Bury Council</option>
                            <option value="Oldham Council">Oldham Council</option>
                            <option value="Wigan Council">Wigan Council</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="picture">Voter picture</label>
                        <input type="file" name="picture"  class="form-control">
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control text-black" id="password" placeholder="your password">
                    </div>
                    <div class="col-12 col-md-6 mb-4 rounded">
                        <label for="confirmPass">Confirm Password</label>
                        <input type="password" name="confirmPass" class="form-control text-black" id="confirmPass" placeholder="confirm your password">
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-lg text-white form-control b fs-5 mt-3">REGISTER</button>
            </form>

        </div>

        <!-- Content Row -->



        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

<?php include("footer.php"); ?>