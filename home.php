<?php
    include 'connect.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }

    $username = $_SESSION['username'];
    $user = "select * from `registration` where username = '$username'";
    $result = mysqli_query($con, $user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Home!</title>
</head>
<body>
  <div class = "bg-dark text-white p-2">
    <?php
      foreach($result as $row){
        $name = $row['name'];
        $designation = $row['designation'];
        $age = $row['age'];
        $salary = $row['salary'];
        $mobile_no = $row['mobile_no'];
      }
    ?>

    <h1 class="text-center">Welcome Mr. <?php echo strtoupper($name)?></h1>
    <h3 class="fw-bold ">Your Information is here: </h3>
    <div class="p-2">
      <h5>Full Name: <?php echo $name?></h5>
      <h5>Designation: <?php echo $designation?></h5>
      <h5>Age: <?php echo $age?></h5>
      <h5>Salary: <?php echo $salary?> BDT Only</h5>
      <h5>Mobile No: <?php echo $mobile_no?></h5>
    </div>  
    <button type="button" class="btn btn-warning"><a href="logout.php" class="fw-bold text-decoration-none text-dark">Log Out</a></button>
  </div>
</body>
</html>