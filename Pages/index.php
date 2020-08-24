<!DOCTYPE html>
<?php
require_once '../SecurityClasses/DatabaseConnection.php';
require_once '../class/Returns.php';
require_once '../SecurityClasses/SessionManagement.php';
require_once '../SecurityClasses/AccessControl.php';
require_once '../class/Rental.php';
?>
<!--Author : Wong Qi Lun-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Index</title>

    </head>
    <style>
        .btn-group input {
            border: 1px solid ; /* Green border */
            padding: 10px 24px; /* Some padding */
            margin:10px auto; 
            height: 100px;
            size: 40px;
            cursor: pointer; /* Pointer/hand icon */
            width: 50%; /* Set a width if needed */
            display: block; /* Make the buttons appear below each other */
        }

        .btn-group  input :not(:last-child) {
            border-bottom: none; /* Prevent double borders */
        }

        /* Add a background color on hover */
        .btn-group  input :hover {
            background-color: #3e8e41;
        }
    </style>
    <body>
        <?php        
        AccessControl::checkUser();
        if (array_key_exists('logout', $_POST)) {
            SessionManagement::Logout();
        }
        if (array_key_exists('Rent', $_POST)) {
            $db = DatabaseConnection::getInstance();
            $db->createBookXMLFile();
            $db->closeConnection();

            header("Location: rent.php");
        }
        if(array_key_exists('return', $POST)){
            $db = DatabaseConnection::getInstance();
            $db->createRentXMLFile();
            $db->closeConnection();
        }
        ?>
        <form method="POST" action="index.php" >
            <div class="btn-group">
                <input type="submit"value="Rent"name="Rent" onClick="document.location.href = 'rent.php'" />
                <input type="button" value="return" onClick="document.location.href = 'return.php'" />
                <input type="submit"  value="logout" name="logout" />
                <?php AccessControl::LoadStaffControl(); ?>
            </div>
        </form> 


    </body>
</html>
