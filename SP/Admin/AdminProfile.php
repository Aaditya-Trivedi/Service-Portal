

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
<div class="container-fluid " style="margin-top: 30px; ">
        <div class="row">
            <!--Side Bar -->
            <nav class="col-sm-2 sidebar py-5 bg-outline-dark shadow">
                <div class="sidebar-sticky">
                    <ul class="nav-flex-column nav-underline"><!--nav-pills -->
                        <li class="nav-item list-group-item mt-5">
                            <a href="Dashboard.php" class="nav-link <?php if(PAGE == 'dashboard'){echo 'active';} ?>"><!--bg-dark-->
                            <i class="fas fa-user pl-2 me-2" ></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="WorkOrder.php" class="nav-link <?php if(PAGE == 'WorkOrder'){echo 'active';} ?>">
                           <!-- <i class="fab fa-accessible-icon "></i>-->
                           <i class="fa-regular fa-clipboard me-2"></i>Work Order
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="ServiceStatus.php" class="nav-link <?php if(PAGE == 'dashboard'){echo 'active';} ?>">
                            <!--<i class="fas fa-user "></i>-->
                            <i class="fa-solid fa-list-check me-2 <?php if(PAGE == 'dashboard'){echo 'active';} ?>"></i>Service Status
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="ChangePassword.php" class="nav-link <?php if(PAGE == 'dashboard'){echo 'active';} ?>">
                            <!--<i class="fas fa-user "></i>-->
                            <i class="fa-solid fa-eye me-2"></i>Change Password
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="Logout.php" class="nav-link <?php if(PAGE == 'dashboard'){echo 'active';} ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--Profile Area -->
            

        </div>
    </div>


    <!--JS-->
    <script src="../js/Jquery.min.js"></script>
    <script src="../js/Popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>
</html>