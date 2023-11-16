<?php
    require_once 'classes/user.php';
    require_once 'classes/post.php';

    $post = new Post();
    $user_id = $_SESSION['user_id'];
    $userPosts = $post->getUserPosts($user_id);
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
            <h1>Create new post</h1>
            <button onclick="location.href='createPost.php'" type="button">add new post</button>
        </article>
        <article>
            <h1>Your Posts</h1>
            <table id="postTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Edit post</th>
                        <th>Delete post</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userPosts as $post) : ?>
                        <tr>
                            <td><?php echo $post['title']; ?></td>
                            <td><?php echo $post['description']; ?></td>
                            <td><?php echo $post['created_on'] ?></td>
                            <td><?php echo "<a href='editPost.php?id=".$post['id']."'>Edit Post</a>"; ?></td>
                            <td><?php echo "<a href='deletePost.php?id=".$post['id']."'>Delete Post</a>"; ?></td>
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