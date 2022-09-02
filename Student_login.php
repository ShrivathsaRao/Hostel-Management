<?php
  $alert = false;
  $showError=false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    
    $sql = "SELECT * from logindetails where Email='$username'";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
      if($num == 1){
        while($row=mysqli_fetch_assoc($result)){
          if(password_verify($password, $row['Password'])){
            $login = true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
            header("location: welcome.php");
          }
          else{
            $alert = true;
          }
        }
      }
      else{
        $showError=true;
      }
  }
?>


<!doctype html>
<html lang="en">
  <head>
    
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;600&display=swap" rel="stylesheet">

    <meta charset="utf-8">
    <link rel="stylesheet" href="css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Student Login</title>
  </head>
  <body>
    <style>

      .head{
            margin-right: 38%;
            margin-left: 38%;
            text-align: center;
            box-shadow: 10px 10px 10px black;
            background-color: transparent;
            color: black;
            border: 5px solid black;
            border-radius: 8px;
            border-radius: 8px;
        }
      .img-area{
        background-image: url("Images/1.jpg");
        -webkit-background-size: cover;
        background-size: cover;
        background-position: center center;
        height: 100vh;
        position: fixed;
        left: 0;
        right: 0;
        z-index: -1;
        filter: blur(8px);
        -webkit-filter: blur(4px);
        background-color: rgba(0,0,0,.3);
        background-blend-mode: multiply;
      }
      .in{
           border: 1px solid black;
           outline: none;
           border-radius: 5px;
           box-shadow: 3px 3px 2px 1px black;
        }
      .login-card{
        box-shadow: 0px 0px 10px 5px black;
        background-color: transparent;
        color: white;
        font-size: 20px;
        border: 2px solid black;
        border-radius: 8px;
        border-radius: 8px;
      }
      .err{
        margin-right: 37%;
        margin-left: 37%;
        text-align: center;
      }
      .in{
          border: 1px solid black;
          outline: none;
          border-radius: 5px;
          box-shadow: 3px 3px 2px 1px black;
      }
      .link{
        color: black:
      }
      .butt:hover{
        color: red;
      }
    </style>

<div class="img-area"></div>

<h1 class = "head" >Student Login</h1><br>

    <?php
      if($showError || $alert){
          echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <div class="alert alert-danger d-flex align-items-center err" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div >
           Error!! Invalid Username/Password
          </div>
        </div></svg>';
        }
    ?>
    
    <form action="/HostelManagement/Student_login.php" method="post">
      <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
          <div class="col-lg-4 login-card">
            <form>
              <h4>Login Details:</h4>
              <div class="mb-3" >
                <label for="username" class="form-label">Email address*</label>
                <input type="email" class="form-control in" id="username" name="username" aria-describedby="emailHelp" Required>
                <div id="emailHelp"  class="form-text" style="color: white">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label" >Password</label>
                <input type="password" class="form-control in" id="password" name="password" Required>
              </div>
                  <p>Don't have an account ? <a  href="SignUp.php" class="butt">Signup</a></p>
                  <p>Login as  <a href="Admin.php" class="butt">Admin</a></p>  
              <button type="submit" class="btn btn-primary">Login</button><br><hr>
          </form>
          </div>
        </div>
      </div>
    </form>

    <br>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

   
  </body>
</html>