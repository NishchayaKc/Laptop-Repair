<?php
session_start();
if (isset($_SESSION, $_SESSION['is_logged_in']) && !empty($_SESSION['is_logged_in'])) {
    $_SESSION['success'] = "You are already logged in.";
    header('location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Laptop Repair Service</title>
    <link rel="stylesheet" href="adminlogin.css">
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <img src="DGTL.jpg" alt="Laptop Repair Logo" class="logo">
            <h1 style="color:white;">LOGIN As Admin!</h1>
            <?php
            if (isset($_SESSION, $_SESSION['error']) && !empty($_SESSION['error'])) {
                echo '<span style="color: red;">' . $_SESSION['error'] . '</span>';
                unset($_SESSION['error']); //session message has been deleted
            }
            ?>
        </div>
        <form action="adminloginprocess.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>