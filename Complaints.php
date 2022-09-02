<?php
$Error=false;
    session_start();
    include 'dbconnect.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: Admin.php");
    exit;
}
else{
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Room = $_POST['room'];
        $status = $_POST['status'];
        $query = "UPDATE `complaints` SET `Status` = '$status' WHERE `Room_No` = '$Room'";
        $result = mysqli_query($con, $query);

        $query1 = "SELECT * FROM complaints where Status != 'Resolved'";
        $result2 = mysqli_query($con, $query1);
        while($rows2 = mysqli_fetch_assoc($result2)){
            if($Room!=$rows2['Room_No']){
                $Error=true;
            }
        }
    }
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
        .in{
           border: 1px solid black;
           outline: none;
           border-radius: 5px;
           box-shadow: 3px 3px 2px 1px black;
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
          filter: blur(8px);
          -webkit-filter: blur(8px);
          background-color: rgba(0,0,0,.3);
        background-blend-mode: multiply;
       }
        .table{
            margin-left: 10px;
            margin-right: 10px;
        }
        .h3{
            margin-left: 115px;
            margin-right: 1040px;
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
        .err{
        margin-right: 35%;
        margin-left: 35%;
        text-align: center;
      }
        .home{
            text-decoration: none;
            color: white;
        }
        .add{
            color: red;
            font-weight: bold;
        }
    </style>
    
    <title>Complaints</title>
</head>
<body>
    <div class="img-area"></div>
    <h1><div class="p-3 mb-2 bg-dark text-white header">Complaints</div></h1><br>

    <?php
        if($Error){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-danger d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Error!! Resolve a listed complaint.
            </div>
          </div></svg>';
          }
    ?>
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
                $query1 = "SELECT * FROM complaints where Status != 'Resolved'";
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

<div class="p-3 mb-6 bg-success text-white h3">Resolve:</div>

<div class="add">
    <form action="/HostelManagement/Complaints.php" method = "post">
        <div class="form-group">
            <label for="formGroupExampleInput">Room No</label>
            <input type="text" class="form-control in" id="room" name="room" placeholder="Enter the Room No"><br>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Status</label>
            <input type="text" class="form-control in" id="status" name="status" placeholder="Enter Resolved if done"><br>
        </div>
        <button type="submit" class="btn btn-success">Submit</button><br>
    </form>
</div>

<button type="submit" class="btn btn-outline-success mb-4 butt" ><a href="welcomeadmin.php" class="home">Home</a></button>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    </body>
</html>