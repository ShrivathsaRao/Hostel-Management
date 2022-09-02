<?php
$alert = false;
    session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: Admin.php");
    exit;
}
else{
    include 'dbconnect.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Hostel = $_POST["Hostel"];
        $Mess = $_POST["Mess"];
        $Events = $_POST["Events"];
        $query = "UPDATE `hostelnotice` SET `Hostel` = '$Hostel' WHERE Sl_No = 1";
        $query1 = "UPDATE `hostelnotice` SET `Mess` = '$Mess' WHERE Sl_No = 1";
        $query2 = "UPDATE `hostelnotice` SET `Events` = '$Events' WHERE Sl_No = 1";
        $result = mysqli_query($con, $query);
        $result1 = mysqli_query($con, $query1);
        $result2 = mysqli_query($con, $query2);
        if($query ){
            $alert = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;600&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice</title>
    <style>
        .header{
            margin-right: 35%;
            margin-left: 35%;
        }
        .con{
          margin-left: 20%;
          font-size: 30px;
        }
        .img-area{
          background-image: url("Images/notice.jpg");
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
          background-color: rgba(0,0,0,.3);
        background-blend-mode: multiply;
       }
       .in{
           border: 1px solid black;
           outline: none;
           border-radius: 5px;
           box-shadow: 3px 3px 2px 1px black;
        }
        .home a:hover{
            color: white;
        }
        .home{
            color: white;
            align-items: center;
            margin-left: 45%;
            text-decoration: none;
        }
        .err{
            margin-right: 32%;
            margin-left: 32%;
            text-align: center;
      }
    </style>
    
</head>
<body>
<div class="img-area"></div>
<div class="p-3 mb-6 bg-dark text-white header">Notice Board</div>

<br><br>
<hr>

<?php 
    if($alert){
        echo '<h1><div class="alert alert-success d-flex align-items-center err">Notice Board Updated successfully</div></h1>';
    }
?><hr><br>

<div class="con col-lg-6">
    <form action="/HostelManagement/Notice.php" method="post">
        <div class="form-group">
            <label for="exampleFormControl Input1">Enter Hostel Notice:</label>
            <input type="text" class="form-control in" id="Hostel" name="Hostel" placeholder="Hostel Notice">
        </div><hr>
        <div class="form-group">
            <label for="exampleFormControl Input1">Enter Mess Details:</label>
            <input type="text" class="form-control in" id="Mess" name="Mess" placeholder="Mess Details">
        </div><hr>
        <div class="form-group">
            <label for="exampleFormControl Input1">Enter Events Details:</label>
            <input type="text" class="form-control in" id="Events" name="Events" placeholder="Events Details">
        </div><hr>    
        <button type="submit" class="btn btn-success">Submit</button><br>
    </form>
</div>

    <hr><button type="submit" class="btn btn-outline-success mb-4 home" ><a href="welcomeadmin.php">Home</a></button>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>