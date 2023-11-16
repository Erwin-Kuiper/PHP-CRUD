<?php
    require_once 'classes/user.php';
    require_once 'classes/post.php';

    $post = new Post();

    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $existingPost = $post->getPost($post_id);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update the post
        $post->updatePost($_POST, $post_id);
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
        <article id="postForm">
            <form method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $existingPost['title']; ?>" required><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo $existingPost['description']; ?>" required><br>

                <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="5" required><?php echo $existingPost['content']; ?></textarea><br>

                <input type="submit" name="submit" value="Update">
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