<?php
    session_start();
    $showAlert=false;
    $showError=false;
    $wrongUSN=false;
    $updated=false;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: Admin.php");
    exit;
}
else{
    include 'dbconnect.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $USN = $_POST["usn"];
        $Room = $_POST["room"];

        $usnCheck = "SELECT * FROM student_details WHERE St_USN='$USN'";
        $usnCheck1 = mysqli_query($con, $usnCheck);
        $num = mysqli_fetch_row($usnCheck1);

        if($num!=NULL){
            if($Room>100 && $Room<111){
                $check = "SELECT Vacancy from hostel_details WHERE R_No = '$Room'";
                $check1 = mysqli_query($con, $check);
                $check2=mysqli_fetch_assoc($check1);
                if($check2['Vacancy']>0){
                    $usnCheck = "SELECT * FROM student_details WHERE St_USN='$USN'";
                    $usnCheck1 = mysqli_query($con, $usnCheck);
                    $usnCheck3 = mysqli_fetch_assoc($usnCheck1);
                    $prevRoom = $usnCheck3['R_No'];
                    $update1 = "UPDATE `student_details` SET `R_No` = '$Room' WHERE `St_USN` = '$USN'";
                    $result2 = mysqli_query($con, $update1);
                    $preUSN = "UPDATE hostel_details SET Vacancy = Vacancy+1 where R_No = '$prevRoom'";
                    $inc = mysqli_query($con, $preUSN);     
                    $dec = "UPDATE hostel_details SET Vacancy = Vacancy-1 WHERE R_No = '$Room'";
                    $dec1 = mysqli_query($con, $dec);
                    if($inc && $dec){$updated=true;}
                }
                else{
                    $showAlert = true;
                }
            }
            else{
                $showError=true;
            }
        }
        else{
            $wrongUSN=true;
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
        .table{
            margin-left: 10px;
            margin-right: 10px;
        }
        .h3{
            margin-left: 2%;
            margin-right: 70%;
        }
        .add{
            margin-left: 125px;
            margin-right: 60%;
            color: red;
            font-weight: bold;
        }
        .img-area{
            background-image: url("Images/student");
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
        .err{
            margin-right: 32%;
            margin-left: 32%;
            text-align: center;
      }
      .in{
           border: 1px solid black;
           outline: none;
           border-radius: 5px;
           box-shadow: 3px 3px 2px 1px black;
        }
    </style>

    <title>Update Room</title>
</head>
<body>
<div class="img-area"></div>

<h1><div class="p-3 mb-2 bg-dark text-white header">Update Room</div></h1>   <br> 
<?php
        if($wrongUSN){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-danger d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Error!! Entered student does not exist or been removed.
            </div>
          </div></svg>';
          }
          if($showAlert){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-danger d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Error!! Room is already filled.
            </div>
          </div></svg>';
          }
          if($showError){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-danger d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Error!! Invalid Room No.
            </div>
          </div></svg>';
          }
          if($updated){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-success d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Room No updated successfully!
            </div>
          </div></svg>';
          }
?>

<div class="p-3 mb-6 bg-dark text-white h3">Details of Hostel Inmates:</div>


<div class="row">
    <div class="con col-lg-9 mt-5">
        <div class="table">
            <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">Room No</th>
                <th scope="col">Name</th>
                <th scope="col">USN</th>
                <th scope="col">Branch</th>
                </tr>
            </thead>
                <?php
                    $getStudent = "SELECT * FROM `student_details` WHERE R_No!=0 ORDER BY R_No;";
                    $result = mysqli_query($con,$getStudent);
                    while($Room = mysqli_fetch_assoc($result))
                    {
                        echo '<tr>
                        <td>'.$Room['R_No'].'</td>
                        <td>'.$Room['St_Name'].'</td>
                        <td>'.$Room['St_USN'].'</td>
                        <td>'.$Room['St_Branch'].'</td>
                        </tr>';
                }
                ?>
            </table>
        </div>
    </div><br>
    <div class="con col-lg-3 mt-5">
        <div class="table">
            <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">Room No</th>
                <th scope="col">Vacancy</th>
                </tr>
            </thead>
                <?php
                    $vacancy = "SELECT R_No,Vacancy FROM `hostel_details` ORDER BY R_No;";
                    $vac = mysqli_query($con, $vacancy);
                    while($Vaca = mysqli_fetch_assoc($vac))
                    {
                        echo '<tr>
                        <td>'.$Vaca['R_No'].'</td>
                        <td>'.$Vaca['Vacancy'].'</td>
                        </tr>';
                }
                ?>
            </table>
        </div>
    </div><br>
</div>

<div class="p-3 mb-6 bg-success text-white h3">Update Room</div>

<div class="add">
    <form action="/HostelManagement/Update.php" method = "post">
        <div class="form-group">
            <label for="formGroupExampleInput">USN:</label>
            <input type="text" class="form-control in" id="usn" name="usn" placeholder="Enter the USN of the student" Required><br>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">New Room No:</label>
            <input type="text" class="form-control in" id="room" name="room" placeholder="Enter the Room No." Required><br>
        </div>
        <button type="submit" class="btn btn-primary">Update</button><br>
    </form>
</div>

<button type="submit" class="btn btn-outline-success mb-4 butt" ><a href="welcomeadmin.php" class="home">Home</a></button>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    </body>
</html>