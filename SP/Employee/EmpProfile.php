
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
            define('TITLE', 'Profile');
            define('PAGE', 'Profile');
            $rEmail = $_SESSION['rEmail'];
            $sql = "SELECT technician_name,technician_id FROM technician_tb WHERE technician_email = '$rEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();
                $rName = $row['technician_name'];
                $tId = $row['technician_id'];
                $_SESSION['tId'] = $tId;    
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
                    $_SESSION['tName'] = $rName;
                    $sql = "UPDATE technician_tb SET technician_name = '$rName' WHERE technician_email = '$rEmail'";
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

    <title><?php echo TITLE ?></title>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <?php include('../user/ProfNav.php')?>
        <a href="EmpProfile.php" class="navbar-brand col-sm-3 col-md-2 mr-0 " >
        
        </a>
    </nav>


    <div class="container-fluid " style="margin-top: 40px; ">
        <div class="row">
            <!--Side Bar -->
            <?php include('includes/EPSidebar.php')?>
            
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