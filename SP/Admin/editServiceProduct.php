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
    define('TITLE', 'ServiceProduct');
    define('PAGE', 'ServiceProduct');

        if(isset($_REQUEST['edit']))
        {
            $id=$_REQUEST['id'];
            $sql = "SELECT * FROM serviceproduct_tb WHERE product_id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }

    // for Update

    if (isset($_REQUEST['update'])) 
    {
            
        if( $_REQUEST['product'] == "" || $_REQUEST['price'] == "")
        {
            $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Enter All Details</a></div>';
        }
        else
        {   
            $productId = $_REQUEST['productId'];
            
            $productName =  $_REQUEST['product'];
            $price = $_REQUEST['price'];
            $servicecharge = $_REQUEST['servicecharge'];
            $estimateprice = $_REQUEST['price'] +  $_REQUEST['servicecharge'];

            //$product = $_SESSION['product'];
            //$rNewPassword = $_REQUEST['rNewpassword'];
            $sql = "UPDATE serviceproduct_tb SET product_name =  '$productName' ,product_price = '$price',sercive_charge = '$servicecharge', estimate_price = '$estimateprice'  WHERE product_id = '$productId'";
            if ($conn->query($sql) == TRUE) 
            {
                $UpdateMsg = '<div class="alert alert-success mt-3" role="alert">Data Updated Successfully.</a></div>';
            }
            else 
            {
                $UpdateMsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Updated</a></div>';
            }
            
           
        }
    }
}
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
    <?php include('includes/header.php')?>
    <div class="container-fluid " style="margin-top: 5px; ">
        <div class="row">
            <!--Side Bar-->
            <?php include('includes/Sidebar.php')?>
            <!--work Area -->
            <div class="col-sm-9 col-md-10 mt-5">
                <form action="" method="post" class="mx-5 mt-5">
                    <div class="form-group">
                        
                        <label for="productId">Product ID</label>
                        <input type="text" class="form-control" name="productId" id="productId" value="<?php if(isset($row['product_id'])){echo $row['product_id'];}?>" readonly>
                    </div>
                    <div class="form-group">
                        
                        <label for="product">Product Name</label>
                        <input type="text" class="form-control" name="product" id="product" value="<?php if(isset($row['product_name'])){echo $row['product_name'];}?>" >
                    </div>
                    <div class="form-group">
                        
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" onkeypress="isInputNumber(event)" value="<?php if(isset($row['product_price'])){echo $row['product_price'];}?>" >
                    </div>

                    <div class="form-group">
                        <i class="fa-regular fa-envelope me-2"></i>
                        <label for="servicecharge" class="font-weight-bold pl-2">Service Charge</label>
                        <input type="text" class="form-control" placeholder="servicecharge" name="servicecharge" onkeypress="isInputNumber(event)" value="<?php if(isset($row['sercive_charge'])){echo $row['sercive_charge'];}?>" required>
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-3" name="update">Update</button>
                    <a href="ServiceProduct.php" class="btn btn-outline-secondary mt-3">BACK</a>

                </form>
                <?php if(isset($UpdateMsg)){echo $UpdateMsg;}?>
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