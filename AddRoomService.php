<?php
session_start();
include 'dbconnect.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: Student_login.php");
    exit;
}
else{
        include 'dbconnect.php';
        $alert = false;
        $username = $_SESSION['username'];
        $sql = "Select * from logindetails where Email='$username'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);
        $USN = $rows['USN'];
        $query = "Select * from student_details where St_USN = '$USN'";
        $result1 = mysqli_query($con,$query);
        $rows1 = mysqli_fetch_assoc($result1);
        $Room = $rows1['R_No'];

        if($_SERVER["REQUEST_METHOD"] == "POST"){

        $comp = $_POST["time"];
        $insert = "INSERT INTO `room_service` (`Room_No`, `Time`) VALUES ('$Room','$comp')";
        $insert1 = mysqli_query($con, $insert);
        if($insert1){
            $alert = true;
        }
        }
    }
if($Room==0){
    header("location: welcome.php");
    exit;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <style>
        .header{
            margin-right: 35%;
            margin-left: 35%;
        }
        .table{
            margin-left: 10px;
            margin-right: 10px;
        }
        .err{
          margin-right: 38%;
          margin-left: 32%;
          text-align: center;
        }
        .img-area{
          background-image: url("Images/entrance.jpg");
          -webkit-background-size: cover;
          background-size: cover;
          background-position: center center;
          height: 100vh;
          position: fixed;
          left: 0;
          right: 0;
          z-index: -1;
          filter: blur(5px);
          -webkit-filter: blur(5px);
       }
        .h3{
            margin-left: 108px;
            margin-right: 1040px;
            box-shadow: 8px 8px 8px black;
        }
        .butt a:hover{
            color: white;
        }
        .butt{
            align-items: center;
            margin-left: 45%;
        }
        .add{
            margin-left: 125px;
            margin-right: 60%;
        }
        .names{
            color: red;
            font-weight: bold;
        }
        .in{
           border: 1px solid black;
           outline: none;
           border-radius: 5px;
           box-shadow: 3px 3px 2px 1px black;
        }
        .home{
            text-decoration: none;
            color: white;
        }
    </style>

    <title>Room Service</title>
</head>
<body>

    <div class="img-area"></div>
    
    <h1><div class="p-3 mb-2 bg-dark text-white header">Room Service</div></h1>
    <br>

<div class="p-3 mb-6 bg-success text-white h3">Room Service:</div>

<div class="add">
    <form action="/HostelManagement/AddRoomService.php" method = "post">
        <div class="form-group names">
            <label for="formGroupExampleInput2">Time Slot</label>
            <input type="time" class="form-control in" id="time" name="time" placeholder="Enter your time slot" Required><br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button><br>
    </form>
</div>

<button type="submit" class="btn btn-outline-success mb-4 butt" ><a href="welcome.php" class="home">Home</a></button><br>
<br>

<?php 
    if($alert){
        echo '<h1><div class="alert alert-success d-flex align-items-center err">Room Service Booked</div></h1>';
    }
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    </body>
</html>