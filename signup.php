<?php
  $success = 0;
  $user = 0;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    $mobile_no = $_POST['mobile_no'];
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
        $sql = "insert into `registration` (username, password, name, designation, age, salary, mobile_no) 
        values('$username', '$e_pass', '$name', '$designation', '$age', '$salary', '$mobile_no')";
        $result = mysqli_query($con, $sql);
    
        if($result){
          $success = 1;
          header('location:login.php'); 
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

    <title>Sign Up!</title>
    <link rel="icon" type="image/x-icon" href="images/fav.png">
  </head>
  <body>
    <div class = "bg-warning bg-gradient p-3 vh-100">
      <?php
        if($user){
          echo '
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sign Up Failed!</strong> User Already Exists, Please Login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          ';
        }
      ?>
      
      <div class = "container p-3">
        <img src="images/signup.png" alt="Sign Up" class="rounded mx-auto d-block"></>
        <form action="signup.php" method="POST">
          <div class = "row px-5 mx-5">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" id="name" Required placeholder="Enter your Name">
            </div>
            <div class="col-md-6 mb-3">
              <label for="designation" class="form-label">Designation</label>
              <input type="text" name="designation" class="form-control" id="designation" Required placeholder="Enter your Designation">
            </div>
            <div class="col-md-4 mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" name="age" class="form-control" id="age" Required placeholder="Enter your Age">
            </div>
            <div class="col-md-4 mb-3">
              <label for="salary" class="form-label">Salary</label>
              <input type="number" name="salary" class="form-control" id="salary" Required placeholder="Enter your Salary">
            </div>
            <div class="col-md-4 mb-3">
              <label for="mobile_no" class="form-label">Mobile No</label>
              <input type="text" name="mobile_no" class="form-control" id="mobile_no" maxlength="11" Required placeholder="Enter your Mobile No">
            </div>
            <div class="col-md-6 mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" Required placeholder="Enter your Username">
            </div>
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" Required placeholder = "Enter your password">
            </div>
            <button type="submit" class="btn btn-dark p-2">Submit</button>
          </div>
        </form>
        <h6 class="text-center mt-2 fw-bold">Already have account! Please <a href="login.php" class="text-dark">Login Now..</a></h6>
      </div>
    </div>
  </body>
</html>
