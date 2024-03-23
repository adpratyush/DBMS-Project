<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <title>Welcome Admin</title>
    <style>
        body, html {
            height: 100%;
        }

        body {
            /* The image used */
            background-image: url("images/login.png");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .form-control {
            border-radius: 25px;
        }

        .btn {
            border-radius: 25px;
        }

        .container {
            margin-top: 50px;
        }

        h3 {
            color: #fff;
            text-shadow: 2px 2px 4px #000;
        }

        .card {
            border-radius: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .card-body {
            background-color: #333;
            color: #fff;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .card-title {
            font-weight: bold;
        }

        /* Custom Button Style */
        .btn {
  font-family: "Open Sans", sans-serif;
  font-size: 16px;
  letter-spacing: 1px;
  text-decoration: none;
  text-transform: uppercase;
  color: #000;
  cursor: pointer;
  border: 3px solid;
  padding: 0.25em 0.5em;
  box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
  position: relative;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
    }
    .btn:active {
    box-shadow: 0px 0px 0px 0px;
    top: 5px;
    left: 5px;
    }

    @media (min-width: 768px) {
    .btn {
        padding: 0.25em 0.75em;
    }
    }
        </style>
</head>
<body>
  <section style="background:white;"><?php require 'partials/_nav.php' ?></section>
    
    <div class="container">
        <h3 class="text-center my-4"><strong>Welcome Admin</strong></h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg" style="width: 18rem;">
                    <img src="images/r1.jpeg" class="card-img-top" alt="...">
                    <div class="card-body my-2">
                        <h5 class="card-title">Add or Remove Bikes</h5>
                        <p class="card-text">Add or remove bikes by clicking below.</p>
                        <a href="add_removebikes.php" class="btn btn-primary">Add/Remove Bikes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg" style="width: 18rem;">
                    <img src="images/Yamaha.jpg" class="card-img-top" alt="...">
                    <div class="card-body my-2">
                        <h5 class="card-title">Add/Remove Company</h5>
                        <p class="card-text">Add or remove companies by clicking below.</p>
                        <a href="add_removecomp.php" class="btn btn-primary">Add/Remove Company</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg" style="width: 18rem;">
                    <img src="book.jpg" class="card-img-top" alt="...">
                    <div class="card-body my-2">
                        <h5 class="card-title">View Bike Bookings</h5>
                        <p class="card-text">View details of customers who have booked bikes..</p>
                        <a href="cust_bookings.php" class="btn btn-primary">View Bike Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <?php require 'partials/footer.php' ?>
</body>
</html>
