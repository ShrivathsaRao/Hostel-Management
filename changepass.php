<?php
	$updates=false;
    $notcon=false;
    $oldwrng=false;
	session_start();
	include 'dbconnect.php';
	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
		header("location: welcome.php");
		exit;
	}
	else{
	  $username = $_SESSION['username'];
	  $sql = "Select * from logindetails where Email='$username'";
	  $result = mysqli_query($con,$sql);
	  $rows = mysqli_fetch_assoc($result);
	  $USN = $rows['USN'];

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$oldPass = $_POST["oldpassword"];
    	    $NewPass = $_POST["cpassword"];
    	    $CNewpass = $_POST["cnpassword"];
            
            if(password_verify($oldPass, $rows['Password'])){
                if(($NewPass == $CNewpass)){
                    $hash=password_hash($NewPass,PASSWORD_DEFAULT);
                    $update2 = "UPDATE logindetails SET `Password`='$hash' WHERE USN='$USN'";
			        $update2C=mysqli_query($con, $update2);
                    if($update2){
                        $updates=true;
                    }
                }
                else{
                    $notcon=true;
                }
            }
            else{
                $oldwrng=true;
            }

		}
	}

?>




<!doctype html>
<html lang="en">
  <head>
    
    <!--  meta tags -->
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
            margin-right: 35%;
            margin-left: 35%;
            padding: 0px;
            box-shadow: 10px 10px 10px black;
            background-color: transparent;
            color: white;
            border: 5px solid black;
            border-radius: 8px;
            border-radius: 8px;
        }
        .navs{
           color: white;
           text-decoration: none;
        }
        .navs:hover{
           color: red;
        }
        .h2{
          text-align: center;
          margin-top: 2%;
          margin-left: 40%;
          margin-right: 40%;
          box-shadow: 8px 8px 8px black;
        }
        .img-area{
          background-image: url("Images/info.jpg");
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

<h1><div class="p-3 mb-2 bg-gradient text-white header">Change Password</div></h1><br>

<div class="nav nav-pills nav-bar">
      <ul class="bg-dark text-white nav nav-tabs">
      <li class="nav-item">
          <a class="nav-link navs" aria-current="page" href="welcome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navs" href="HostelManagement.html">Logout</a>
        </li>
      </ul>
</div>


<hr>
<?php
      if($updates){
          echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <div class="alert alert-success d-flex align-items-center err" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div >
           Password Changed successfully!
          </div>
        </div></svg>';
        }
        if($oldwrng){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-danger d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Entered wrong old password!!
            </div>
          </div></svg>';
          }
          if($notcon){
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
          </symbol>
          <div class="alert alert-danger d-flex align-items-center err" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div >
             Password does not match!
            </div>
          </div></svg>';
          }
    ?>
    <br>
    <?php echo'
		<form action="/HostelManagement/changepass.php" method="post">
		  <div class="container">
		    <div class="row justify-content-center">
		      <div class="col-lg-4 login-card">
		        <form>
                <div class="mb-3">
                <label for="password" class="form-label" >Old Password</label>
                <input type="password" class="form-control in" id="password" name="oldpassword" Required>
              </div>
              <div class="mb-3">
                <label for="cpassword" class="form-label" >New Password</label>
                <input type="password" class="form-control in" id="cpassword" name="cpassword" Required>
              </div>
              <div class="mb-3">
                <label for="cpassword" class="form-label" >Confirm New Password</label>
                <input type="password" class="form-control in" id="cpassword" name="cnpassword" Required>
              </div>
		          <button type="submit" class="btn btn-primary">Change</button><br><hr>
		      </form>
		      </div>
		    </div>
		  </div>
		</form>';
	?>

<br>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>
	 