<?php
    $con = new mysqli("localhost", "root", "", "laptop");

    if ($con->connect_error) {
        die("Error in Connection: " . $con->connect_error);
    }

    if (isset($_POST['submit'])) {  
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $stmt = $con->prepare("INSERT INTO user_info (FullName, Email, Phone, Password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $password);

        // Execute Query
        if ($stmt->execute()) {
            ?>
            <script type="text/JavaScript">  
            window.alert ("You have successfully signed up"); 
            </script>
            <?php
            header("location: login.html");
            exit;
        } else {
            echo "Your data is not inserted: " . $stmt->error;
        }

        // Close the Statement
        $stmt->close();
    }

    // Close Connection
    $con->close();
?>
