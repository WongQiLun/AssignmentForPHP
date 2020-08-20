<!DOCTYPE html>
<?php
require_once '../SecurityClasses/DatabaseConnection.php';
require_once '../class/Returns.php';
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <?php
        require_once '../SecurityClasses/SessionManagement.php';
         require_once '../SecurityClasses/DatabaseConnection.php';
         require_once '../class/Rental.php';

        if (array_key_exists('logout', $_POST)) {
            SessionManagement::Logout();
        }
      if (array_key_exists('Rent', $_POST)) {
          $db = DatabaseConnection::getInstance();
          //$obj = unserialize($_SESSION['user']);
         
          $db->closeConnection();
        }
        ?>
        <form method="POST">
            <input type="submit" value="Rent"name="Rent"onClick="document.location.href = 'rent.php'" />
            <input type="button" value="return" onClick="document.location.href = 'return.php'" />
            <input type="submit" value="logout" name="logout" />
        </form> 


    </body>
</html>
