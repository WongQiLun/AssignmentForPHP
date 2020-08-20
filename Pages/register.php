<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<head>
    <link href="login.css" rel="stylesheet">
    <title>Login page</title>
</head>
<!------ Include the above in your HEAD tag ---------->
<html>
    <body>
        <?php
        require_once '../SecurityClasses/DatabaseConnection.php';
         require_once '../SecurityClasses/inputValidation.php';
        
        $nameErr = $passErr = $confirmPassErr = $AddressErr = $phoneErr = "";
        $name = $passwdcon = $passwd = $Address = $phone = "";
        $counter = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            //validate password
            if (empty($_POST["password"])) {
                $passErr = "<span style=\"color:#ff0033\">Please enter a password</span>";
                $counter++;
            }
            else{
                $passwd = inputValidation::test_input(($_POST["password"]));
            }
            if ($valid->stringEquals($passwd, $_POST["password_1"]) != true || empty($_POST["password_1"]) ){
                //add error message 
                $confirmPassErr .= "<span style=\"color:#ff0033\">Please confirm the passwords are correct</span>";
                $counter++;
            }
            else {
                $passwdcon= inputValidation::test_input($_POST["password_1"]);
            }
            if (empty($_POST['name'])) {
                $nameErr = "<span style=\"color:#ff0033\">Please enter a Username</span>";
                $counter++;
            }
            elseif(!inputValidation::duplicateUsernameCheck($_POST['name'])){
               $nameErr .= "<span style=\"color:#ff0033\">Please enter a Different Username</span>";
                $counter++;
            }else {
                $name = inputValidation::test_input($_POST['name']);
            }

            if (empty($_POST['address'])) {
                $addressErr = "<span style=\"color:#ff0033\">Please enter an Address</span>";
                $counter++;
            }
            else {
                $Address= inputValidation::test_input($_POST['address']);
            }
                
            if (empty($_POST['phone'])) {
                $phoneErr = "<span style=\"color:#ff0033\">Please enter an Phone Number/span>";
                $counter++;
            }
            else{
                $phone= inputValidation::test_input($_POST['phone']);
            }
                
        }
        ?>
        <div class="sidenav">
            <div class="login-main-text">
                <h2>Library<br> Register Page</h2>
                <p>Register from here to access.</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-9 col-sm-12">
                <div class="register-form">
                    <form method="post" action="Register.php">
                        <div class="form-group">
                            <label>UserName*</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Username" value=<?php echo $name ?>>
                        </div>
                        <?php echo $nameErr?>
                        <div class="form-group">
                            <label>Password*</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value=<?php echo $passwd ?>>
                        </div>
                        <?php echo $passErr?>
                        <div class="form-group">
                            <label>Confirm Password*</label>
                            <input type="password" class="form-control" name="password_1" id="password_1" placeholder="Confirm Password">
                        </div>
                         <?php echo $confirmPassErr?>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="601XXXXXXXX"value=<?php echo $phone ?>>
                        </div>
                         <?php echo $phoneErr?>
                        <div class="form-group">
                            <label>Current Address</label>
                            <input type=text class="form-control" name="address" id="address"  value=<?php echo $Address ?>>
                        </div>
                        <?php echo $AddressErr?>
                        <button type="submit" class="btn btn-black">Register</button>

                    </form>
                    <p><label>Already a Member?</label><a href="login.php"> Login Here</a></p>
                </div>
            </div>
        </div>
    </body>
    <?php
    //check for entry length because of limited sql space; todo



    $db = DatabaseConnection::getInstance();

    //update database
    $db->closeConnection();
    ?>

</html>