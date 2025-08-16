<!-- CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<link rel="stylesheet" href="../css/all.min.css">

<link rel="stylesheet" href="../css/style.css">


<?php
    include('../DBConnection.php');

    $rEmail = $_SESSION['rEmail'];


    $sql = "SELECT * FROM inquiryconform_tb INNER JOIN inquiry_tb ON inquiryconform_tb.inquiry_id = inquiry_tb.inquiry_id WHERE requester_email = '$rEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if($result->num_rows == 0)
    {

    }
    else
    {

        if($row["estimate_date"] != "0000-00-00")
        {
            echo '<table class="table mt-3 text-center">
            <thead>
                <tr>
                    <th scope = "col">Name</th>
                    <th scope = "col">Request Info</th>
                    <th scope = "col">Request Description</th>
                    <th scope = "col">Request Date</th>
                    <th scope = "col">Estimate Service Date</th>
                    <th scope = "col">Estimate Price</th>
                    <th scope = "col">Do want to Continue</th>
                </tr>
            </thead>
            <tbody>';

            $sql = "SELECT * FROM inquiry_tb  WHERE requester_email = '$rEmail' AND estimate_date != '0000-00-00' AND inquiry_status = 'DONE'";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc())
            {
            echo'<tr>
                    <td>'.$row["requester_name"].'</td>
                    <td>'.$row["request_info"].'</td> 
                    <td>'.$row["request_desc"].'</td>
                    <td>'.$row["request_date"].'</td>
                    <td>'.$row["estimate_date"].'</td>
                    <td>'.$row["estimate_price"].'</td>
                    
                    <td>
                        <form action="" method="POST" class="d-inline">
                        
                            <button class="btn btn-success" name="Done" value="Done" type="submit"><i class="fa-solid fa-check"></i></button>
                        </form>
                        <form action="" method="POST" class="d-inline">
                            <button class="btn btn-danger" name="Reject" value="Reject" type="submit"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </td>
                </tr>';
            }
            echo'</tbody>
            </table>';
            if(isset($_REQUEST['Done']))
            {
                $sql = "SELECT * FROM inquiryconform_tb ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if($result->num_rows > 0)
                {
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
                    // $request_date=$row["request_date"];
                    // $service_price=$row["estimate_price"];


                    $sqlin = "INSERT INTO submitrequest_tb (inquiry_id,assign_status) VALUES ('$inquiry_id','NOTASSIGN')";

                    if($conn->query($sqlin) == true)
                    {
                        $sqlupdate = "UPDATE inquiry_tb
                        SET inquiry_status = 'NOTASSIGN'
                        WHERE inquiry_id = '$inquiry_id' AND requester_email = '$rEmail'";
                        $conn->query($sqlupdate);

                        $sql = "DELETE FROM inquiryconform_tb WHERE inquiry_id = $inquiry_id" ;
                        $conn->query($sql);

                        echo '<script>location.href="SubmitRequest.php";<script>';
                    }
                    else
                    {
                        $AltMsg = '<div class="alert alert-danger mt-3" role="alert">Something went wrong Please try again later.</div>';
                    }
                }
            }
            if(isset($_REQUEST['Reject']))
            {
                $sql = "SELECT * FROM inquiryconform_tb ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if($result->num_rows == 1)
                {
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
                    // $requestdate=$row["request_date"];
                    // $service_price=$row["estimate_price"];
                    
                    $sqlDconform = "DELETE FROM inquiryconform_tb WHERE inquiry_id = '$inquiry_id'" ;
                    $conn->query($sqlDconform);

                    $sql = "DELETE FROM inquiry_tb WHERE inquiry_id = '$inquiry_id'" ;
                    $conn->query($sql);

                }
            }
            else
            {
            
            }
        }
}
    //$myid = $_SESSION['genid'];  
?>
            <!--JS-->
            <script src="../js/Jquery.min.js"></script>
            <script src="../js/Popper.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/all.min.js"></script> 
