<?php
    $melding = "";
    if(isset($_POST['submit'])) {
        require_once "classes/post.php";
        $post = new Post();
        $melding = $post->addPost($_POST);
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
        <?php
            echo $melding;
        ?>
        <article id="postForm">
            <!-- <h1>Create Post</h1> -->
            <form method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required><br>

                <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="5" required></textarea><br>

                <input type="submit" name="submit" value="submit">
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