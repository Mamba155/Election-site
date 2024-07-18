<?php
session_start();

    include ('../configuration.php');

    if (isset($_POST['submit'])) {

        $topic = $_POST['topic'];
        $content = $_POST['content'];

        $upload = mysqli_query($database, "INSERT INTO `announcement` (`topic`, `content`) VALUES ('$topic','$content')");
    
        if ($upload) {
            $extra = 'index.php';
            $host = $_SERVER['HTTP_HOST'];
            $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$url/$extra";
            $_SESSION['success'] = "Message has been successfully sent";
            header("Location: $link"); 
            exit();
        } else {
            echo "<script>alert('Invalid inputs. Please try again.'); window.location.href='" . $_SERVER['PHP_SELF'] . "'; </script>";
        }

    }

?>

<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Broadcast a message</h1>
            </div>

            <!-- Content Row -->
            <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5" style="max-width: 35rem;">
                <form action="" method="post" class="px-3 py-4">
                    <div class="row">
                        <div class="col-12 mb-4 rounded">
                            <label for="topic">Topic</label>
                            <input type="text" name="topic" class="form-control text-black" id="topic" placeholder="Enter message topic" required>
                        </div>
                        <div class="col-12 mb-4 rounded">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control text-black" id="content" rows="4" placeholder="Enter message content" required></textarea>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-lg text-white form-control b fs-5 mt-3">UPLOAD</button>
                </form>

            </div>

            <!-- Content Row -->



            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

<?php include("footer.php"); ?>