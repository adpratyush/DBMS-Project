<?php
session_start();
include 'partials/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Check if user is admin
if ($_SESSION['username'] === 'admin') {
    header("location: login.php");
    exit;
}

// Fetch booking information based on booking ID
if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];
    
    // Check if the bill already exists in the bills table
    $checkSql = "SELECT * FROM bills WHERE booking_id = '$bookingId'";
    $checkResult = mysqli_query($conn, $checkSql);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        // If the bill already exists, fetch and display it
        $bill = mysqli_fetch_assoc($checkResult);
    } else {
        // If the bill doesn't exist, insert it into the database
        $bookingSql = "SELECT * FROM bookings WHERE booking_id = '$bookingId'";
        $bookingResult = mysqli_query($conn, $bookingSql);

        if (!$bookingResult || mysqli_num_rows($bookingResult) === 0) {
            echo "No booking found for the provided booking ID.";
            exit;
        }

        // Fetch booking details
        $booking = mysqli_fetch_assoc($bookingResult);
        
        // Extract necessary information from the booking
        $customerName = $booking['c_username'];
        $bikeName = $booking['bike_name'];
        $bikeNumber = $booking['bike_no'];
        $price = $booking['final_price'];

        // Insert the bill into the database
        $insertSql = "INSERT INTO bills (customer_name, bike_name, bike_number, price, booking_id) 
                      VALUES ('$customerName', '$bikeName', '$bikeNumber', '$price', '$bookingId')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            // Fetch the newly inserted bill from the database
            $billSql = "SELECT * FROM bills WHERE booking_id = '$bookingId'";
            $billResult = mysqli_query($conn, $billSql);

            if ($billResult && mysqli_num_rows($billResult) > 0) {
                $bill = mysqli_fetch_assoc($billResult);
            } else {
                echo "Error fetching bill information: " . mysqli_error($conn);
                exit;
            }
        } else {
            echo "Error inserting bill into the database: " . mysqli_error($conn);
            exit;
        }
    }
} else {
    echo "Booking ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Bill</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- Include dom-to-image library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <!-- Include FileSaver.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            text-align: left;
            background-color: #f2f2f2;
        }
        .table td {
            vertical-align: top;
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5" id="billContent">
    <h2 class="mb-4">Generated Bill</h2>
    <table class="table">
        <tbody>
            <tr>
                <th>Bill Number:</th>
                <td><?php echo $bill['bill_id']; ?></td>
            </tr>
            <tr>
                <th>Booking ID:</th>
                <td><?php echo $bill['booking_id']; ?></td>
            </tr>
            <tr>
                <th>Customer Name:</th>
                <td><?php echo $bill['customer_name']; ?></td>
            </tr>
            <tr>
                <th>Bike Name:</th>
                <td><?php echo $bill['bike_name']; ?></td>
            </tr>
            <tr>
                <th>Bike Number:</th>
                <td><?php echo $bill['bike_number']; ?></td>
            </tr>
            <tr>
                <th>Price:</th>
                <td><?php echo $bill['price']; ?></td>
            </tr>
            <!-- You can add more details here -->
        </tbody>
    </table>
</div>

<button id="saveButton" class="btn btn-primary">Save Invoice</button>

<script>
document.getElementById('saveButton').addEventListener('click', function() {
    // Convert the bill content to image and save as JPEG
    domtoimage.toBlob(document.getElementById('billContent'))
        .then(function(blob) {
            saveAs(blob, 'bill.jpeg');
        });
});
</script>
</body>
</html>
