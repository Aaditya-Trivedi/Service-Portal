<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <script type="text/javascript">
        window.history.forward();
    </script> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

    <title>Service Portal</title>
</head>
<body>
    <!--Navbr-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark pl-10 fixed-top  " >
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Service Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#AboutUs">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user/UserLogin.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Contact">Contact</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Welcome to Service Portal!!
                </span>
            </div>
        </div>
    </nav>
    <!--Header img-->
    <header class="back-image" style="background-image:url(img/hand.jpeg); " id="Home">
        <div class="Headtext text-center position-absolute top-50 start-50 translate-middle">
            <h1 class="text-uppercase text-warning font-weight-bold ">
                Welcome To Service Portal!!
            </h1>
            <p class="subimg text-light">Customer's Satisfaction is our Aim</p>
            <a href="user/UserLogin.php" class="btn btn-danger mr-4">Login</a>
            <a href="#Registration" class="btn btn-info mr-4">Sign Up</a>
        </div>
        <br>
        <br>
    </header>
    <br>
        <br>
    <hr>
    <!--About-->
    <div class="container pt-5" id="AboutUs">
        <div class="jumbotron" >
            <h2 class="text-center">About Us</h2>
            <p class="lh-base">
            Our Hardware Service Portal is designed to provide you with swift, efficient,
             and comprehensive services for all your hardware needs. 
            Catering to both individuals and businesses, we specialize in servicing a
             broad spectrum of hardware - from desktop computers and laptops to servers
             and network components. 
            Our portal is your go-to resource for maintenance, repairs, upgrades, and
             consultations on hardware-related requirements.

            </p>

        </div>
        <br>
    </div>
    <hr>
    <!--Registration Form -->
        <?php include('registration.php')?>
        <hr>
     <!--Contect US Form-->
     
     <div class="container-fluid bg-info text-light pt-5" id="Contact">
        <h2 class="text-center mb-4 ">Contact US</h2>
        <div class="row text-center">
            <!--Start First Col (form)-->
            <?php include('ContectUs.php')?>
            <!--Start Second Col-->
           
        </div>
     </div>
     <hr>
     <!--Start Footer-->
     <footer class="container-fluid bg-dark text-white ">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-6">
                    <span class="pr-2">Follow Us:</span>
                    <a href="#" target="_blank" class="pr-2 fi-color "><i class="fab fa-facebook "></i></a>
                    <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
                </div>
                <div class="col-md-6 text-sm-end">
                    <small>Service Portal By 21BCA075-Vrunda Patel || </small>
                    <small>21BCA082-Aayushi Modi || </small>
                    <small>21BCA089-Aditya Trivedi</small>
                    
                </div>
            </div>

        </div>
     </footer>

    <!--JS-->
    <script src="js/Jquery.min.js"></script>
    <script src="js/Popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>
