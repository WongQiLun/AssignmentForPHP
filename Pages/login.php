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
        require_once '../class/Users.php';
        require_once '../SecurityClasses/DatabaseConnection.php';
        require_once '../SecurityClasses/InputValidation.php';
        session_start();
        $Error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ((empty($_POST['name'])) || (empty($_POST['password']))) {
                $Error = "<span style=\"color:#ff0033\">*Enter a Username and/or password</span>";
            }
        }
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

        $username = inputValidation::test_input($_POST['name']);
        $passwd = sha1(inputValidation::test_input($_POST['password']));
        $authuser = $db->retrieveUser($username, $passwd);

        if ($authuser == null) {

            $_SESSION['Error'] = "<span style=\"color:#ff0033\">*Invalid Username and/or password</span>";
        } else {
            //puts the object into session as a serialised object

            $_SESSION['user'] = serialize($authuser);

            //this is a way to retrieve the user from session data
            //$obj = unserialize($_SESSION['user']);

            header("Location: index.php");
        }
        $db->closeConnection();
    }
    ?>

</html>