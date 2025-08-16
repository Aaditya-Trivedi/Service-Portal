
<?php include('DBConnection.php');
    if(isset($_REQUEST['rSingup']))
    {   
            $rName = trim($_REQUEST['rName']);
            $rEmail = trim($_REQUEST['rEmail']);
            $rPassword = trim($_REQUEST['rPassword']);
        if($rName == "" || $rEmail == "" || $rPassword == "")
        {
            $smsg = '<div class="alert alert-danger" role="alert">
                            Fields must not contain blank spaces
                        </div>';  
        }
        else
        {
                //Cheking Email Already Registered or Not in DB
            $sql = "SELECT r_email FROM ragistration_tb WHERE r_email = '".$_REQUEST['rEmail']."'";
            $result = $conn->query($sql);
            if($result->num_rows!=0)
            {
                $smsg = '<div class="alert alert-danger" role="alert">
                        Email  is Already Registered
                        </div>';
            }
            else
            {//Registering Data
                $rName = $_REQUEST['rName'];
                $rEmail = $_REQUEST['rEmail'];
                $rPassword = $_REQUEST['rPassword'];
        
                $sql = "INSERT INTO ragistration_tb(r_name,r_email,r_password) VALUES('$rName','$rEmail',$rPassword)";
                $conn->query($sql);  
                $smsg = '<div class="alert alert-success" role="alert">
                            Account Created Successfully!!
                        </div>';
            }
        } 
    }        
?>

<div class="container pt-5 " id="Registration">
        <h2 class="text-center">Create an Account</h2>
        <div class="row mt-4 mb-4">
            <div class = "col-md-6 offset-3 ">
                <form action="" class="shadow-lg p-4 " method="post" >
                    <div class="form-group">
                        <i class="fas fa-user me-2"></i> 
                        <label for="name" class="font-weight-bold pl-2">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="rName" required >

                    </div>

                    <div class="form-group">
                        <i class="fa-regular fa-envelope me-2"></i>
                        <label for="email" class="font-weight-bold pl-2">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="rEmail" required>
                    </div>

                    <div class="form-group">
                        <i class="fa-solid fa-eye me-2"></i> 
                        <label for="pass" class="font-weight-bold pl-2">New Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password" name="rPassword" required>
                        <small class="form-text" >We'll never share your data with anyone else</small>
                        <div class="row">
                            <div class="showpassword_box col"><input type="checkbox" name="" id="checkbox" class="mx-2 my-2">Show Password</div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                    <Button type="submit" class="btn btn-info mt-5 shadow-sm font-weight-bold" name="rSingup" >Sign Up</Button>
                    </div>
                    <?php if(isset($smsg)){echo $smsg;}?>
                    <div>
                    <em style="font-size: 10px;">Note - By Clicking Sing Up, you agree to our Terms, Data Policy and Cookie Policy.</em>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let password = document.getElementById("password");
        let checkbox = document.getElementById("checkbox");

        checkbox.onclick = function()
        {
            if(checkbox.checked)
            {
                password.type = 'text';
            }
            else
            {
                password.type = 'password';
            }
        }
    </script>