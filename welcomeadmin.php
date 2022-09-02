<?php

session_start();

include 'dbconnect.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: Admin.php");
    exit;
}
else{

  // $username = $_SESSION['username'];
  // $sql = "Select * from logindetails where Email='$username'";
  // $result = mysqli_query($con,$sql);
  // $rows = mysqli_fetch_assoc($result);
  // $USN = $rows['USN'];
  // $query = "select * from student_details where St_USN = '$USN' ";
  // $result1 = mysqli_query($con,$query);
  // $rows1 = mysqli_fetch_assoc($result1);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;600&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comforter+Brush&family=Padauk:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">

    <title>Welcome Admin</title>

    <style>
        .h3{
            margin-left: 95px;
            margin-right: 1040px;
        }
        .img-area{
          background-image: url("Images/bg1.jpg");
          -webkit-background-size: cover;
          background-size: cover;
          background-position: center center;
          height: 100vh;
          position: fixed;
          left: 0;
          right: 0;
          z-index: -1;
          filter: blur(8px);
          -webkit-filter: blur(8px);
          
       }
        .header{
            margin-right: 30%;
            margin-left: 30%;
        }
        .nav{
          padding: 8px;
          margin-right: 30%;
          margin-left: 2%;
          border-radius: 8px;
        }
    </style>

</head>
<body>
<div class="img-area"></div>

<div class="bg-dark bg-gradient text-white header">Hostel Management</div><br>

    <div class="nav nav-pills nav">
      <ul class="bg-dark bg-dark text-white nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link navs" aria-current="page" href="welcomeadmin.php">HOME</a>
        </li>
        <li class="nav-item">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle navs" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Room</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="AddNewStudent.php">Add Student</a></li>
            <li><a class="dropdown-item" href="DeleteStudent.php">Delete Student</a></li>
            <li><a class="dropdown-item" href="Update.php">Change Room</a></li>
          </ul>
        </li>
          <a class="nav-link navs" aria-current="page" href="Complaints.php">Complaints</a>
        </li>
        </li>
          <a class="nav-link navs" aria-current="page" href="RoomService.php">Room Service</a>
        </li>
        </li>
          <a class="nav-link navs" aria-current="page" href="Notice.php">Notice Board</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navs" href="HostelManagement.html">Logout</a>
        </li>
      </ul>
   </div><hr><hr>

   <div class="p-3 mb-6 bg-dark text-white h3">Hostel Inmates Details:</div>
<br>

  <div class="container">
    <div class="table">
        <table class="table table-striped table-primary">
        <thead>
            <tr>
            <th scope="col">Room No</th>
            <th scope="col">Name</th>
            <th scope="col">USN</th>
            <th scope="col">Branch</th>
            <th scope="col">Mob</th>
            <th scope="col">Year</th>
            <th scope="col">Address</th>
            <th scope="col">Fee</th>

            </tr>
        </thead>
            <?php
                $details = "SELECT * FROM student_details WHERE R_No!=0 ORDER BY student_details.R_No";
                $details1 = mysqli_query($con,$details);
                while($Room = mysqli_fetch_assoc($details1))
                {
                    echo '<tr>
                    <td>'.$Room['R_No'].'</td>
                    <td>'.$Room['St_Name'].'</td>
                    <td>'.$Room['St_USN'].'</td>
                    <td>'.$Room['St_Branch'].'</td>
                    <td>'.$Room['St_PhNo'].'</td>
                    <td>'.$Room['St_Year'].'</td>
                    <td>'.$Room['St_Addr'].'</td>
                    <td>'.$Room['Fee'].'</td>
                    </tr>';

                    
            }
            ?>
        </table>
    </div>
</div><br>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>



</body>
</html>