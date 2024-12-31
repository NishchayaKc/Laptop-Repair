<?php
session_start();
$con = new mysqli("localhost", "root", "", "laptop");

if ($con->connect_error) {
    die("Error in Connection: " . $con->connect_error);
}


if (
    isset($_POST, $_POST['username'], $_POST['password']) && !empty($_POST['username']) &&
    !empty($_POST['password'])
) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $stmt = $con->prepare("SELECT * FROM admin WHERE Username = ?");
    $stmt->bind_param("s", $_POST['username']);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];
        $user=$row['Username'];

        if ($username == $user && $password == $hashed_password) {
            //success
            $_SESSION['is_logged_in'] = true; //data
            $_SESSION['success'] = "User logged in successfully.";
            $_SESSION['user']=$row['Username'];
            header('location: admin.php');
            exit;
        } else {
            $_SESSION['error'] = "Credentials did not match.";
            header('location: adminlogin.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Please login first.";
        header('location: adminlogin.php');
        exit;
    }
}
