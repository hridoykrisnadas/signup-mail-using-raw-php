<?php
  $success = 0;
  $user = 0;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $e_pass = hash('md5', $password);

    $existUsername = "select * from `registration` where username = '$username'";
    $usernameResult = mysqli_query($con, $existUsername);

    if($usernameResult){
      $num = mysqli_num_rows($usernameResult);
      if($num>0){
        $user = 1;
      } else{
        $sql = "insert into `registration` (username, password) 
        values('$username', '$e_pass')";
        $result = mysqli_query($con, $sql);
    
        if($result){
          $success = 1;
        } else{
          die(mysqli_error($con));
        }
      }
    }
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php
      if($user){
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Sign Up Failed!</strong> User Already Exists, Please Login.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <button type="button" class="btn btn-warning"><a href="login.php" class="fw-bold text-decoration-none text-dark">Log In</a></button>
        ';
      }
      if($success){
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Congratulations!</strong> User Registration Successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <button type="button" class="btn btn-warning"><a href="login.php" class="fw-bold text-decoration-none text-dark">Log In</a></button>
        ';
      }
    ?>
    
    <div class = "container">
      <h1 class= "text-center">Sign Up Page</h1>
      <form action="signup.php" method="POST">
      <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Enter your Username">
      </div>
      <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder = "Enter your password">
      </div>
      <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>
