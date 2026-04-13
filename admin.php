<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "portfolio");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // must match how it's stored

    $sql    = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login success
        $_SESSION['admin'] = $username;
        header("Location: contact_management.php");
        exit();
    } else {
        // Login failed
        $error = "Invalid username or password.";
    }
}

$current_page = 'admin';
$page_title   = 'Admin Login';
require 'header.php';
?>

<div class="admin-login">
    <h2 class="admin-title">Admin Login</h2>
    <p class="admin-desc">Login page for the owner of this website. :)</p>

    <?php if (!empty($error)): ?>
        <p style="color: var(--danger); font-size: 0.9rem; margin-bottom: 1rem;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="admin.php" method="post" class="admin-form">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

<?php require 'footer.php'; ?>