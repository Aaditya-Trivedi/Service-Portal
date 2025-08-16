<?php
include('../DBConnection.php');
session_start(); 
$now = time();
if($now >= $_SESSION['expire'])
{
    session_destroy();
    echo "<script> location.href = '../user/UserLogin.php'</script>";
}
else
{
    define('TITLE', 'Requester');
    define('PAGE', 'Requester');

        if(isset($_REQUEST['edit']))
        {
            $id=$_REQUEST['id'];
            $sql = "SELECT * FROM ragistration_tb WHERE r_id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }

    // for Update

    if (isset($_REQUEST['update'])) 
    {
            
        if($_REQUEST['rName'] == "" || $_REQUEST['rEmail'] == "" || $_REQUEST['rOldPassword'] == "")
        {
            $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Enter All Details</a></div>';
        }
        else
        {   
            $rid = $_REQUEST['rid'];
            $name = $_REQUEST['rName'];
            $email =  $_REQUEST['rEmail'];
            $password = $_REQUEST['rOldPassword'];

            //$rEmail = $_SESSION['rEmail'];
            //$rNewPassword = $_REQUEST['rNewpassword'];
            $sql = "UPDATE ragistration_tb SET r_name =  '$name' ,r_email = '$email' ,r_password = '$password' WHERE r_id = '$rid'";
            if ($conn->query($sql) == TRUE) 
            {
                $UpdateMsg = '<div class="alert alert-success mt-3" role="alert">Data Updated Successfully.</a></div>';
            }
            else 
            {
                $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Updated</a></div>';
            }
            
           
        }
    }
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
    <title><?php echo TITLE ?></title>
</head>
<body>
    <?php include('includes/header.php')?>
    <div class="container-fluid " style="margin-top: 5px; ">
        <div class="row">
            <!--Side Bar-->
            <?php include('includes/Sidebar.php')?>
            <!--work Area -->
            <div class="col-sm-9 col-md-10 mt-5">
                <form action="" method="post" class="mx-5 mt-5">
                    <div class="form-group">
                        
                        <label for="rid">User ID</label>
                        <input type="text" class="form-control" name="rid" id="rid" value="<?php if(isset($row['r_id'])){echo $row['r_id'];}?>" readonly>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-user"></i>
                        <label for="rName">Name</label>
                        <input type="text" class="form-control" name="rName" id="rName" value="<?php if(isset($row['r_name'])){echo $row['r_name'];}?>">
                    </div>
                    <div class="form-group">
                        <i class="fa-regular fa-envelope"></i>
                        <label for="rEmail">Email</label>
                        <input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php if(isset($row['r_email'])){echo $row['r_email'];}?>" >
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key "></i>
                        <label for="rOldPassword">Password</label>
                        <input type="text" class="form-control" name="rOldPassword" id="rOldPassword" value="<?php if(isset($row['r_password'])){echo $row['r_password'];}?>" >
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-3" name="update">Update</button>
                    <a href="Requester.php" class="btn btn-outline-secondary mt-3">BACK</a>

                </form>
                <?php if(isset($UpdateMsg)){echo $UpdateMsg;}?>
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