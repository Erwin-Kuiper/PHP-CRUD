<?php
    require_once 'classes/user.php';
    require_once 'classes/post.php';

    $post = new Post();
    $allPosts = $post->getAllPosts();

    $postsPerPage = 4; // Number of posts to display per page
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number from the URL, default is 1
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

    <section id="content">
    <?php
        $postCount = count($allPosts);
        $totalPages = ceil($postCount / $postsPerPage); // Calculate the total number of pages

        $start = ($currentPage - 1) * $postsPerPage; // Calculate the starting post index for the current page
        $limitedPosts = $post->getPaginatedPosts($start, $postsPerPage);

        foreach ($limitedPosts as $post) :
    ?>
        <article class="post">
            <h2 class="post-title"><?php echo $post['title']; ?></h2>
            <p class="post-description"><?php echo $post['description']; ?></p>
        </article>
    <?php endforeach; ?>

    <div class="pagination">
        <?php if ($currentPage > 1) : ?>
            <a href="?page=<?php echo ($currentPage - 1); ?>">Previous</a>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
            <a href="?page=<?php echo $page; ?>" <?php if ($currentPage == $page) echo 'class="active"'; ?>><?php echo $page; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages) : ?>
            <a href="?page=<?php echo ($currentPage + 1); ?>">Next</a>
        <?php endif; ?>
    </div>
</section>



    <footer>
        <?php
            include 'includes/footer.php';
        ?>
    </footer>
</body>

</html>