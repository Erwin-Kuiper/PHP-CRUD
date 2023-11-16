<?php
    require_once './classes/user.php';
?>

<link rel="stylesheet" href="./css/header.css">

<section id="header">
    <article>
        <a href="./index.php"><img src="./images/Logo.png" alt="Car Blog Logo"></a>
    </article>
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<nav id="navAdmin">';
            // User is logged in
            echo '<a href="./manageUsers.php">Manage Users</a>';
            echo '<a href="./managePost.php">Manage Posts</a>';
            echo '<a href="./logout.php">Logout</a>';

            echo '</nav>';
        } else {
            echo '<nav id="navUser">';
            // User is not logged in
            echo '<a href="./login.php">Login</a>';

            echo '</nav>';
        }
        ?>
</section>