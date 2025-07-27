<?php
   session_start();
   include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include meta tags, title, and other head elements here -->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Voting System</b>
    </div>
  
    <div class="login-box-body">
        <p class="login-box-msg">Voting Registration</p>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="firstname" placeholder="Enter your FirstName" >
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="lastname" placeholder="Enter your LastName" >
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="voters_id" placeholder="Student's ID" >
                <span class="fa fa-id-card form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="Department" placeholder="Enter your Department" >
                <span class="fa fa-building form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="file" class="form-control" name="photo" placeholder="Upload Image" >
                <span class="fa fa-upload form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="register">
                        <i class="fa fa-sign-in"></i> Register
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php">Sign In here</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       <?php if (isset($_SESSION['status_code'])): ?>
           Swal.fire({
              icon: "<?php echo $_SESSION['status_code']; ?>",
              title: "<?php echo $_SESSION['status_title']; ?>",
              text: "<?php echo $_SESSION['status_text']; ?>"
            }).then(() => {
                <?php
                // Clear session variables after display
                unset($_SESSION['status_code']);
                unset($_SESSION['status_title']);
                unset($_SESSION['status_text']);
                ?>
            });
       <?php endif; ?>
    </script>

    <?php
        if(isset($_SESSION['errormessage'])){
            echo "
                <div class='callout callout-danger text-center mt20'>
                    <p>".$_SESSION['error']."</p> 
                </div>
            ";
            unset($_SESSION['errormessage']);
        }
    ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
