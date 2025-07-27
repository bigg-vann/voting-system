<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    $voter = checkInput($_POST['voter']);
    $password = checkInput($_POST['password']);

    if (empty($voter) || empty($password)) {
        $_SESSION["status_title"] = "Fill all fields!";
        $_SESSION["status_code"] = "warning";
        $_SESSION["status_text"] = "Fields empty!";
        header('Location: index.php');
        exit();
    } else {
        $sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
        $query = $conn->query($sql);

        if ($query->num_rows < 1) {
            $_SESSION["status_title"] = "Cannot find voter with the ID.";
            $_SESSION["status_code"] = "warning";
            $_SESSION["status_text"] = "Cannot find voter with the ID.";
            header('Location: index.php');
            exit();
        }

        $row = $query->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['voter'] = $row['id'];
            header('Location: home.php'); // Redirect to a secure page
            exit();
        } else {
            $_SESSION["status_title"] = "Incorrect password!";
            $_SESSION["status_code"] = "warning";
            $_SESSION["status_text"] = "The password you entered is incorrect.";
            header('Location: index.php');
            exit();
        }
    }
} else {
    $_SESSION["status_title"] = "Input voter credentials first.";
    $_SESSION["status_code"] = "warning";
    $_SESSION["status_text"] = "Input voter credentials first.";
    header('Location: index.php');
    exit();
}

function checkInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
