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
    define('TITLE', 'Inquiries');
    define('PAGE', 'Inquiries');
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
            <?php
                if(isset($_REQUEST['View']))
                {
                    $sql = "SELECT * FROM inquiry_tb  WHERE inquiry_id = {$_REQUEST['id']}";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    $proname = $row['request_info'];

                    $sqll = "SELECT estimate_price FROM serviceproduct_tb  WHERE product_name = '$proname'";
                    $result1 = $conn->query($sqll);
                    $roww = $result1->fetch_assoc();

                    $espr = $roww['estimate_price'];
                }
                
                if(isset($_REQUEST['assign']))
                {
                    $estimateDate = $_REQUEST['estimateDate'];
                    $estimatecharge = $_REQUEST['estimatecharge'];
                    if(($_REQUEST['inquiry_id'] == "") || ($_REQUEST['request_info'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['address1'] == "") || ($_REQUEST['address2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['requestdate'] == "") || ($_REQUEST['estimatecharge'] == "") || ($_REQUEST['estimateDate'] == ""))
                    {
                        $AlertMsg = '<div class="alert alert-danger mt-3" role="alert">All Fields are Required</div>';

                    }
                    else
                    {
                        $rid = $_REQUEST['inquiry_id'];

                        $sql = "INSERT INTO inquiryconform_tb(inquiry_id) VALUES ('$rid')";
                        $result = $conn->query($sql);

                            $sqlupdate = "UPDATE inquiry_tb SET estimate_price = '$estimatecharge', estimate_date = '$estimateDate',inquiry_status = 'DONE' WHERE inquiry_id= '$rid'";

                            if($conn->query($sqlupdate) == true)
                            {
                                $AlertMsg = '<div class="alert alert-success mt-3" role="alert">Inquiry Handle Successfully.</div>';
                                
                                // $sql = "DELETE FROM inquiry_tb WHERE inquiry_id = $rid" ;
                                // $conn->query($sql);

                            }
                            else
                            {
                                $AlertMsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Handle.</div>';
                            }  
                        }

                        
                    }
  
 
            ?>
            <div class="col-sm-6 mt-3 shadow-sm jumbotron">
                
                <form class="ms-2 mt-5"action="" method="post">
                    <h5 class="text-center">Inquiries</h5>
                    <!-- <h3 class="text-center">Handle Inquiries</h3> -->
                    <div class="form-group">
                        <i class="fa-regular fa-id-badge"></i>
                        <label for="inquiry_id">Request ID</label>
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
                            <label for="requestdate">Date</label>
                            <input type="date" class="form-control" name="requestdate" id="requestdate" value="<?php if(isset($row['request_date'])){echo $row['request_date'];}?>"readonly>
                        </div>
                    </div>
      
                    <div class="row ">

                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-regular fa-calendar-days"></i>
                            <label for="estimateDate">Estimate Service Date</label>
                            <input type="Date" class="form-control" name="estimateDate" id="estimateDate" >
                        </div>
                        <div class="form-group col-md-4 mt-2">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <label for="estimatecharge">Estimate Charge</label>
                            <input type="text" class="form-control" name="estimatecharge" id="estimatecharge" value="<?php if(isset($espr)){echo $espr;}?>">
                        </div>
                    </div>
                    <?php if(isset($AlertMsg)){echo $AlertMsg;}?>
                    <button type="submit" class="btn btn-outline-success mt-3 font-weight-bold" name="assign" id="assign">Submit</button>
                    <button type="reset" class="btn btn-outline-danger mt-3 font-weight-secondary">Reset</button>

                </form>
            </div>
            
            <!--3rd COL-->
            <div class="col-sm-4  mb-5 ">
                <?php
                    $sql = "SELECT * FROM inquiry_tb WHERE estimate_date = '0000-00-00'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo '<div class="card mt-5 mx-2">
                                    <div class="card-header">
                                        Inquiry ID : '.$row["inquiry_id"].'
                                    </div>
                                    <div class="card-body">
                                        <h5>Request Info : '.$row["request_info"].'</h5> 
                                        <p class=""card-text>Description: '.$row["request_desc"].'</p>
                                        <p class=""card-text>Request Date: '.$row["request_date"].'</p>
                                        <div class="float-right">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value='.$row["inquiry_id"].'>
                                                
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
