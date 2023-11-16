<?php
    require_once 'classes/user.php';
    require_once 'classes/post.php';

    $user = new User();
    $users = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP Blog Opdracht">
    <meta name="author" content="Erwin Kuiper">
    <meta name="keywords" content="HTML, CSS, PHP, Blog">
    <title>Car Blog Home</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
    <header>
        <?php
            include 'includes/header.php';
        ?>
    </header>

    <section id="mPosts">
        <article>
            <h1>Create new user</h1>
            <button onclick="location.href='register.php'" type="button">add user</button>
        </article>
        <article>
            <h1>Your Posts</h1>
            <table id="postTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Delete User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo "<a href='deleteUser.php?id=".$user['id']."'>Delete User</a>"; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    </section>

    <footer>
        <?php
            include 'includes/footer.php';
        ?>
    </footer>
</body>

</html>