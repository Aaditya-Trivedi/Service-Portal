<?php
       include('../DBConnection.php');
       session_start();
       if(!isset($_SESSION['is_login']))
       {
            if(isset($_REQUEST['rLogin']))
            {
                 //session start time
                 $_SESSION['start'] = time();
                 //session end time (5min)
                 $_SESSION['expire'] = $_SESSION['start'] + (5*60);
                $rEmail = mysqli_real_escape_string($conn,trim($_REQUEST['rEmail']));
                $rPassword = mysqli_real_escape_string($conn,trim($_REQUEST['rPassword']));
                //Cheking All Data Entered or Not
                if(($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == ""))
                {
                    $LgMsg = '<div class="alert alert-danger" role="alert">All Fields are Required</div>';
                }
                else
                {
                    //Query for user Login
                    $sql = "SELECT r_email,r_password FROM ragistration_tb WHERE r_email = '".$rEmail."' AND r_password = '".$rPassword."' limit 1";
                    $result_user = $conn->query($sql);

                    //Query for Admin Login
                    $sql = "SELECT a_email,a_password FROM admin_tb WHERE a_email = '".$rEmail."' AND a_password = '".$rPassword."' limit 1"; 
                    $result_admin = $conn->query($sql);

                    ////Query for Employee Login
                    $sql = "SELECT technician_email,technician_password FROM technician_tb WHERE technician_email = '".$rEmail."' AND technician_password = '".$rPassword."' limit 1"; 
                    $result_emp = $conn->query($sql);

                    if($result_user->num_rows == 1)
                    {
                        $_SESSION['is_login'] = true;
                        $_SESSION['rEmail'] = $rEmail;
                       

                        echo "<script>location.href='ServiceStatus.php';</script>";
                    }
                    else if($result_admin->num_rows == 1)
                    {
                        //$LgMsg = '<div class="alert alert-danger" role="alert">Sorry, we can not find an account with this email address. Please try again or <a href="../index.php#Registration" class="btn btn-danger mt-1 font-weight-bold">create a new account.</a></div>';
 
                            $_SESSION['rEmail'] = $rEmail;
                            echo "<script>location.href='../Admin/Dashboard.php';</script>";              
                    }
                    else if($result_emp->num_rows == 1)
                    {

                        
                        $_SESSION['rEmail'] = $rEmail;
                       

                        echo "<script>location.href='../Employee/WorkOrder.php';</script>";
                    }
                    else
                    {
                        $LgMsg = '<div class="alert alert-danger" role="alert">Your email address Or Password is wrong Please try again or <a href="../index.php#Registration" class="btn btn-danger mt-1 font-weight-bold">create a new account.</a></div>';
                    }
               }
            }
        }
    else
    {
        echo "<script>location.href='UserProfile.php';</script>";
    }
        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">

    <title>Login</title>
</head>
<body>
        <!--Navbr-->
        <?php include('loginNavbar.php')?>
    
    <!--BG Image-->
    <div class="back-image " style="background-image:url(../img/hand.jpeg); ">
    <!--text part-->
        <div class=" text-center" >
            <h1 class="text-uppercase text-warning bg-secondary font-weight-bold"  >
            Customer's Satisfaction is our Aim!!
            </h1>
            
            <!--Login Form-->
            <div class="container bg-light.bg-gradient">
                <div class="row justify-content-center mt-5  ">
                    <div class="col-sm-6 col-md-4 bg-light mt-5 rounded bg-opacity-50" >
                        <form action="" method="post" class="my-3 mx-1"><!--shadow-lg p-3 mb-5 bg-body-secondary rounded-->
                            <div>
                                <span class="subimg text-dark "><b>LOGIN</b></span>
                            </div>
                            <div class="form-group mt-3">
                                <i class="fa-regular fa-envelope me-2"></i>
                                <label for="email" class="font-weight-bold pl-2 ">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="rEmail" required >
                            </div>

                            <div class="form-group">
                                <i class="fa-solid fa-eye me-2"></i> 
                                <label for="pass" class="font-weight-bold pl-2">Password</label>
                                
                                <input type="password" id="password" class="form-control" placeholder="Password" name="rPassword" required >
                                <div class="row">
                                    <div class="showpassword_box col"><input type="checkbox" name="" id="checkbox" class="mx-2 my-2">Show Password</div>
                               </div>
                                <small class="form-text text-dark" >We'll never share your data with anyone else</small>
                            </div>
                            <?php if(isset($LgMsg)){echo $LgMsg;}?>
                            <button type="submit" class="btn btn-danger mt-1 font-weight-bold" name="rLogin">Login</button>
                            <a href="../index.php" class="btn btn-info mt-1 font-weight-bold">Back to Home</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
        <br>
        <br>


 <!--JS-->
    <script>
        let password = document.getElementById("password");
        let checkbox = document.getElementById("checkbox");

        checkbox.onclick = function()
        {
            if(checkbox.checked)
            {
                password.type = 'text';
            }
            else
            {
                password.type = 'password';
            }
        }
    </script>
    <script src="../js/Jquery.min.js"></script>
    <script src="../js/Popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>
</html>