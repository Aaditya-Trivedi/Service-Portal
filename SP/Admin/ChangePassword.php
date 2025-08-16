<?php
include('../DBConnection.php');
session_start(); 
$now = time();

$rEmail = $_SESSION['rEmail'];

if($now >= $_SESSION['expire'])
{
    session_destroy();
    echo "<script> location.href = '../user/UserLogin.php'</script>";
}
else
{
    define('TITLE', 'Change Password');
    define('PAGE', 'ChangePassword');
    $sql = "SELECT a_password FROM admin_tb WHERE a_email = '$rEmail'";
    $result = $conn->query($sql);
            if ($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();
                $rpassword = $row['a_password'];    
            }
            // for Update
        
            if (isset($_REQUEST['changepassword'])) 
            {
                if($_REQUEST['rOldPassword'] == "" || $_REQUEST['rNewpassword'] == "")
                {
                    $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Enter Your Password</a></div>';
                }
                else
                {   
                    if($_REQUEST['rOldPassword'] == $rpassword)
                    {   
                        //$rEmail = $_SESSION['rEmail'];
                        $rNewPassword = $_REQUEST['rNewpassword'];
                        $sql = "UPDATE admin_tb SET a_password = '$rNewPassword' WHERE a_email = '$rEmail'";
                        if ($conn->query($sql) == TRUE) 
                        {
                            $UpdateMsg = '<div class="alert alert-success mt-3" role="alert">Password Changed Successfully.</a></div>';
                        }
                        else 
                        {
                            $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Updated</a></div>';
                        }
                    }
                    else
                    {
                        $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Old Password is Worng</a></div>';
                    }
                }
            }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/all.min.css">

        <link rel="stylesheet" href="../css/style.css">
    <title><?php echo TITLE ?></title>
</head>
<body>
    <?php include('includes/header.php')?>
    <div class="container-fluid " style="margin-top: 5px; ">
        <div class="row">
            <!--Side Bar-->
            <?php include('includes/Sidebar.php')?>
            <!--Profile Area -->
            <div class="col-sm-6 mt-5">
                <form action="" method="post" class="mx-5 mt-5">
                    <div class="form-group">
                        <i class="fa-regular fa-envelope"></i>
                        <label for="rEmail">Email</label>
                        <input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php echo $rEmail;?>" readonly>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key "></i>
                        <label for="rOldPassword">Old Password</label>
                        <input type="password" class="form-control" name="rOldPassword" id="rOldPassword" >
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key "></i>
                        <label for="rNewpassword">New Password</label>
                        <input type="password" class="form-control" name="rNewpassword" id="rNewpassword">
                    </div>
                    <?php if(isset($UpdateMsg)){echo $UpdateMsg;}?>
                    
                    <button type="submit" class="btn btn-outline-dark mt-3" name="changepassword">Change Password</button>
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

