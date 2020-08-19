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
        session_start();
        $Error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ((empty($_POST['name'])) || (empty($_POST['password']))) {
               $Error = "<span style=\"color:#ff0033\">*Invalid Username and/or password</span>";
            }

        }
        require_once '../SecurityClasses/DatabaseConnection.php';
        ?>
        <div class="main">
            <div class="sidenav">
                <div class="login-main-text">
                    <h2>Library<br> Login Page</h2>
                    <p>Login from here to access.</p>
                </div>
            </div>

            <div class="col-md-9 col-sm-12">
                <div class="login-form">

                    <form method="post" action="login.php">

                        <div class="form-group">
                            <label>UserName</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="User Name">

                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-black">Login</button>
                        
                                <?php echo $Error; ?>
                            
                    </form>
                    <p><label>Not a Member?</label><a href="register.php"> Register Here</a></p>
                </div>
            </div>
        </div>
    </body>
    <?php
    if ((isset($_POST['name'])) && isset($_POST['password'])) {
        $db = DatabaseConnection::getInstance();
        $username = trim($_POST['name']);
        $passwd = trim($_POST['password']);
        $authuser = $db->retrieveUser($username, $passwd);

        if ($authuser == null) {

            $Error = "<span style=\"color:#ff0033\">*Invalid Username and/or password</span>";
        } else {

            $_SESSION['userID'] = $authuser;
            $_SESSION['role']= "";//to do function to check oif user is staff
            header("Location: index.php");
        }
        $db->closeConnection();
    }
    ?>

</html>