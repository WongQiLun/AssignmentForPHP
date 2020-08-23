<?php
require_once '../class/Rental.php';
?>

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        input[type=number], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .col-25, .col-75, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
</head>
<h2> Book Rental Web Service Client
</h2>
<div class="container">
    <form method = "post">

        <p>
        <div class="row">
            <div class="col-25">
                Book ID:
            </div>
            <div class="col-75">
                <input type="number" name = "bookID" value="" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                Staff ID:
            </div>
            <div class="col-75">
                <input type="number" name = "staffID" value="" /><br/>
            </div>
        </div>


        </p>
        <input type="submit" value="Rent" name="submit"/>
        <a href="../xmlFiles/books.xml" target="_blank">
            click me to see the catalog
        </a>
    </form>
</div>
<?php
if (isset($_POST['submit'])) {
    $bookID = $_POST['bookID'];
    $staffID = $_POST['staffID'];
    $user = unserialize($_SESSION['user']);
    $userID = $user->getUserID();
    // $userID = 1;

    $url = "http://localhost/AssignmentforPHP/PHPServices/RentalRESTService.php?bookID=" . $bookID .
            "&staffID=" . $staffID . "&userID=" . $userID;
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);
    $result = json_decode($response);

    echo "<p><h3>Date Rented :" . $result->dateRented . "</h3></p>";
    echo "<p><h3>Date to return :" . $result->dueDate . "</h3></p>";
}
// DOM PARSER HERE