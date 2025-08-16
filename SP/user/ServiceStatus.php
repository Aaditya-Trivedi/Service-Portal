<?php 
    include('../DBConnection.php');
    session_start(); 
    if($_SESSION['is_login'])
    {
        $rEmail = $_SESSION['rEmail'];
        $now = time();
        if($now >= $_SESSION['expire'])
        {
            session_destroy();
            echo "<script> location.href = 'Logout.php'</script>";
        }
        else
        {
            if(isset($_REQUEST['checkid']))
            {
                $sql = "SELECT assignwork_tb.*,inquiry_tb.*,technician_tb.*, inquiry_tb.inquiry_id AS inquiry_id, technician_tb.technician_id AS technician_id 
                        FROM assignwork_tb  
                        JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id  
                        JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id 
                        WHERE inquiry_tb.inquiry_id={$_REQUEST['checkid']}";

                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if(isset($_REQUEST['checkbtn']))
                {
                    if($result->num_rows > 0)
                    {
                        if($row['requester_email'] == $rEmail)
                        {
                            $checkMsg = "<div id='RD'>
                            <h3 class='text-center'>Request Details</h3>
                            <table class='table  table-bordered'>
                                <tbody>
                                    <tr>
                                        <td>Request ID: </td>
                                        <td>".$row['inquiry_id']."</td>
                                    </tr>
                                    <tr>
                                        <td>Request Info: </td>
                                        <td>".$row['request_info']."</td>
                                    </tr>
                                    <tr>
                                        <td>Request Decription: </td>
                                        <td>".$row['request_desc']."</td>
                                    </tr>
                                    <tr>
                                        <td>Requester Name: </td>
                                        <td>".$row['requester_name']."</td>
                                    </tr>
                                    <tr>
                                        <td>Address Line 1: </td>
                                        <td>".$row['requester_add1']."</td>
                                    </tr>
                                    <tr>
                                        <td>Address Line 2: </td>
                                        <td>".$row['requester_add2']."</td>
                                    </tr>
                                    <tr>
                                        <td>City: </td>
                                        <td>".$row['requester_city']."</td>
                                    </tr>
                                    <tr>
                                        <td>State: </td>
                                        <td>".$row['requester_state']."</td>
                                    </tr>
                                    <tr>
                                        <td>Zip: </td>
                                        <td>".$row['requester_zip']."</td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail: </td>
                                        <td>".$row['requester_email']."</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Mobile: </td>
                                        <td>".$row['requester_mobile']."</td>
                                    </tr>
                                    <tr>
                                        <td>Request Date: </td>
                                        <td>".$row['request_date']."</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Technician name: </td>
                                        <td>".$row['technician_name']."</td>
                                    </tr>
                                    <tr>
                                        <td>Technician Mobile: </td>
                                        <td>".$row['technician_mobile']."</td>
                                    </tr>
                                    <tr>
                                        <td>Service Date: </td>
                                        <td>".$row['assign_date']."</td>
                                    </tr>
                                    <tr>
                                        <td>Service Charge: </td>
                                        <td>".$row['service_charge']."</td>
                                    </tr>
                                    <tr>
                                    <td form class='d-print-none' colspan='2'><button class = 'btn btn-dark' type = 'submit' id= 'Print' onClick = 'printpage()'>Print</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div >";
                        }
                        else
                        {
                            $checkMsg = '<div class="alert alert-danger mt-3" role="alert">Wrong Request ID Please try Again</a></div>';
                        }
                    }
                    else
                    {
                        $sql = "SELECT * FROM submitrequest_tb WHERE request_id={$_REQUEST['checkid']}";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0)
                        {
                            if($row['requester_email'] == $rEmail)
                            {
                                $tech = "Technician Not Assinged Yet.";
                                $checkMsg = "<div id='RD'>
                                    <h3 class='text-center'>Request Details</h3>
                                    <table class='table table-bordered'>
                                    <tbody>
                                        <tr>
                                            <td>Request ID: </td>
                                            <td>".$row['request_id']."</td>
                                        </tr>
                                        <tr>
                                            <td>Request Info: </td>
                                            <td>".$row['request_info']."</td>
                                        </tr>
                                        <tr>
                                            <td>Request Decription: </td>
                                            <td>".$row['request_desc']."</td>
                                        </tr>
                                        <tr>
                                            <td>Address Line 1: </td>
                                            <td>".$row['requester_add1']."</td>
                                        </tr>
                                        <tr>
                                            <td>Address Line 2: </td>
                                            <td>".$row['requester_add2']."</td>
                                        </tr>
                                        <tr>
                                            <td>City: </td>
                                            <td>".$row['requester_city']."</td>
                                        </tr>
                                        <tr>
                                            <td>State: </td>
                                            <td>".$row['requester_state']."</td>
                                        </tr>
                                        <tr>
                                            <td>Zip: </td>
                                            <td>".$row['requester_zip']."</td>
                                        </tr>
                                        <tr>
                                            <td>E-Mail: </td>
                                            <td>".$row['requester_email']."</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Mobile: </td>
                                            <td>".$row['requester_mobile']."</td>
                                        </tr>
                                        <tr>
                                            <td>Request Date: </td>
                                            <td>".$row['request_date']."</td>
                                        </tr>
                                        <tr>
                                            <td>Technician name: </td>
                                            <td>".$tech."</td>
                                        </tr>
                                        <tr>
                                            <td>Technician Mobile: </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Service Date: </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Fixed Service Charge: </td>
                                            <td></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                </div >";
                            }
                            else
                            {
                                $checkMsg = '<div class="alert alert-danger mt-3" role="alert">Wrong Request ID Please try Again</a></div>';
                            }
                            
                        }
                        else
                        {
                            $checkMsg = "NO DATA FOUND";
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
    <style>
        @media print{
            .navbar * {
                visibility: hidden;
            }
            .sidebar{
                visibility: hidden;
            }
            .fm{
                visibility: hidden;
            }
            .RB{
                visibility: visible;
            }
            .LR{
                visibility: hidden;
            }

            
        }
    </style>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">

    <title>ServiceStatus</title>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <?php include('ProfNav.php')?>
        <a href="UserProfile.php" class="navbar-brand col-sm-3 col-md-2 mr-0 " >
        
        </a>
    </nav>
    <div class="container-fluid "  style="margin-top: 40px; ">
        <div class="row">
            <!--Side Bar -->
            <nav class=" sidebar col-sm-2 sidebar py-5 bg-outline-dark shadow">
                <div class="sidebar-sticky">
                    <ul class="nav-flex-column nav-underline"><!--nav-pills -->
                        <li class="nav-item list-group-item mt-5">
                            <a href="UserProfile.php" class="nav-link ">
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
                            <a href="ServiceStatus.php" class="nav-link active"><!--bg-dark-->
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
            <div class="fm col-sm-9 mt-5 mx-3">
                <form action="" method="post" class="form-check ">
                    <div class="form-group form-check-inline">
                        <label for="checkid">Enter Request ID: </label>
                        <input type="text" class="form-control" name="checkid" id="checkid" onkeypress="isInputNumber(event)" required >
                    </div>
                    <button type="submit" name="checkbtn" class="btn btn-outline-dark  form-check-inline">Check</button>
                    
                </form>
                <div class="RB">
                <?php if(isset($_REQUEST['checkbtn'])){echo $checkMsg;}?>
                </div>
                <div class="LR mx-5 mt-5 text-center ">
                    <p class="bg-dark text-white p-2">List of Assinged Request</p>
                    <?php
                        $sqll = "SELECT assignwork_tb.*,inquiry_tb.*,technician_tb.*, inquiry_tb.inquiry_id AS inquiry_id, technician_tb.technician_id AS technician_id 
                        FROM assignwork_tb  
                        JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id  
                        JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id 
                        WHERE inquiry_tb.requester_email ='$_SESSION[rEmail]'";
                        $result = $conn->query($sqll);

                        if($result->num_rows > 0)
                        {
                            echo'<table class="table">
                                    <thead>
                                        <tr>
                                            <th scope = "col">Request ID</th>
                                            <th scope = "col">Request Info</th>
                                            <th scope = "col">Your Email</th>
                                            <th scope = "col">Request Date</th>
                                            <th scope = "col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    while($row = $result->fetch_assoc())
                                    {
                                    echo'<tr>
                                            <td>'.$row["inquiry_id"].'</td>
                                            <td>'.$row["request_info"].'</td>
                                            <td>'.$row["requester_email"].'</td>
                                            <td>'.$row["request_date"].'</td>
                                            <td>'.$row["status"].'</td>
                                        </tr>';
                                    }
                                    echo'</tbody>
                                </table>';
                        }
                        else
                        {
                            echo "Requests Not Assign or Submtited Yet";
                        }
                    ?>
                </div>
            </div>
            

        </div>
    </div>

            <!--JS-->
            <script type="text/javascript">
                function printpage()
                {
                   // var body = document.getElementById('RD').innerHTML;
                   // alert(body);
                    window.print();
                }
                //Only Number Input Fields
                function isInputNumber(evt)
                {
                    var ch = String.fromCharCode(evt.which);
                    if (!(/[0-9]/.test(ch))) 
                    {
                        evt.preventDefault();
                    }
                }
            
            </script>
            <script src="../js/Jquery.min.js"></script>
            <script src="../js/Popper.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/all.min.js"></script> 
</body>
</html>