<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
    <title>Election Site</title>
</head>

<body class="h-full" style="background-color: #efefef;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top px-lg-5 shadow-sm" style="background-color: #e3f2fd !important;">
        <div class="container-fluid">
            <!-- Left-aligned: Election Site -->
            <a class="navbar-brand h5" href="index.php">Election Site</a>

            <!-- Center-aligned: Nav Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($current_page == 'index.php'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="voter_login.php">Voter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="officer_login.php">Officer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_login.php">Admin</a>
                        </li>
                    <?php elseif (in_array($current_page, ['voter_login.php', 'officer_login.php', 'admin_login.php'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Right-aligned: Get Started / Logout -->
            <div class="d-flex">
                <?php if ($current_page == 'index.php'): ?>
                    <a class="btn btn-outline-primary" href="voter_login.php">Get Started</a>
                <?php elseif (!in_array($current_page, ['voter_login.php', 'officer_login.php', 'admin_login.php'])): ?>
                    <a href="voter_login.php?func=logout" class="btn btn-danger delete-link-logout">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const deleteLinks = document.querySelectorAll('.delete-link-logout');

                            deleteLinks.forEach(function(link) {
                                link.addEventListener('click', function(event) {
                                    // Prevent the default action of clicking the link
                                    event.preventDefault();

                                    // Ask for confirmation before proceeding
                                    const confirmation = window.confirm("Are you sure you want to logout?");
                                    
                                    // If user confirms, navigate to the specified link
                                    if (confirmation) {
                                        window.location.href = link.href;
                                    }
                                });
                            });
                        });
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top px-lg-5 shadow-sm" style="background-color: #e3f2fd !important;">
        <a class="navbar-brand" href="index.php">
            <h5 class="mr-5">Election Site</h5>
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="voter_login.php">Voter</a>
                <a class="nav-item nav-link" href="officer_login.php">Officer</a>
                <a class="nav-item nav-link" href="admin_login.php">Admin</a>
            </div>
        </div>
        <a href="voter_login.php" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Get Started <i class="fa fa-sign-in" aria-hidden="true"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav> -->