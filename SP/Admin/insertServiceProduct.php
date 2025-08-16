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

    $sql = "SELECT * FROM serviceproduct_tb";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if(isset($_REQUEST['rSingup']))
    {
        //Cheking price Already Registered or Not in DB
        
        if($_REQUEST['product'] == $row['product_name'])
        {
            $smsg = '<div class="alert alert-danger" role="alert">
                    Product is Already Added
                    </div>';
        }
        else
        {//Registering Data
            $product = $_REQUEST['product'];
            $price = $_REQUEST['price'];
            $servicecharge = $_REQUEST['servicecharge'];
            $estimateprice = $_REQUEST['price'] +  $_REQUEST['servicecharge'];
            
            if ($_REQUEST['product'] == "" || $_REQUEST['price'] == "" || $_REQUEST['servicecharge'] == "") {
                $smsg = '<div class="alert alert-danger" role="alert">
                    Enter All the Data
                    </div>';
            }
            else{
                
                $sql = "INSERT INTO serviceproduct_tb(product_name,product_price,sercive_charge,estimate_price) VALUES('$product','$price','$servicecharge','$estimateprice')";
                
                if($conn->query($sql) == TRUE)
                {
                    echo "<script> location.href = 'ServiceProduct.php'</script>";    
                }
            }
            // ;  
            // $smsg = '<div class="alert alert-success" role="alert">
            //             Account Created Successfully!!
            //         </div>';
        } 
    }
    
}?>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/all.min.css">

        <link rel="stylesheet" href="../css/style.css">
          


<div class="container pt-5 " id="Registration">
    <h2 class="text-center">Add New Product</h2>
    <div class="row mt-4 mb-4">
        <div class = "col-md-6 offset-3 ">
            <form action="" class="shadow-lg p-4 " method="post" >
                <div class="form-group">
                    
                    <label for="name" class="font-weight-bold pl-2">Product Name</label>
                    <input type="text" class="form-control" placeholder="Product Name" name="product" required >

                </div>

                <div class="form-group">
                    <!-- <i class="fa-regular fa-envelope me-2"></i> -->
                    <label for="price" class="font-weight-bold pl-2">Price</label>
                    <input type="text" class="form-control" placeholder="price" name="price" onkeypress="isInputNumber(event)" required>
                </div>

                <div class="form-group">
                    <!-- <i class="fa-regular fa-envelope me-2"></i> -->
                    <label for="servicecharge" class="font-weight-bold pl-2">Service Charge</label>
                    <input type="text" class="form-control" placeholder="servicecharge" name="servicecharge" onkeypress="isInputNumber(event)" required>
                </div>

                <div class="d-grid gap-2">
                    <Button type="submit" class="btn btn-info mt-3 shadow-sm font-weight-bold" name="rSingup" >Add Product</Button>
                </div>
                <?php if(isset($smsg)){echo $smsg;}?>
                <div>
                    <a href="ServiceProduct.php" class="btn btn-secondary mt-3">BACK</a>
                    <!-- <Button type="submit" class="btn btn-secondary mt-5 shadow-sm font-weight-bold" name="back" >BACK</Button> -->
                </div>
            </form>
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