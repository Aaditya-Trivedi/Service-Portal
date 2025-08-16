<nav class="col-sm-2 sidebar py-5 bg-outline-dark shadow">
                <div class="sidebar-sticky">
                    <ul class="nav-flex-column nav-underline"><!--nav-pills -->
                        <li class="nav-item list-group-item mt-3">
                            <a href="EmpProfile.php" class="nav-link <?php if(PAGE == 'Profile'){echo 'active';} ?>"><!--bg-dark-->
                            <i class="fas fa-user pl-2 me-2" ></i>Profile
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="WorkOrder.php" class="nav-link <?php if(PAGE == 'WorkOrder'){echo 'active';} ?>">
                           <!-- <i class="fab fa-accessible-icon "></i>-->
                           <i class="fa-regular fa-clipboard me-2"></i>WorkOrder
                            </a>
                        </li>

                        <li class="nav-item list-group-item mt-5">
                            <a href="EPChangePassword.php" class="nav-link <?php if(PAGE == 'Change Password'){echo 'active';} ?>">
                            <!--<i class="fas fa-user "></i>-->
                            <i class="fa-solid fa-eye me-2"></i>Change Password
                            </a>
                        </li>
                        <li class="nav-item list-group-item mt-5">
                            <a href="includes/Logout.php" class="nav-link ">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>