<?php

include 'partials/_dbconnect.php';

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['username'] != 'admin') {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bike Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            height: 100%;
            background-image: url("images/add.jpg");
            /* background-position: center; */
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .form-control {
            border-radius: 25px;
            margin-bottom: 15px;
        }

        .btn {
            border-radius: 25px;
        }

        img {
            float: left;
            margin: 5px;
            width: 230px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
        }

        h3 {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            margin-bottom: 20px;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
        }

        th, td {
            text-align: center;
        }

        .alert {
            border-radius: 10px;
            margin-top: 15px;
        }

        .no-bookings {
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
<section style="background:white;"><?php require 'partials/_nav.php' ?></section>

    <h3 class="text-center my-4">Bike Bookings</h3>
    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Bike Photo</th>
                    <th scope="col">Bike Name</th>
                    <th scope="col">Customer Username</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Bike Number</th>
                    <th scope="col">Final Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Call the stored procedure to fetch bookings
                $sql = "SELECT * FROM `bookings`";
                $result = mysqli_query($conn, $sql);

                // Check for query execution and result
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td> <img src='images/" . $row['bike_photo'] . "' > </td>
                                <td>" . $row['bike_name'] . "</td>
                                <td>" . $row['c_username'] . "</td>
                                <td>" . $row['booking_id'] . "</td>
                                <td>" . $row['bike_no'] . "</td>
                                <td>" . $row['final_price'] . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No bookings found.</td></tr>";
                    }
                } else {
                    // Display an error message if the query fails
                    echo "Query failed: " . mysqli_error($conn);
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>
