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
    define('TITLE', 'Work Order');
    define('PAGE', 'WorkOrder');
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
            <!--work Area -->
            <div class="col-sm-9 col-md-10 mt-5">
                <?php
                    $id = $_REQUEST['id'];

                    

                    $sql = "SELECT assignwork_tb.*,inquiry_tb.*,technician_tb.*, inquiry_tb.inquiry_id AS inquiry_id, technician_tb.technician_id AS technician_id 
                    FROM assignwork_tb  
                    JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id  
                    JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id 
                    WHERE inquiry_tb.inquiry_id='$id'";
                     $result = $conn->query($sql);
                     $row = $result->fetch_assoc();
                    if($result->num_rows > 0)
                    {
                        echo "<div>
                        <h3 class='text-center'>Request Details</h3>
                        <table class='table'>
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
                                    <td>
                                        <form action='WorkOrder.php'>
                                            <button class='btn btn-danger' name='view' value='View' type='submit'>Close</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div >";
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