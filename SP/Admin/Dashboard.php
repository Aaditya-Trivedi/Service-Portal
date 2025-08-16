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
    define('TITLE', 'Dashboard');
    define('PAGE', 'dashboard');

    $sql = "SELECT * FROM ragistration_tb";
    $result = $conn->query($sql);
    $user = $result->num_rows;

    $sqltech = "SELECT * FROM technician_tb";
    $result = $conn->query($sqltech);
    $technician = $result->num_rows;

    $sqlinquiry = "SELECT * FROM inquiry_tb WHERE inquiry_status='NOTDONE'";
    $result = $conn->query($sqlinquiry);
    $inquiry = $result->num_rows;

    $sqlrequest = "SELECT * FROM submitrequest_tb WHERE assign_status='NOTASSIGN'";
    $result = $conn->query($sqlrequest);
    $numrequest = $result->num_rows;

    $sqlrequestassign = "SELECT * FROM assignwork_tb WHERE status='ASSIGN'";
    $result = $conn->query($sqlrequestassign);
    $numrequestassign = $result->num_rows;

    $sqlrequestasreject = "SELECT * FROM assignwork_tb WHERE status='REJECT'";
    $result = $conn->query($sqlrequestasreject);
    $numrequestreject = $result->num_rows;

    $sqlrequestcomplete = "SELECT * FROM completework_tb ";
    $result = $conn->query($sqlrequestcomplete);
    $numrequestcomplete = $result->num_rows;

    $sqlserviceproduct = "SELECT * FROM serviceproduct_tb ";
    $result = $conn->query($sqlserviceproduct);
    $serviceproduct = $result->num_rows;
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- <script type="text/javascript">
        window.history.forward();
    </script> -->
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
            <div class="col-sm-9 col-sm-10 mt-5 ">


                <div class="row text-center mx-5">
                   
                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white  mb-3" style="background-color:chocolate; max-width:18rem;">
                            <div class="card-header">Technicians</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $technician; ?></h4>
                                <a class="btn text-white" href="Technicians.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white bg-primary mb-3" style="max-width:18rem;">
                            <div class="card-header">Users</div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                       <?php echo $user; ?>
                                    </h4>
                                    <a class="btn text-white" href="Requester.php">View</a>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white mb-3" style="background-color:darkmagenta; max-width:18rem;">
                            <div class="card-header">Service Products</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $serviceproduct ?></h4>
                                <a class="btn text-white" href="ServiceProduct.php">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white mb-3" style="background-color:saddlebrown; max-width:18rem;">
                            <div class="card-header">inquiry Received</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $inquiry ?></h4>
                                <a class="btn text-white" href="Inquiries.php">View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-center mx-5">
                    
                    
                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white mb-3" style="background-color:darkslategray; max-width:18rem;">
                            <div class="card-header">Requests Received</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $numrequest ?></h4>
                                <a class="btn text-white" href="Requests.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white mb-3" style="background-color:darkolivegreen; max-width:18rem;">
                            <div class="card-header">Assigned Requests</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $numrequestassign ?></h4>
                                <a class="btn text-white" href="WorkOrder.php">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white  mb-3" style="background-color:slategrey; max-width:18rem;">
                            <div class="card-header">Rejected Requests</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $numrequestreject; ?></h4>
                                <a class="btn text-white" href="RejectedRequests.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-5 pt-3">
                        <div class="card text-white mb-3" style="background-color:forestgreen; max-width:18rem;">
                            <div class="card-header">Complete Work</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $numrequestcomplete; ?></h4>
                                <a class="btn text-white" href="WorkReport.php">View</a>
                            </div>
                        </div>
                    </div>
                    

                
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