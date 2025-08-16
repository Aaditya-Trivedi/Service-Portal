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
            <div class="col-sm-9 col-md-10 mt-5 text-center">
                <?php
                    // $sql = "SELECT * FROM assignwork_tb INNER JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id ";

                    $sqll = "SELECT * FROM assignwork_tb 
                    JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id WHERE status = 'ASSIGN'";
                    // "SELECT * FROM assignwork_tb INNER JOIN inquiry_td ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id";
                    $result1 = $conn->query($sqll);
                    // $result = $conn->query($sql);
                    if($result1->num_rows > 0)
                    {
                        echo '<table class="table">
                        <thead>
                            <tr>
                                <th scope = "col">Request ID</th>
                                <th scope = "col">Request Info</th>
                                <th scope = "col">User Name</th>
                                <th scope = "col">User Email</th>
                                <th scope = "col">Technicion Name</th>
                                <th scope = "col">Assigned Date</th>
                                <th scope = "col">View</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($row = $result1->fetch_assoc())
                        {
                        echo'<tr>
                                <td>'.$row["inquiry_id"].'</td>
                                <td>'.$row["request_info"].'</td>
                                <td>'.$row["requester_name"].'</td>
                                <td>'.$row["requester_email"].'</td>
                                <td>'.$row["technician_name"].'</td>
                                <td>'.$row["assign_date"].'</td>
                                <td>
                                    <form action="viewworkOrder.php">
                                    <input type="hidden" name="id" value='.$row["inquiry_id"].'>
                                        <button class="btn btn-warning" name="view" value="View" type="submit"><i class="fa-regular fa-eye"></i></button>
                                    </form>
                                </td>
                            </tr>';
                        }
                        echo'</tbody>
                    </table>';
                    }
                    else
                    {
                      echo '<div class="alert alert-warning mt-3" role="alert">Work Not Assing Yet</a></div>';  
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

