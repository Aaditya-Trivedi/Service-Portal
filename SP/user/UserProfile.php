<?php 
    include('../DBConnection.php');
    session_start(); 
    if($_SESSION['is_login'])
    {
        $now = time();
        if($now >= $_SESSION['expire'])
        {
            session_destroy();
            echo "<script> location.href = 'UserLogin.php'</script>";
        }
        else
        {
            $rEmail = $_SESSION['rEmail'];
            $sql = "SELECT r_name FROM ragistration_tb WHERE r_email = '$rEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();
                $rName = $row['r_name'];    
                }
            // for Update
    
            if (isset($_REQUEST['nameupdate'])) 
            {
                if($_REQUEST['rName'] == "")
                {
                    $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Enter Your Name</a></div>';
                }
                else
                {
                    //$rEmail = $_SESSION['rEmail'];
                    $rName = $_REQUEST['rName'];
                    $sql = "UPDATE ragistration_tb SET r_name = '$rName' WHERE r_email = '$rEmail'";
                    if ($conn->query($sql) == TRUE) 
                    {
                        $UpdateMsg = '<div class="alert alert-success mt-3" role="alert">Updated Successfully.</a></div>';
                    }
                    else 
                    {
                        $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Updated</a></div>';
                    }
    
                }
            }
        }
        
    }
    else
    {
    echo "<script> location.href = 'UserLogin.php'</script>";
    } 
   // $rEmail = $_SESSION['rEmail']; 
    
    
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

    <title>Profile</title>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <?php include('ProfNav.php')?>
        <a href="UserProfile.php" class="navbar-brand col-sm-3 col-md-2 mr-0 " >
        
        </a>
    </nav>


    <div class="container-fluid " style="margin-top: 40px; ">
        <div class="row">
            <!--Side Bar -->
            <nav class="col-sm-2 sidebar py-5 bg-outline-dark shadow">
                <div class="sidebar-sticky">
                    <ul class="nav-flex-column nav-underline"><!--nav-pills -->
                        <li class="nav-item list-group-item mt-5">
                            <a href="UserProfile.php" class="nav-link active"><!--bg-dark-->
                            <i class="fas fa-user pl-2 me-2" ></i>Profile
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="SubmitRequest.php" class="nav-link">
                           <!-- <i class="fab fa-accessible-icon "></i>-->
                           <i class="fa-regular fa-clipboard me-2"></i>Submit Request
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="ServiceStatus.php" class="nav-link">
                            <!--<i class="fas fa-user "></i>-->
                            <i class="fa-solid fa-list-check me-2"></i>Service Status
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="ChangePassword.php" class="nav-link">
                            <!--<i class="fas fa-user "></i>-->
                            <i class="fa-solid fa-eye me-2"></i>Change Password
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="Logout.php" class="nav-link">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--Profile Area -->
            <div class="col-sm-6 mt-5">
                <form action="" method="post" class="mx-5">
                    <div class="form-group">
                        <i class="fa-regular fa-envelope"></i>
                        <label for="rEmail">Email</label>
                        <input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php echo $rEmail;?>" readonly>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-user "></i>
                        <label for="rName">Name</label>
                        <input type="text" class="form-control" name="rName" id="rName" value="<?php echo $rName; ?>">
                    </div>
                    <?php if(isset($UpdateMsg)){echo $UpdateMsg;}?>
                    
                    <button type="submit" class="btn btn-outline-dark mt-3" name="nameupdate">Update</button>
                    <button type="reset" class="btn btn-outline-danger mt-3 font-weight-secondary">Reset</button>

                </form>
            </div>
        </div>
    </div>
    <!--JS-->
    <script src="../js/Jquery.min.js"></script>
    <script src="../js/Popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script> 
</body>
</html>