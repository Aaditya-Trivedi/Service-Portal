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
    define('TITLE', 'Requests');
    define('PAGE', 'Requests');
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
            <!--2nd COL-->
            <?php
                if(isset($_REQUEST['View']))
                {
                    $sql = "SELECT * FROM submitrequest_tb INNER JOIN inquiry_tb ON submitrequest_tb.inquiry_id = inquiry_tb.inquiry_id  WHERE request_id = {$_REQUEST['id']}";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                }
                
                if(isset($_REQUEST['assign']))
                {
                    if(($_REQUEST['inquiry_id'] == "") || ($_REQUEST['request_info'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['address1'] == "") || ($_REQUEST['address2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['requestdate'] == "") || ($_REQUEST['assigntech'] == "") || ($_REQUEST['assignDate'] == ""))
                    {
                        $AlertMsg = '<div class="alert alert-danger mt-3" role="alert">All Fields are Required</div>';

                    }
                    else
                    {

                        $rid = $_REQUEST['inquiry_id'];
                        $rinfo = $_REQUEST['request_info'];
                        $rdesc = $_REQUEST['requestdesc'];
                        $rname = $_REQUEST['requestername'];
                        $radd1 = $_REQUEST['address1'];
                        $radd2 = $_REQUEST['address2'];
                        $rcity = $_REQUEST['requestercity'];
                        $rstate = $_REQUEST['requesterstate'];
                        $rzip = $_REQUEST['requesterzip'];
                        $remail = $_REQUEST['requesteremail'];
                        $mobile = $_REQUEST['requestermobile'];
                        $rdate = $_REQUEST['requestdate'];
                        $rassigntechnician = $_REQUEST['assigntech'];
                        $rassigndate = $_REQUEST['assignDate'];
                        $serviceCharge = $_REQUEST['serviceCharge'];

                        $sql = "SELECT * FROM technicianbooked_tb WHERE date = '$rassigndate' AND technician = '$rassigntechnician'";
                        $result = $conn->query($sql);
                        if($result->num_rows == 3)
                        {
                            $AlertMsg ='<div class="alert alert-warning mt-3" role="alert">
                                        EMPLOYEE Already Booked For That Day
                                    </div>';

                        }
                        else
                        {
                            $sql = "SELECT request_id FROM submitrequest_tb WHERE request_id = $rid AND assign_status = 'ASSIGN'";
                            $result = $conn->query($sql);
                            if($result->num_rows!=0)
                            {
                                $AlertMsg ='<div class="alert alert-warning mt-3" role="alert">
                                            Work Already Assigned
                                        </div>';

                            }
                            else
                            {
                                $sqlupdate = "UPDATE inquiry_tb SET inquiry_status = 'ASSIGN' WHERE inquiry_id = '$rid' AND requester_email = '$remail'";
                                $conn->query($sqlupdate);


                                $sqlin = "INSERT INTO technicianbooked_tb (inquiry_id,technician,date) VALUES ('$rid','$rassigntechnician','$rassigndate')";
                                $conn->query($sqlin);

                                $status = 'ASSIGN';

                                $sql = "INSERT INTO assignwork_tb (inquiry_id ,technician_id,assign_date,service_charge,status) VALUES ('$rid','$rassigntechnician',' $rassigndate','$serviceCharge','$status')";

                                if($conn->query($sql) == true)
                                {
                                    $AlertMsg = '<div class="alert alert-success mt-3" role="alert">Work Assigned Successfully.</div>';

                                    $sql = "UPDATE submitrequest_tb SET assign_status = 'ASSIGN' WHERE request_id = '$rid'" ;
                                    $conn->query($sql);
                                }
                                else
                                {
                                    $AlertMsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Assign Work.</div>';
                                }  
                            }
                        }    
                    }
                }
            ?>
            <div class="col-sm-6 mt-3 shadow-sm jumbotron">
                <form class="ms-2  mt-5  "  novalidate action="" method="post">
                    <h5 class="text-center">Assign Work Order Request</h5>
                    <div class="form-group ">
                        <i class="fa-regular fa-id-badge"></i>
                        <label for="request_id">Request ID</label>
                        <input type="text"  class="form-control" name="inquiry_id" id="inquiry_id" value="<?php if
                        (isset($row['inquiry_id'])){echo $row['inquiry_id'];}?>" readonly>
                    </div>
                    <div class="form-group ">
                        <i class="fa-solid fa-pen"></i>
                        <label for="request_info">Request Info</label>
                        <input type="text"  class="form-control" name="request_info" id="request_info" value="<?php if(isset($row['request_info'])){echo $row['request_info'];}?>"readonly>
                    </div>
                    <div class="form-group mt-2">
                        <i class="fa-regular fa-message"></i>
                        <label for="requestdesc">Description</label>
                        <input type="text"  class="form-control" name="requestdesc" id="requestdesc" value="<?php if(isset($row['request_desc'])){echo $row['request_desc'];}?>"readonly>
                    </div>
                    <div class="form-group mt-2">
                        <i class="fas fa-user pl-2" ></i>
                        <label for="requestername">Name</label>
                        <input type="text"  class="form-control" id="requestername" name="requestername" value="<?php if(isset($row['requester_name'])){echo $row['requester_name'];}?>"readonly>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-6 mt-2">
                            <i class="fa-solid fa-location-pin"></i>
                            <label for="address1">Address Line 1</label>
                            <input type="text" class="form-control" name="address1" id="address1" value="<?php if(isset($row['requester_add1'])){echo $row['requester_add1'];}?>"readonly>
                        </div>
                        <div class="form-group col-md-6 mt-2">
                            <i class="fa-solid fa-location-pin"></i>
                            <label for="address2">Address Line 2</label>
                            <input type="text" class="form-control" name="address2" id="address2" value="<?php if(isset($row['requester_add2'])){echo $row['requester_add2'];}?>"readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5 mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <label for="requestercity">City</label>
                            <input type="text" class="form-control" name="requestercity" id="requestercity" value="<?php if(isset($row['requester_city'])){echo $row['requester_city'];}?>"readonly>
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <label for="requesterstate">State</label>
                            <input type="text" class="form-control" name="requesterstate" id="requesterstate" value="<?php if(isset($row['requester_state'])){echo $row['requester_state'];}?>"readonly>
                        </div>
                        <div class="form-group col-md-3 mt-2">
                            <i class="fa-solid fa-thumbtack"></i>
                            <label for="requesterzip">Zip/Pin Code</label>
                            <input type="text" class="form-control" name="requesterzip" id="requesterzip" onkeypress="isInputNumber(event)" value="<?php if(isset($row['requester_zip'])){echo $row['requester_zip'];}?>"readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5 mt-2">
                            <i class="fa-regular fa-envelope"></i>
                            <label for="requesteremail">Email</label>
                            <input type="email" class="form-control" name="requesteremail" id="requesteremail" value="<?php if(isset($row['requester_email'])){echo $row['requester_email'];}?>"readonly>
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-solid fa-phone"></i>
                            <label for="requestermobile">Mobile</label>
                            <input type="text" class="form-control" name="requestermobile" id="requestermobile" onkeypress="isInputNumber(event)" value="<?php if(isset($row['requester_mobile'])){echo $row['requester_mobile'];}?>"readonly>
                        </div>
                        <div class="form-group col-md-3 mt-2">
                            <i class="fa-regular fa-calendar-days"></i>
                            <label for="requestdate">Request Date</label>
                            <input type="date" class="form-control" name="requestdate" id="requestdate" value="<?php if(isset($row['request_date'])){echo $row['request_date'];}?>"readonly>
                        </div>
                    </div>
      
                    <div class="row ">
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <label for="inputDate">Service Charge</label>
                            <input type="text" class="form-control" name="serviceCharge" id="serviceCharge" value="<?php if(isset($row['estimate_price'])){echo $row['estimate_price'];}?>" readonly >
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fas fa-user pl-2" ></i>
                            <label for="assigntech">Assign to Technician</label>

                            <select class="form-select" id="assigntech" name="assigntech" >
                                <option value=""></option>
                                <?php
                                    $sql = "SELECT * FROM technician_tb";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc())
                                    {
                                 ?>
                            
                                <option value="<?php echo $row["technician_id"] ?>"><?php echo"ID - "; echo $row["technician_id"]; echo" "; echo $row["technician_name"] ?></option>
                                <?php }?>
                            </select>
                            
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-regular fa-calendar-days"></i>
                            <label for="inputDate">Assign Date</label>
                            <input type="Date" class="form-control" name="assignDate" id="assignDate" >
                        </div>
                        
                    </div>
                    <?php if(isset($AlertMsg)){echo $AlertMsg;}?>
                    <button type="submit" class="btn btn-outline-success mt-3 font-weight-bold" name="assign" id="assign">Submit</button>
                    <button type="reset" class="btn btn-outline-danger mt-3 font-weight-secondary">Reset</button>

                </form>
            </div>
            
            <!--3rd COL-->
            <div class="col-sm-4  mb-5">
                <?php
               $sql = "SELECT * FROM submitrequest_tb INNER JOIN inquiry_tb ON submitrequest_tb.inquiry_id = inquiry_tb.inquiry_id WHERE assign_status = 'NOTASSIGN' ";
                    // $sql = "SELECT * FROM submitrequest_tb INNER JOIN serviceproduct_tb ON submitrequest_tb.request_id = serviceproduct_tb.product_id ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo '<div class="card mt-5 mx-2">
                                    <div class="card-header">
                                        Request ID : '.$row["inquiry_id"].'
                                    </div>
                                    <div class="card-body">
                                        <h5>Request Info : '.$row["request_info"].'</h5> 
                                        <p class=""card-text>Description: '.$row["request_desc"].'</p>
                                        <p class=""card-text>Request Date: '.$row["request_date"].'</p>
                                        <div class="float-right">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value='.$row["request_id"].'>
                                                
                                                <input type="submit" class="btn btn-outline-success mx-2" value="View" name="View">
                                                
                                            </form>
                                        </div>    
                                    </div>
                                </div>';
                                if(isset($_REQUEST['id']))
                                {
                                    $id=$_REQUEST['id'] ;
                                }
                        }
                    } 
                ?>
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

