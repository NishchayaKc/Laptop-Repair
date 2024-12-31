<?php
$con = new mysqli("localhost", "root", "", "laptop");

if ($con->connect_error) {
    die("Error in Connection: " . $con->connect_error);
}

if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    //access granted
    $id = (int)$_GET['ID']; //data type casting

    if ($id <= 0) {
        //cross checking if invalid id passed from url query e.g. id=asdjdas
        header('location: admin.php');
        exit;
    }

    //cross checking from if the error id value is passed from url query string e.g. id=13211513351
    $sql_1 = "SELECT * FROM user_info WHERE ID = " . $id;
    $query_1 = mysqli_query($con, $sql_1);

    //validates if there is data in a table or not.
    if (mysqli_num_rows($query_1) <= 0) {
        header('location: admin.php');
        exit;
    }

    $sql = "DELETE FROM user_info WHERE ID = " . $id;
    $query = mysqli_query($con, $sql);

    if ($query) {
        //success
        header('location: admin.php');
        exit;
    } else {
        header('location: admin.php');
        exit;
    }
} else {
    header('location: admin.php');
    exit;
}