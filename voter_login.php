<?php
session_start();

    if (isset($_GET['func']) && $_GET['func'] === 'logout') {
        session_destroy();
        header("Location: voter_login.php");
        exit();
    }

    if (isset($_SESSION["id"]) && isset($_SESSION["role"])) {
        if ($_SESSION["role"] == "voter") {
            header("Location: all_candidates.php");
            exit();
        }
    } else {

        include ('configuration.php');

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $confirm = mysqli_query($database, "SELECT * FROM `voters` WHERE (`email` = '$email') AND (`password` = '$password') ");
            $user = mysqli_fetch_array($confirm);

            if($user > 0){
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = 'voter';
                $extra = 'all_candidates.php';
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                $link = "http://$host$uri/$extra";
                echo "<script>window.location.href='".$link."'</script>";
            }else{
                echo "<script>alert('Invalid login credentials. Please try again.'); window.location.href='" . $_SERVER['PHP_SELF'] . "'; </script>";
            }
        }
    }


?>

<?php include("header.php"); ?>

    <section class="px-lg-5 justify-content-center">

        <div class="container mx-0 px-0 py-5">
            <div>
                <h2 class="text-center text-primary mb-2">Sign-In</h2>
                <p class="text-center text-secondary mb-5">As a Voter</p>
            </div>
            <div class="row d-flex justify-content-center mb-5 px-lg-5 ">
                <div class="card items-center border-primary shadow rounded col-10 col-md-8 col-lg-6" >
                    <div class="card-body py-5 px-4">
                        <form action="" method="POST">
                            <div class="form-floating mb-4 shadow rounded">
                                <input type="email" name="email" class="form-control text-black" id="email" placeholder="">
                                <label for="email" style="background-color: transparent;">Email Address</label>
                            </div>
                            <div class="form-floating mb-4 shadow rounded">
                                <input type="password" name="password" class="form-control text-black" id="password" placeholder="">
                                <label for="password" style="background-color: transparent;">Password</label>
                            </div>
                            
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <hr/>
                            <button name="submit" type="submit" class="btn btn-primary btn-lg col-12">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php include("footer.php"); ?>