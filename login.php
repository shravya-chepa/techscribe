<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <?php
  include('includes/functions.php');
  $con = connect_to_db();
  session_start();

  if (isset($_POST['username']) && !($_POST['username'] == null || $_POST['username'] == "")) {
    $username = stripslashes($_REQUEST['username']);
    $password = stripslashes($_REQUEST['password']);

    $result = loginUser($username, $password, $con) or die();

    $rows = $result;
    echo "$rows";
    if ($rows == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['loggedIn'] = true;

      header("Location: index.php");
    } else {
  ?><div class='form'>
        <h3>Incorrect Username/password.</h3><br />
        <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
      </div>;
    <?php }
  } else {
    ?>
    <div class="container">
      <div class="img">
        <a href="index.php"> <img src="assets/bg.png" />
        </a>
      </div>
      <div class="login-content">
        <form action="" method="post" name="login">
          <img src="" />
          <h2 class="title">Sign In</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Username</h5>
              <input type="text" class="input" name="username" />
            </div>
          </div>
          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Password</h5>
              <input type="password" class="input" name="password" />
            </div>
          </div>
          <input type="submit" class="btn" value="Login" />
          <a href="register.php">Not a member?</a>
        </form>
      </div>
    </div>
  <?php
  }
  ?>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>