<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <?php

    include('includes/functions.php');

    $con = connect_to_db();

    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        // $username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_REQUEST['email']);
        // $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        // $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $result = createAcc($username, $email, $password, $create_datetime, $con);
        // $query = "INSERT into `users`(username,password,created_at,email) values ('$username','" . md5($password) . "', '$create_datetime','$email')";
        // $result = mysqli_query($con, $query);

        if ($result) {
            echo "<div class='form'>
            <h3>You are registered successfully.</h3><br/>
            <p class='link'>Click here to <a href='login.php'>Login</a></p>
            </div>";
        } else {
            echo "<div class='form'>
            <h3>Required fields are missing.</h3><br/>
            <p class='link'>Click here to <a href='register.php'>register</a> again.</p>
            </div>";
        }
    } else {
    ?>
        <div class="container">
            <div class="img">
                <img src="assets/bg.png" />
            </div>
            <div class="login-content">
                <form action="" method="post">
                    <img src="" />
                    <h2 class="title">Sign Up</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Username</h5>
                            <input type="text" class="input" name="username" required />
                        </div>
                    </div>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Email</h5>
                            <input type="email" class="input" name="email" required />
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input type="password" class="input" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required />
                        </div>
                    </div>

                    <input type="submit" class="btn" value="register" />
                    <a href="login.php">Already Have An Account?</a>
                </form>
            </div>
        </div>
    <?php }
    ?>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</body>

</html>