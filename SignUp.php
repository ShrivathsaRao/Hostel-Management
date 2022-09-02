<?php
  $showError=false;
  $showAlert= false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnect.php';
        $Name = $_POST["name"];
        $USN = $_POST["USN"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $Branch = $_POST["branch"];
        $Phno = $_POST["phno"];
        $Year = $_POST['year'];
        $Fee = $_POST["fee"];
        $Addr = $_POST["addr"];
        $Gender = $_POST['gender'];

        $existSql = "Select * from `logindetails` where Email = '$username'";
        $result = mysqli_query($con,$existSql);
        $numExistRows = mysqli_num_rows($result);

        if($numExistRows > 0){
          $showError = "Username already exists";
        }
        else{
          if(($password == $cpassword)){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `logindetails` (`Email`, `Password`,`Name`,`USN`) VALUES ('$username','$hash','$Name','$USN');";
            $query = "INSERT INTO `student_details` (`St_Name`, `St_USN`,`St_Branch`,`Gender`,`St_Year`,`St_PhNo`,`St_Addr`,`Fee`) VALUES ('$Name','$USN','$Branch','$Gender','$Year','$Phno','$Addr','$Fee');";
            $result = mysqli_query($con,$sql);
            $result1 = mysqli_query($con,$query);
            if($result && $result1){
              $showAlert = true; 
            }
          }
          else{
            $showError = "Invalid password";
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

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Sign Up</title>
  </head>
  <body>

<style>
        .header{
            margin-right: 40%;
            margin-left: 40%;
            padding: 0px;
            box-shadow: 10px 10px 10px black;
            background-color: transparent;
            color: white;
            border: 5px solid black;
            border-radius: 8px;
            border-radius: 8px;
        }
        .h2{
          text-align: center;
          margin-top: 2%;
          margin-left: 40%;
          margin-right: 40%;
          box-shadow: 8px 8px 8px black;
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
          background-color: rgba(0,0,0,.6);
          background-blend-mode: multiply;
       }
        .login-card{
           box-shadow: 0px 0px 10px 5px black;
           background-color: transparent;
           color: white ;
           border: 2px solid black;
           border-radius: 8px;
           border-radius: 8px;
       }
       .in{
           border: 1px solid black;
           outline: none;
           border-radius: 5px;
           box-shadow: 3px 3px 2px 1px black;
        }
       .err{
          margin-right: 32%;
          margin-left: 32%;
          text-align: center;
       }
       
       .login:hover{
         color: red;
       }
</style>
    
<div class="img-area"></div>

<div class="header">Sign Up</div><br>

<?php
   if($showAlert){
     echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
     <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
     <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
   </symbol>
   <div class="alert alert-success d-flex align-items-center err" role="alert">
     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
     <div >
       Registered Successfully!!
     </div>
   </div></svg>';
   }
   if($showError){
     echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
     <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
     <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
   </symbol>
   <div class="alert alert-success d-flex align-items-center err" role="alert">
     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
     <div >
     Error!! '. $showError.';       
     </div>
   </div></svg>';
   }
?>

<hr>
    
<form action="/HostelManagement/SignUp.php" method="post">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 login-card">
        <form>
          <h4 style="color: white;">Register Details:</h4>
          <div class="mb-3" >
            <label for="name" class="form-label"  >Name*</label>
            <input type="text" class="form-control in" id="name" name="name" Required>
          </div>
          <div class="mb-3" >
            <label for="USN" class="form-label" >USN*</label>
            <input type="text"  pattern="(4NI)[0-9][0-9][A-Z][A-Z][0-9]{3}" class="form-control in" id="USN" name="USN" value="4NI" Required>
          </div>
          <div class="mb-3" >
            <label for="username" class="form-label" >Email address*</label>
            <input type="email" class="form-control in" id="username" name="username" aria-describedby="emailHelp" Required placeholder="abc@xyz">
            <div id="emailHelp"  class="form-text" style="color: white">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label" >Password*</label>
            <input type="password" class="form-control in" id="password" name="password" Required>
          </div>
          <div class="mb-3">
            <label for="cpassword" class="form-label" >Confirm Password*</label>
            <input type="password" class="form-control in" id="cpassword" name="cpassword" Required>
          </div>
          <div class="mb-3" >
            <label for="branch" class="form-label" >Branch*</label>
            <select name=branch class="form-select" aria-label="Default select example">
              <option selected>[Select]</option>
              <option value="CSE">CSE</option>
              <option value="ISE">ISE</option>
              <option value="CV">CV</option>
              <option value="IP">IP</option>
              <option value="EEE">EEE</option>
              <option value="ECE">ECE</option>
              <option value="ME">ME</option>
            </select>
          </div>
          <div class="mb-3" >
            <label for="gender" class="form-label" >Gender*</label>
            <select name=gender class="form-select" aria-label="Default select example">
              <option selected>[Select]</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="mb-3" >
            <label for="year" class="form-label" >Year*</label>
            <select name=year class="form-select" aria-label="Default select example">
              <option selected>[Select]</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="mb-3" >
            <label for="name" class="form-label" >PhNo*</label>
            <input type="tel" pattern="[0-9]{10}" class="form-control in" id="phno" name="phno" Required>
          </div>
          <div class="mb-3" >
            <label for="name" class="form-label" >Fee*</label>
            <input type="text" class="form-control in" id="fee" name="fee" Required>
          </div>
          <div class="mb-3" >
            <label for="name" class="form-label" >Address*</label>
            <input type="text" class="form-control in" id="addr" name="addr" Required>
          </div>
          <p>Already have an account ? <a href="Student_login.php" class="login">Login</a></p>
          <button type="submit" class="btn btn-primary">Sign Up</button><br><hr>
      </form>
      </div>
    </div>
  </div>
</form>

<br>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>