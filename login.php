<?php
    $melding = "";
    if(isset($_POST['submit'])) {
        require_once "classes/user.php";
        $user = new User();
        $melding = $user->userLogin($_POST);
    }
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP Blog Opdracht">
    <meta name="author" content="Erwin Kuiper">
    <meta name="keywords" content="HTML, CSS, PHP, Blog">
    <title>Car Blog Login</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
    <header>
        <?php
            include 'includes/header.php';
        ?>
    </header>

    <?php
        echo $melding;
    ?>
    <section id="content">
        <article id="form">
            <form method="POST">
                Username:
                <input type="text" name="username" require><br><br>
                Password:
                <input type="password" name="password" require><br><br>
                <input type="submit" name="submit">
            </form>
        </article>
    </section>

    <footer>
        <?php
            include 'includes/footer.php';
        ?>
    </footer>
</body>

</html>