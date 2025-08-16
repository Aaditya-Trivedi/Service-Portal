<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/all.min.css">
<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 100px;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: all 0.3s ease-in-out;
    }

    .forgot-password-form {
        display: none;
        flex-direction: column;
        align-items: center;
        transition: all 0.3s ease-in-out;
    }

    .swipe-up {
        transform: translateY(-100%);
    }

    .swipe-down {
        transform: translateY(-0%);
    }
</style>
</head>
<body>

<div class="container">
    <div class="login-form">
        <h2>Login</h2>
        <form>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="mt-3">Forgot your password? <a href="#" id="forgot-password-link">Click here</a></p>
        </form>
    </div>
    
    <div class="forgot-password-form">
        <h2>Forgot Password</h2>
        <form>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <p class="mt-3">Remember your password? <a href="#" id="back-to-login-link">Back to Login</a></p>
        </form>
    </div>
</div>

<script src="js/Jquery.min.js"></script>
    <script src="js/Popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
<script>
    $(document).ready(function() {
        $("#forgot-password-link").click(function(e) {
            e.preventDefault();
            $(".login-form").addClass("swipe-up");
            $(".forgot-password-form").addClass("swipe-up");
            $(".forgot-password-form").fadeIn(500);
        });

        $("#back-to-login-link").click(function(e) {
            e.preventDefault();
            $(".login-form").removeClass("swipe-up");
            $(".forgot-password-form").removeClass("swipe-up");
            $(".forgot-password-form").fadeOut(500);
        });
    });
</script>

</body>
</html>