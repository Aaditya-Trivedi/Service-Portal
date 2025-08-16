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
    define('TITLE', 'Work Report');
    define('PAGE', 'WorkReport');    
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
            
            <div class="col-sm-9 col-md-10 mt-5">
                <form action="" method="post" class="d-print-none mt-3">
                <h4>Select Starting & Ending Date</h4>
                    <div class="row">
                        <div class="form-group col-auto">
                            <input type="date" class="form-control" name="startdate" id="startdate" >
                        </div>
                        <span class="form-group col-auto mt-2"> To </span>
                        <div class="form-group col-md-2">
                            <input type="date" class="form-control" name="enddate" id="enddate" >
                        </div>
                        <div class="form-group col-auto">
                            <input type="submit" class="btn btn-outline-secondary" name="searchsubmit" value="Search">
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_REQUEST['searchsubmit']))
                    {
                        $startDate = $_REQUEST['startdate'];
                        $endDate = $_REQUEST['enddate'];

                        if($_REQUEST['startdate'] != '00-00-0000' || $_REQUEST['enddate'] != '00-00-0000')
                        {
                            $sql = "SELECT assignwork_tb.*,inquiry_tb.*,technician_tb.*
                            FROM assignwork_tb
                            JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id
                            JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id
                            WHERE assignwork_tb.status = 'COMPLETED' AND assignwork_tb.assign_date BETWEEN '$startDate' AND '$endDate' ";

                            
                           
                            $result = $conn->query($sql);
                            
                            if($result->num_rows > 0)
                            {
                                echo "<div>
                                <p class='bg-dark text-white text-center p-2 mt-4'>Work Report</p>
                                <table class='table text-center mx-3'>
                                    <thead>
                                        <tr>
                                            <th scope = 'col'>Request ID</th>
                                            <th scope = 'col'>Request Info</th>
                                            <th scope = 'col'>Requester Name</th>
                                            <th scope = 'col'>Technician name</th>
                                            <th scope = 'col'>Service Date</th>
                                            <th scope = 'col'>Service Charge</th>

                                        </tr>
                                    </thead>
                                    <tbody>";
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "<tr>
                                            <td>".$row['inquiry_id']."</td>
                                            <td>".$row['request_info']."</td>
                                            <td>".$row['requester_name']."</td>
                                            <td>".$row['technician_name']."</td>
                                            <td>".$row['assign_date']."</td>
                                            <td>".$row['service_charge']."</td>
                                        </tr>
                                        ";
                                    }
                                    
                                echo "</tbody>
                                        </table>
                                        <tr>
                                            <td>
                                                <input type='submit' class='btn btn-outline-dark d-print-none' value='Print' onClick='window.print()'>
                                            </td>
                                        </tr>
                                </div >";
                            }
                            else
                            {
                                echo '<div class="alert alert-danger mt-3" role="alert">NO DATA FOUND</div>';
                            }
                        }
                        else
                        {
                            
                        }
                    }
                    else
                    {
                        
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

