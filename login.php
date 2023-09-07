<?php
  $success = 0;
  $result = null;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $e_pass = hash('md5', $password);

    $user = "select * from `registration` where username = '$username' and password = '$e_pass'";
    $result = mysqli_query($con, $user);

    $num = mysqli_num_rows($result);
    if($num>0){
      $success = 1;
    } else {
      $success = -1;
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

    <title>Log In!</title>
  </head>
  <body>
    <div class="bg-warning p-3">
      <?php
        if($success == 1){
          foreach($result as $row){

            session_start();
            $_SESSION['username']=$username;
            header('location:home.php'); 
          }
        } else if($success == -1){
          echo '
          <div>  
          <h1 class="text-center bg-warning pt-3 pb-3">Wrong Credentials, Please enter valid username & password.</h1>
          </div>
            ';
        }
      ?>
      
      <div class = "container">
        <h1 class= "text-center">Log In Page</h1>
        <form action="login.php" method="POST">
          <div class="row p-3">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required placeholder="Enter your Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required placeholder = "Enter your password">
            </div>
            <button type="submit" class="btn btn-dark p-2">Submit</button>
          </div>
        </form>
        <h6 class="text-center fw-bold">Haven't any account! Please <a href="signup.php" class="text-dark">Signup Now..</a></h6>
      </div>
    </div>
  </body>
</html>
