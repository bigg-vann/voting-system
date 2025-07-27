<?php
    session_start();
    if(isset($_SESSION['admin'])){
        header('location: admin/home.php');
    }

    if(isset($_SESSION['voter'])){
        header('location: home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Voting System</b>
    </div>
  
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="voter" placeholder="Student's ID" >
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>
            </div>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-5">
            <p>Don't have an account? <a href="registration.php">Click here to register</a></p>
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
        if(isset($_SESSION['error'])){
            echo "
                <div class='callout callout-danger text-center mt20'>
                    <p>".$_SESSION['error']."</p> 
                </div>
            ";
            unset($_SESSION['error']);
        }
    ?>
</div>
    
<?php include 'includes/scripts.php'; ?>
</body>
</html>
