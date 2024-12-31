<?php
$con = new mysqli("localhost", "root", "", "laptop");

if ($con->connect_error) {
    die("Error in Connection: " . $con->connect_error);
}

if (isset($_POST['login'])) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM user_info WHERE Phone = ?");
    $stmt->bind_param("s", $phone);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        if ($password === $hashed_password) {  
            header("location: home.html");
            $name=$row['FullName'];
            echo "Login successful. Welcome, $name!";
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid credentials.";
    }

    // Close the statement
    $stmt->close();
}

// Close connection
$con->close();
?>
