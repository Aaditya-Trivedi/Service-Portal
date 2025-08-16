

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
            define('TITLE', 'WorkOrder');
            define('PAGE', 'WorkOrder');
            $rEmail = $_SESSION['rEmail'];
           // $tName = $_SESSION['tName'];

            if(isset($_REQUEST['Done']))
            {
                $id =$_REQUEST['id'];
                $sqll = "SELECT assignwork_tb.*,inquiry_tb.*,technician_tb.*, inquiry_tb.inquiry_id AS inquiry_id, technician_tb.technician_id AS technician_id 
                FROM assignwork_tb  
                JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id  
                JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id 
                WHERE inquiry_tb.inquiry_id = '$id'";
                $result = $conn->query($sqll);
                $row = $result->fetch_assoc();

                if($result->num_rows == 1)
                {
                    $assign_id = $row["assign_id"];
                    $inquiry_id= $row["inquiry_id"];
                    // $request_info=$row["request_info"];
                    // $request_desc=$row["request_desc"];
                    // $requester_name=$row["requester_name"];
                    // $requester_add1=$row["requester_add1"];
                    // $requester_add2=$row["requester_add2"];
                    // $requester_city=$row["requester_city"];
                    // $requester_state=$row["requester_state"];
                    // $requester_zip=$row["requester_zip"];
                    // $requester_email=$row["requester_email"];
                    // $requester_mobile=$row["requester_mobile"];
                    // $requestdate=$row["requestdate"];
                    // $technician_name=$row["technician_name"];
                    // $assign_date=$row["assign_date"];
                    // $service_charge=$row["service_charge"];

                    $sqlin = "INSERT INTO completework_tb (inquiry_id,assign_id) VALUES ('$inquiry_id','$assign_id')";

                    if($conn->query($sqlin) == true)
                    {
                        // $sqlTech = "SELECT * FROM technician_tb";
                        // $resulttech = $conn->query($sqlTech);
                        // $rowtech = $resulttech->fetch_assoc();
                        $sqlupdate = "UPDATE assignwork_tb
                        SET status = 'COMPLETED' WHERE inquiry_id = '$inquiry_id'";
                        $conn->query($sqlupdate);

                        $sqlTechBooked = "SELECT * FROM technicianbooked_tb WHERE inquiry_id = '$inquiry_id'";
                        $resulttechbooked = $conn->query($sqlTechBooked);
                        $rowtechbooked = $resulttechbooked->fetch_assoc();
                        $techbookedId = $rowtechbooked['inquiry_id'];
                        
                        if($resulttechbooked->num_rows == 1)
                        {
                            $sqlFreeBooke = "DELETE FROM technicianbooked_tb WHERE inquiry_id = '$inquiry_id'";
                            $conn->query($sqlFreeBooke);
                            
                        } 

                    }
                    else
                    {
                        $AltMsg = '<div class="alert alert-danger mt-3" role="alert">Something went wrong Please try again later.</div>';
                    }
                }
            }
            if(isset($_REQUEST['Reject']))
            {
                $id =$_REQUEST['id'];

                $sqll = "SELECT assignwork_tb.*,inquiry_tb.*,technician_tb.*, inquiry_tb.inquiry_id AS inquiry_id, technician_tb.technician_id AS technician_id 
                FROM assignwork_tb  
                JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id  
                JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id 
                WHERE inquiry_tb.inquiry_id = '$id'";
                
                $result = $conn->query($sqll);
                $row = $result->fetch_assoc();

                if($result->num_rows == 1)
                {
                    $assign_id = $row["assign_id"];
                    $inquiry_id= $row["inquiry_id"];
                    // $request_info=$row["request_info"];
                    // $request_desc=$row["request_desc"];
                    // $requester_name=$row["requester_name"];
                    // $requester_add1=$row["requester_add1"];
                    // $requester_add2=$row["requester_add2"];
                    // $requester_city=$row["requester_city"];
                    // $requester_state=$row["requester_state"];
                    // $requester_zip=$row["requester_zip"];
                    // $requester_email=$row["requester_email"];
                    // $requester_mobile=$row["requester_mobile"];
                    // $requestdate=$row["requestdate"];
                    // $technician_name=$row["technician_name"];
                    // $assign_date=$row["assign_date"];
                    // $service_charge=$row["service_charge"];

                    $sqlupdate = "UPDATE assignwork_tb SET status = 'REJECT' WHERE inquiry_id = '$id'";
                    

                    if($conn->query($sqlupdate) == true)
                    {
                        $sqlTechBooked = "SELECT * FROM technicianbooked_tb WHERE inquiry_id = '$inquiry_id'";
                        $resulttechbooked = $conn->query($sqlTechBooked);
                        $rowtechbooked = $resulttechbooked->fetch_assoc();
                        $techbookedId = $rowtechbooked['request_id'];
                        
                        if($resulttechbooked->num_rows == 1)
                        {
                            $sqlFreeBooke = "DELETE FROM technicianbooked_tb WHERE inquiry_id = '$inquiry_id'";
                            $conn->query($sqlFreeBooke);
                            
                        } 

                    }
                    else
                    {
                        $AltMsg = '<div class="alert alert-danger mt-3" role="alert">Something went wrong Please try again later.</div>';
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
            <div class="col-sm-9 col-md-10 mt-5">
                <?php
                    //$tId =$_SESSION['tId'];

                    $sql = "SELECT * FROM assignwork_tb 
                    JOIN technician_tb ON assignwork_tb.technician_id = technician_tb.technician_id JOIN inquiry_tb ON assignwork_tb.inquiry_id = inquiry_tb.inquiry_id WHERE status = 'ASSIGN' AND technician_email = '$rEmail'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        echo '<table class="table text-center">
                        <thead>
                            <tr>
                                <th scope = "col">Request ID</th>
                                <th scope = "col">Request Info</th>
                                <th scope = "col">User Name</th>
                                <th scope = "col">User Email</th>
                                <th scope = "col">Technicion Name</th>
                                <th scope = "col">Assigned Date</th>
                                <th scope = "col">View Done Reject</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($row = $result->fetch_assoc())
                        {
                        echo'<tr>
                                <td>'.$row["inquiry_id"].'</td>
                                <td>'.$row["request_info"].'</td>
                                <td>'.$row["requester_name"].'</td>
                                <td>'.$row["requester_email"].'</td>
                                <td>'.$row["technician_name"].'</td>
                                <td>'.$row["assign_date"].'</td>
                                <td >
                                    <form action="viewworkOrder.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='.$row["inquiry_id"].'>
                                        <button class="btn btn-warning" name="view" value="View" type="submit"><i class="fa-regular fa-eye"></i></button>
                                    </form>
                                    
                                    <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='.$row["inquiry_id"].'>
                                        <button class="btn btn-success" name="Done" value="Done" type="submit"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                    <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='.$row["inquiry_id"].'>
                                        <button class="btn btn-danger" name="Reject" value="Reject" type="submit"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </td>
                            </tr>';
                         
                        }
                        echo'</tbody>
                    </table>';
                    }
                    else
                    {
                        echo "Work Not Assign Yet.";
                    }
                    
                ?>
            </div>
            <?php if(isset($AltMsg)){echo $AltMsg;}?>
        </div>
    </div>
    <!--JS-->
    <script src="../js/Jquery.min.js"></script>
    <script src="../js/Popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script> 
</body>
</html>