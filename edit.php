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
        ?>
        <script type="text/javascript">
            alert("Id passed is invalid");
        </script>
        <?php
        header('location: admin.php');
        exit;
    }

    //old records from database tables are retrieved in order to display in the form
    $sql_1 = "SELECT * FROM user_info WHERE ID = " . $id;
    $query_1 = mysqli_query($con, $sql_1);

    //validates if there is data in a table or not.
    if (mysqli_num_rows($query_1) <= 0) {
        ?>
        <script type="text/javascript">
            alert("No data in database");
        </script>
        <?php
        header('location: select.php');
        exit;
    }

    //Retrieving a single row of existing data from a database table
    $old_data = mysqli_fetch_assoc($query_1);
} else {
    header('location: select.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="update.php?ID=<?php echo $old_data['ID']; ?>" method="POST" enctype="" name="form">

        Name: <input type="text" name="uname" value="<?php echo $old_data['FullName']; ?>"> <br><br>

        Email: <input type="email" name="uemail" value="<?php echo $old_data['Email']; ?>"> <br><br>

        Number: <input type="number" name="unum" value="<?php echo $old_data['Phone']; ?>"> <br><br>

        <input type="submit" value="Update">
    </form>
</body>

</html>