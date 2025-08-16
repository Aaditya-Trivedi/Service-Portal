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
    define('TITLE', 'Technicians');
    define('PAGE', 'Technicians');
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
            <div class="col-sm-9 col-md-10 mt-5 text-center">
                <?php
                    $sql = "SELECT * FROM technician_tb";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        echo '<table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope = "col">Technician ID</th>
                                <th scope = "col">Technician Name</th>
                                <th scope = "col">Technician Mobile</th>
                                <th scope = "col">Technician Email</th>
                                <th scope = "col">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($row = $result->fetch_assoc())
                        {
                        echo'<tr>
                                <td>'.$row["technician_id"].'</td> 
                                <td>'.$row["technician_name"].'</td>
                                <td>'.$row["technician_mobile"].'</td>
                                <td>'.$row["technician_email"].'</td>
                                
                                <td>
                                    <form action="editTechnicians.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='.$row["technician_id"].'>
                                        <button class="btn btn-warning" name="edit" value="Edit" type="submit"><i class="fa-regular fa-pen-to-square"></i></button>
                                    </form>
                                    <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='.$row["technician_id"].'>
                                        <button class="btn btn-secondary" name="delete" value="delete" type="submit"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>';
                        }
                        echo'</tbody>
                    </table>';
                    }
                    else
                    {
                      echo '<div class="alert alert-warning mt-3" role="alert">NO DATA FOUND</div>';  
                    }
                    if(isset($_REQUEST['delete']))
                    {
                    $sql = "DELETE FROM ragistration_tb WHERE r_id = {$_REQUEST['id']}" ;
                    $conn->query($sql);
                    }  
                ?>
            </div>
        </div>
        <div class="position-absolute top-0 end-0 mt-5 me-3">
            <a href="insertTechnicians.php" class="btn btn-primary mt-2">
                <i class="fa-solid fa-plus fa-2x"></i>
            </a>
        </div>
    </div>
        <!--JS-->
        <script src="../js/Jquery.min.js"></script>
        <script src="../js/Popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>

        
</body>
</html>

