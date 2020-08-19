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
        if ((!isset($_POST['name'])) || !isset($_POST['password'])) {
            session_start();
            if (empty($_SESSION['username'])) {
                echo 'incorrect username/ password please try again.';
            }
            ?>
            <div class="sidenav">
                <div class="login-main-text">
                    <h2>Application<br> Login Page</h2>
                    <p>Login or register from here to access.</p>
                </div>
            </div>
            <div class="main">
                <div class="col-md-6 col-sm-12">
                    <div class="login-form">
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="User Name">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-black">Login</button>
                            <button type="submit" class="btn btn-secondary" >Register</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else {
            $db = DatabaseConnection::getInstance();
            $username = trim($_POST['name']);
            $passwd = shal(trim($_POST['password']));
            $authuser = $db->retrieveUser($username, $passwd);

            if ($authuser == null) {
                echo "<p>Unauthorized user. </p>";
                echo "<p><a href='register.php'>Click here to register as a new user</a></p>";
            } else {
                echo "<p><h2>Welcome $username!</h2></p>";
                echo "<p><a href='search.html'>Search Products</a></p>";
            }
            $db->closeConnection();
        }
        ?>
    </body>
</html>