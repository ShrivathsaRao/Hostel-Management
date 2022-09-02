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

    $comp = $_POST["complaint"];
    $insert = "INSERT INTO `complaints` (`Room_No`, `Complaint`) VALUES ('$Room','$comp')";
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
            margin-right: 38%;
            margin-left: 38%;
        }
        .table{
            margin-left: 10px;
            margin-right: 10px;
        }
        .err{
          margin-right: 32%;
          margin-left: 32%;
          text-align: center;
       }
        .h3{
            margin-left: 108px;
            margin-right: 1040px;
            box-shadow: 8px 8px 8px black;
        }
        .img-area{
          background-image: url("Images/comp.jpg");
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
          background-color: rgba(0,0,0,.3);
        background-blend-mode: multiply;
       }
        .add{
            margin-left: 125px;
            margin-right: 60%;
        }
        .butt a:hover{
            color: white;
        }
        .butt{
            align-items: center;
            margin-left: 45%;
        }
        .home{
            text-decoration: none;
            color: white;
        }
        .reset{
            margin-left: 95%;
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
    </style>

    <title>Complaints</title>
</head>
<body>

    <div class="img-area"></div>

    <h1 div class="p-3 mb-2 bg-dark text-white header">Complaints</div></h1>

    <div class="p-3 mb-6 bg-dark text-white h3">Complaints History:</div>
    <br>
    


<div class="container">
    <div class="table">
        <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Room No</th>
            <th scope="col">Complaints</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
            <?php
                $query1 = "SELECT * FROM complaints where Room_No = '$Room'";
                $result2 = mysqli_query($con, $query1);
                while($rows2 = mysqli_fetch_assoc($result2))
                {
                    echo '<tr>
                    <td>'.$rows2['Room_No'].'</td>
                    <td>'.$rows2['Complaint'].'</td>
                    <td>'.$rows2['Status'].'</td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</div><br>

<?php 
    if($alert){
        echo '<h1><div class="alert alert-success d-flex align-items-center err">Complaint Booked</div></h1>';
    }
?><br>

<div class="p-3 mb-6 bg-success text-white h3">Register Complaint:</div>

<div class="add">
    <form action="/HostelManagement/AddComplaints.php" method = "post">
        <div class="form-group names">
            <label for="formGroupExampleInput2">Complaint</label>
            <input type="text" class="form-control in" id="complaint" name="complaint" placeholder="(To request change of room enter your USN and Room No)" Required><br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button><br>
    </form>
</div>



<button type="submit" class="btn btn-outline-success mb-4 butt" ><a href="welcome.php" class="home">Home</a></button>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    </body>
</html>