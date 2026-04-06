<?php
$current_page = 'admin';
$page_title   = 'Admin Login';
require 'header.php';
?>

<div class="admin-login">
    <h1>Admin Login</h1>
    <form action="admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</div>

<?php require 'footer.php'; ?>