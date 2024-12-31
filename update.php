<?php
$con = new mysqli("localhost", "root", "", "laptop");

if ($con->connect_error) {
    die("Error in Connection: " . $con->connect_error);
}

$sql = "UPDATE user_info
        SET
        FullName = '" . $_POST['uname'] . "', 
        Email = '" . $_POST['uemail'] . "', 
        Phone = '" . $_POST['unum'] . "'
        
        WHERE ID = " . $_GET['ID'];

//executing a query in database
$query = mysqli_query($con, $sql);

if ($query) {
    //success
    header('location: admin.php');
    exit;
} else {
    echo mysqli_error($con);
}