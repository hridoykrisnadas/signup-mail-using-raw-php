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
    <link rel="icon" type="image/x-icon" href="images/fav.png">
</head>
<body>
  <div class = "bg-dark bg-gradient text-white p-2 vh-100">
    <?php
      foreach($result as $row){
        $name = $row['name'];
        $designation = $row['designation'];
        $age = $row['age'];
        $salary = $row['salary'];
        $mobile_no = $row['mobile_no'];
      }
    ?>

    <h1 class="text-center fw-bold text-warning p-2">Welcome Mr. <?php echo strtoupper($name)?></h1>
    <div class="position-absolute top-50 start-50 translate-middle">
      <h3 class="fw-bold text-warning text-center p-2">Your Information is here: </h3>
      <div class="p-2 text-center ">
        <h5>Full Name: <?php echo $name?></h5>
        <h5>Designation: <?php echo $designation?></h5>
        <h5>Age: <?php echo $age?></h5>
        <h5>Salary: $<?php echo $salary?> Only</h5>
        <h5>Mobile No: <?php echo $mobile_no?></h5>
        <a href="https://wa.me/+88<?php echo $mobile_no?>"><img src="images/whatsapp.webp" width="50px" height = "50px"></img></a>
      </div>  
    </div>
    <button type="button" class="btn btn-warning text-center rounded mx-auto d-block m-2 position-absolute bottom-0 start-50 translate-middle-x"><a href="logout.php" class="fw-bold text-decoration-none text-dark">Log Out</a></button>
  </div>
</body>
</html>