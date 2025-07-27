<?php
session_start();
 include 'includes/conn.php';
 


if(isset($_POST['register'])){

    $firstname = checkInput($_POST['firstname']);
    $lastname = checkInput($_POST['lastname']);
    $voters_id = $_POST['voters_id'];
    $Department = checkInput($_POST['Department']);
    $password = checkInput($_POST['password']);
    $cpassword = checkInput($_POST['cpassword']);
    $filename = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];


    if(empty($firstname) || empty($lastname) || empty($voters_id) || empty($Department) ||empty($password) || empty($cpassword) || empty($filename)){
        $_SESSION["status_title"] = "Fill all fields!";
        $_SESSION["status_code"] = "warning";
        $_SESSION["status_text"] = "Fields empty!.";
        echo "<script>window.location.href='registration.php';</script>";
    }elseif($password!=$cpassword){
        $_SESSION["status_title"] = "Passwords do not match!";
        $_SESSION["status_code"] = "warning";
        $_SESSION["status_text"] = "Passwords not the same!.";
        echo "<script>window.location.href='registration.php';</script>";
    }else{

        $sql = "SELECT * FROM voters WHERE voters_id='$voters_id'";
        $run_sql = mysqli_query($conn,$sql);
        if(mysqli_num_rows($run_sql)>0){
            $_SESSION["status_title"] = "Already Registered.";
            $_SESSION["status_code"] = "warning";
            $_SESSION["status_text"] = "You are registered already.";
            echo "<script>window.location.href='registration.php';</script>";
        }
        
        $enCrypt_password = password_hash($password, PASSWORD_BCRYPT );
        $insert = "INSERT INTO `voters`(`firstname`, `lastname`, `voters_id`, `Department`, `password`, `photo`) 
           VALUES ('$firstname','$lastname','$voters_id', '$Department','$enCrypt_password','$filename')";

        move_uploaded_file($tmp_name, "images/$filename");

        $insert_query = mysqli_query($conn,$insert);

        if($insert_query){
            $_SESSION["status_title"] = "Registration Successful";
            $_SESSION["status_code"] = "success";
            $_SESSION["status_text"] = "login";
            echo "<script>window.location.href='login.php';</script>";
        }else{
            $_SESSION["status_title"] = "Ooops!";
            $_SESSION["status_code"] = "error";
            $_SESSION["status_text"] = "Something is wrong.";
            echo "<script>window.location.href='registration.php';</script>";
        }
        


        
    }

}

function checkInput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);

    return $data;
}


function enCrypt_Pass($user){
    $user = md5($user);
    $user = sha1($user);
    $user = crypt($user,'tk');

    return $user;
}

?>
