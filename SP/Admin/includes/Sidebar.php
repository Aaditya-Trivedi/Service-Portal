
            
<!--Side Bar -->     
<nav class="col-sm-2 sidebar py-5 bg-outline-dark shadow d-print-none mt-5" >
   <div class="sidebar-sticky" >
       <ul class="nav-flex-column nav-underline"><!--nav-pills -->
            <li class="nav-item list-group-item mt-2">
              <a href="Dashboard.php" class="nav-link <?php if(PAGE == 'dashboard'){echo 'active';} ?>"><!--bg-dark-->
              <i class="fas fa-user pl-2 me-2" ></i>Dashboard
              </a>
            </li>
                        
            <li class="nav-item list-group-item mt-5">
                <a href="Inquiries.php" class="nav-link <?php if(PAGE == 'Inquiries'){echo 'active';} ?>">
                
                <i class="fa-solid fa-list-check me-2 "></i>Inquiries
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="Requests.php" class="nav-link <?php if(PAGE == 'Requests'){echo 'active';} ?>">
            <!--<i class="fas fa-user "></i>-->
                    <i class="fa-solid fa-list-check me-2 "></i>Requests
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="RejectedRequests.php" class="nav-link <?php if(PAGE == 'RejectedRequests'){echo 'active';} ?>">
            <!--<i class="fas fa-user "></i>-->
                    <i class="fa-solid fa-list-check me-2 "></i>Rejected Requests
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
             <a href="WorkOrder.php" class="nav-link <?php if(PAGE == 'WorkOrder'){echo 'active';} ?>">
            <!-- <i class="fab fa-accessible-icon "></i>-->
            <i class="fa-regular fa-clipboard me-2"></i>Work Order
             </a>
            </li>

            <li class="nav-item list-group-item mt-5">
                <a href="Technicians.php" class="nav-link <?php if(PAGE == 'Technicians'){echo 'active';} ?>">
                <!--<i class="fas fa-user "></i>-->
                <i class="fa-solid fa-users-gear me-2"></i>Technicians
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="Requester.php" class="nav-link <?php if(PAGE == 'Requester'){echo 'active';} ?>">
                <!--<i class="fas fa-user "></i>-->
                <i class="fa-solid fa-user-group me-2"></i>Requester
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="ServiceProduct.php" class="nav-link <?php if(PAGE == 'ServiceProduct'){echo 'active';} ?>">
                
                <i class="fa-solid fa-screwdriver-wrench me-2 "></i>Service Product
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="WorkReport.php" class="nav-link <?php if(PAGE == 'WorkReport'){echo 'active';} ?>">
                <!--<i class="fas fa-user "></i>-->
                <i class="fa-solid fa-list-check me-2 "></i>Work Report
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="ChangePassword.php" class="nav-link <?php if(PAGE == 'ChangePassword'){echo 'active';} ?>">
                <!--<i class="fas fa-user "></i>-->
                <i class="fa-solid fa-eye me-2"></i>Change Password
                </a>
            </li>
            <li class="nav-item list-group-item mt-5">
                <a href="../user/Logout.php" class="nav-link <?php if(PAGE == 'Logout'){echo 'active';} ?>">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>