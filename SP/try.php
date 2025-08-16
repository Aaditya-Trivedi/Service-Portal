<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .animation-swipe-up {
      animation: swipe-up 0.5s forwards;
    }
    .animation-swipe-down {
      animation: swipe-down 0.5s forwards;
    }
    @keyframes swipe-up {
      from {
        transform: translateY(0);
      }
      to {
        transform: translateY(-100%);
        opacity: 0;
      }
    }
    @keyframes swipe-down {
      from {
        transform: translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div id="loginPage" class="row">
    <div class="col-md-6 offset-md-3">
      <h2>Login</h2>
      <form>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button id="forgotPasswordBtn" type="button" class="btn btn-info">Forgot Password?</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>

  <div id="forgetPasswordPage" class="row d-none">
    <div class="col-md-6 offset-md-3">
      <h2>Forget Password</h2>
      <form>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <button id="backToLoginBtn" type="button" class="btn btn-link">Back to Login</button>
        <button type="reset" class="btn btn-primary">Reset Password</button>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#forgotPasswordBtn").click(function(){
      $("#loginPage").addClass("animation-swipe-up");
      $("#forgetPasswordPage").removeClass("d-none");
    });

    $("#backToLoginBtn").click(function(){
        $("#forgetPasswordPage").hide();
    //   $("#forgetPasswordPage").addClass("animation-swipe-down");
      $("#loginPage").removeClass(" d-none").addClass("animation-swipe-down");
    });
  });
</script>

</body>
</html>