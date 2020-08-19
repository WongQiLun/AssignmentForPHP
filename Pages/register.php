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
        $nameErr= $passErr=$confirmPassErr=$phoneErr="";
        $counter=0;
        
        if ((!isset($_POST['name'])) || !isset($_POST['password'])) {
            
            if (empty($_SESSION['username'])) {
                echo 'incorrect username/ password please try again.';
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
                                <input type="text" class="form-control" name="name" id="name" placeholder="User Name">
                            </div>
                            <div class="form-group">
                                <label>Password*</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password*</label>
                                <input type="password" class="form-control" name="password_1" id="password_1" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="601XXXXXXXX">
                            </div>
                            <div class="form-group">
                                <label>Current Address</label>
                                <input type=text class="form-control" name="address" id="address" >
                            </div>
                            <button type="submit" class="btn btn-black">Register</button>

                        </form>
                        <p><label>Already a Member?</label><a href="login.php"> Login Here</a></p>
                    </div>
                </div>
            </div>
         </body>
            <?php
        } else {
            
            $username = trim($_POST['name']);
            $passwd = shal(trim($_POST['password']));
            $passwd1= shal(trim($_POST['password1']));
            $address= $_POST['address'];
            $phone = $_POST['phone'];
            $valid = new inputValidation();
            //validate password
            if ($valid->stringEquals($passwd, $passwd1)!=true){
                 //add error message 
                $confirmPassErr = "<span style=\"color:#ff0033\">Please confirm the passwords are correct</span>";
                return;
            }else{
                
            }
            $db = DatabaseConnection::getInstance();    
           
            //update database
            $db->closeConnection();
        }
        ?>
   
</html>