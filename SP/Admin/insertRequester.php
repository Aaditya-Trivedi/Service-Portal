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
    if(isset($_REQUEST['rSingup']))
    {
        //Cheking Email Already Registered or Not in DB
        $sql = "SELECT r_email FROM ragistration_tb WHERE r_email = '".$_REQUEST['rEmail']."'";
        $result = $conn->query($sql);
        if($result->num_rows!=0)
        {
            $smsg = '<div class="alert alert-danger" role="alert">
                    Email  is Already Registered
                    </div>';
        }
        else
        {//Registering Data
            $rName = $_REQUEST['rName'];
            $rEmail = $_REQUEST['rEmail'];
            $rPassword = $_REQUEST['rPassword'];
    
            $sql = "INSERT INTO ragistration_tb(r_name,r_email,r_password) VALUES('$rName','$rEmail','$rPassword')";
            if($conn->query($sql) == TRUE)
            {
                echo "<script> location.href = 'Requester.php'</script>";    
            }
            // ;  
            // $smsg = '<div class="alert alert-success" role="alert">
            //             Account Created Successfully!!
            //         </div>';
        } 
    }
    
}?>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/all.min.css">

        <link rel="stylesheet" href="../css/style.css">
          


<div class="container pt-5 " id="Registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
        <div class = "col-md-6 offset-3 ">
            <form action="" class="shadow-lg p-4 " method="post" >
                <div class="form-group">
                    <i class="fas fa-user me-2"></i> 
                    <label for="name" class="font-weight-bold pl-2">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="rName" required >

                </div>

                <div class="form-group">
                    <i class="fa-regular fa-envelope me-2"></i>
                    <label for="email" class="font-weight-bold pl-2">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="rEmail" required>
                </div>

                <div class="form-group">
                    <i class="fa-solid fa-eye me-2"></i> 
                    <label for="pass" class="font-weight-bold pl-2">New Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="rPassword" required>
                </div>
                <div class="row">
                    <div class="showpassword_box col"><input type="checkbox" name="" id="checkbox" class="mx-2 my-2">Show Password</div>
                </div>
                <div class="d-grid gap-2">
                    <Button type="submit" class="btn btn-info mt-3 shadow-sm font-weight-bold" name="rSingup" >Add User</Button>
                </div>
                <?php if(isset($smsg)){echo $smsg;}?>
                <div>
                    <a href="Requester.php" class="btn btn-secondary mt-3">BACK</a>
                    <!-- <Button type="submit" class="btn btn-secondary mt-5 shadow-sm font-weight-bold" name="back" >BACK</Button> -->
                </div>
            </form>
        </div>
    </div>
</div>

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
        <!--JS-->
        <script src="../js/Jquery.min.js"></script>
        <script src="../js/Popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>