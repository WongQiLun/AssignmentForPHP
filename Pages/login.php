<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<head>
    <link href="login.css" rel="stylesheet">
</head>
<!------ Include the above in your HEAD tag ---------->

<div class="sidenav">
         <div class="login-main-text">
            <h2>Application<br> Login Page</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="post">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                  <button type="submit" class="btn btn-secondary">Register</button>
               </form>
            </div>
         </div>
      </div>
<?php
if ((!isset($_POST['name'])) || !isset($_POST['password'])) {

   } else {
        $db=new Authentication();
        $username = trim($_POST['name']);
        $passwd = sha1(trim($_POST['password']));
        $authuser=$db->AuthenticateUser($username,$passwd);
           
        if ($authuser == null) {
            echo "<p>Unauthorized user. </p>";
            echo "<p><a href='register.php'>Click here to register as a new user</a></p>";
        } else {            
            echo "<p><h2>Welcome $username!</h2></p>";
            echo "<p><a href='search.html'>Search Products</a></p>";
        }
        $db->closeConnection();
    }