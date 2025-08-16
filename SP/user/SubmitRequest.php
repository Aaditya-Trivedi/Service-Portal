<?php
use LDAP\Result;

    include('../DBConnection.php');
    session_start();
    if($_SESSION['is_login'])
    {
        $rEmail = $_SESSION['rEmail'];
        $now = time();
        if($now >= $_SESSION['expire'])
        {
            session_destroy();
            echo "<script> location.href = 'UserLogin.php'</script>";
        }
        else
        {
            if(isset($_REQUEST['submitrequest']))
            {
                $D = $_REQUEST['requestdate'];
                $I = $_REQUEST['requestinfo'];
                $sqlcheck = "SELECT * FROM inquiry_tb WHERE request_info = '$I' AND request_date = '$D' AND requester_email = '$rEmail'";
                $resultt = $conn->query($sqlcheck);
                if ($resultt->num_rows == 1) 
                {
                    $RequestMsg = '<div class="alert alert-danger mt-3" role="alert">Your Request Already Submitted</div>';
                }
                else
                {
                    $sql = "SELECT * FROM inquiry_tb INNER JOIN serviceproduct_tb ON inquiry_tb.request_info = serviceproduct_tb.product_id WHERE requester_email = '$rEmail'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();


                    if($_REQUEST['requestinfo'] == "" || $_REQUEST['requestdesc'] == "" || $_REQUEST['requestername'] == "" || $_REQUEST['requesteradd1'] == "" || $_REQUEST['requesteradd2'] == "" || $_REQUEST['requestercity'] == "" || $_REQUEST['requesterstate'] == "" || $_REQUEST['requesterzip'] == "" || $_REQUEST['requestermobile'] == "" || $_REQUEST['requestdate'] == "" )
                    {
                        $RequestMsg = '<div class="alert alert-danger mt-3" role="alert">All Fields are Required</div>';
                    }
                    else
                    {
                    
                        $rinfo = $_REQUEST['requestinfo'];
                        $rdesc = $_REQUEST['requestdesc'];
                        $rname = $_REQUEST['requestername'];
                        $radd1 = $_REQUEST['requesteradd1'];
                        $radd2 = $_REQUEST['requesteradd2'];
                        $rcity = $_REQUEST['requestercity'];
                        $rstate = $_REQUEST['requesterstate'];
                        $rzip = $_REQUEST['requesterzip'];
                        $remail = $rEmail;
                        $rmobile = $_REQUEST['requestermobile'];
                        $rdate = $_REQUEST['requestdate'];
            
                        $sql = "INSERT INTO inquiry_tb(request_info,request_desc,requester_name,  requester_add1,requester_add2,requester_city,requester_state,requester_zip,   requester_email,requester_mobile,request_date,inquiry_status) VALUES('$rinfo','$rdesc','$rname',  '$radd1','$radd2','$rcity','$rstate','$rzip','$remail','$rmobile','$rdate','NOTDONE')";
                        if($conn->query($sql)==TRUE)
                        {
                            $RequestMsg = '<div class="alert alert-success mt-3" role="alert">Your Request has been submitted successfully!!</div>';

                        }
                    }
                }     
            }
        }
    }
    else
    {
        echo "<script> location.href = 'UserLogin.php'</script>";
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

    <title>SubmitRequest</title>
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
                    <ul class="nav-flex-column nav-underline  "><!--nav-pills -->
                        <li class="nav-item list-group-item mt-5">
                            <a href="UserProfile.php" class="nav-link ">
                            <i class="fas fa-user pl-2 me-2" ></i>Profile
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                           
                            <a href="SubmitRequest.php" class="nav-link active  "><!--bg-dark-->
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
            <!--Form Part-->
            <div class="col-sm-9 col-md-10 mt-5">
                <form class="mx-5 " action="" method="post">
                        <div class="form-group  mt-2">
                            <i class="fa-solid fa-pen"></i>
                            <label for="inputRequestInf">Request Info</label>

                            <select class="form-select"  name="requestinfo" id="inputRequestInfo" >
                                <option value="" selected></option>
                                <?php
                                    $sql = "SELECT * FROM serviceproduct_tb";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc())
                                    {
                                 ?>
                            
                                <option value="<?php echo $row["product_name"] ?>"><?php echo $row["product_name"] ?></option>
                                <?php }?>

                            </select>
                            
                        </div>
                    <!-- <div class="form-group ">
                        
                        <label for="inputRequestInfo">Request Info</label>
                        <input type="text"  class="form-control" name="requestinfo" id="inputRequestInfo" placeholder="Write Your Request"  >
                    </div> -->
                    <div class="form-group mt-2">
                        <i class="fa-regular fa-message"></i>
                        <label for="inputRequestDescription">Description</label>
                        <input type="text"  class="form-control" name="requestdesc" id="inputRequestDescription" placeholder="Write a Description" value="" >
                    </div>
                    <div class="form-group mt-2">
                        <i class="fas fa-user pl-2" ></i>
                        <label for="inputName">Name</label>
                        <input type="text"  class="form-control" id="inputName" placeholder="Enter Your Name" name="requestername" value="">
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-6 mt-2">
                            <i class="fa-solid fa-location-pin"></i>
                            <label for="inputAddress">Address Line 1</label>
                            <input type="text" class="form-control" name="requesteradd1" id="inputAddress" placeholder="House Name & No.">
                        </div>
                        <div class="form-group col-md-6 mt-2">
                            <i class="fa-solid fa-location-pin"></i>
                            <label for="inputAddress2">Address Line 2</label>
                            <input type="text" class="form-control" name="requesteradd2" id="inputAddress2" placeholder="Area/Colony/Socity">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" name="requestercity" id="inputCity">
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <label for="inputState">State</label>
                            <input type="text" class="form-control" name="requesterstate" id="inputState">
                        </div>
                        <div class="form-group col-md-2 mt-2">
                            <i class="fa-solid fa-thumbtack"></i>
                            <label for="inputZip">Zip/Pin Code</label>
                            <input type="text" class="form-control" name="requesterzip" id="inputZip" placeholder="Numbers Only" onkeypress="isInputNumber(event)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mt-2">
                            <i class="fa-regular fa-envelope"></i>
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" name="requesteremail" id="inputEmail" value="<?php echo $rEmail; ?>" disabled>
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-solid fa-phone"></i>
                            <label for="inputMobile">Mobile</label>
                            <input type="text" class="form-control" name="requestermobile" id="inputMobile" placeholder="Numbers Only" onkeypress="isInputNumber(event)">
                        </div>
                        <div class="form-group col-md-2 mt-2">
                            <i class="fa-regular fa-calendar-days"></i>
                            <label for="inputDate">Date</label>
                            <input type="date" class="form-control" name="requestdate" id="inputDate">
                        </div>
                    </div>
                    <?php if(isset($RequestMsg)){echo $RequestMsg;}?>
                    <button type="submit" class="btn btn-outline-success mt-3 font-weight-bold" name="submitrequest">Submit</button>
                    <button type="reset" class="btn btn-outline-danger mt-3 font-weight-secondary">Reset</button>

                </form>
                <?php include('RequestConfirm.php'); ?>
            </div>

        </div>
    </div>
            <!--Only Number Input Fields-->
            <script>
                function isInputNumber(evt)
                {
                    var ch = String.fromCharCode(evt.which);
                    if (!(/[0-9]/.test(ch))) 
                    {
                        evt.preventDefault();
                    }
                }
            </script>
            <!--JS-->
            <script src="../js/Jquery.min.js"></script>
            <script src="../js/Popper.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/all.min.js"></script> 
</body>
</html>