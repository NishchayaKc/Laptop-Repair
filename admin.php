<?php
session_start();

$con = new mysqli("localhost", "root", "", "laptop");

if ($con->connect_error) {
    die("Error in Connection: " . $con->connect_error);
}

if (isset($_SESSION, $_SESSION['is_logged_in']) && !empty($_SESSION['is_logged_in'])) {
    echo $_SESSION['success'];
} else {
    $_SESSION['error'] = "You are not logged in. <br> Please Login first";
    header('location: adminlogin.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Laptop Repair System</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo-and-title">
            <img src="345.png" alt="Logo" class="logo">
            <span class="site-title">Laptop Repair And Services</span>
        </div>
        <div class="welcome-message">Welcome, <?php echo $_SESSION['user'] ?></div>
    </div>

    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="#view-users">View Users</a></li>
                <li><a href="#update-repair">Update Repair Status</a></li>
                <li><a href="#manage-users">Manage Users</a></li>
                <li><a href="#settings">Settings</a></li>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <section id="view-users" class="dashboard-section">
                <h3>View Users</h3>
                <table id="user-table" border="2">
                    <tr>
                        <th>ID.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM user_info";

                    $query = mysqli_query($con, $sql);
                    $i = 1;

                    if (mysqli_num_rows($query) <= 0) {
                        echo "No data found in table.";
                    } else {
                        while ($row = mysqli_fetch_assoc($query)) {

                    ?>
                            <tr>
                                <td><?php echo $i++ . "."; ?></td>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Phone']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </table>
            </section>

            <section id="update-repair" class="dashboard-section">
                <h3>Update Repair Status</h3>
                <form id="update-repair-form">
                    <label for="repair-id">Repair ID:</label>
                    <input type="text" id="repair-id" placeholder="Enter Repair ID" required>
                    <label for="repair-status">Status:</label>
                    <select id="repair-status">
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <button type="submit">Update Status</button>
                </form>
            </section>

            <section id="manage-users" class="dashboard-section">
                <h3>Manage Users</h3>
                <p>Manage user accounts and permissions here.</p>
                <table id="user-table" border="2">
                    <tr>
                        <th>ID.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM user_info";

                    $query = mysqli_query($con, $sql);
                    $i = 1;

                    if (mysqli_num_rows($query) <= 0) {
                        echo "No data found in table.";
                    } else {
                        while ($row = mysqli_fetch_assoc($query)) {

                    ?>
                            <tr>
                                <td><?php echo $i++ . "."; ?></td>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Phone']; ?></td>
                                <td>
                                    <a href="edit.php?ID=<?php echo $row['ID']; ?>">Edit</a>
                                    <a href="delete.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete your data?')">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </table>
            </section>

            <section id="settings" class="dashboard-section">
                <h3>Settings</h3>
                <p>Adjust admin panel settings here.</p>
            </section>
        </main>
    </div>

</body>

</html>