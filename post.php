<?php

    include("./components/db.php");
    $foundposts = false;
    $post = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM POSTS WHERE ID = $id";
        $result = $connection -> query($query);
       
        if($result->num_rows > 0) {
            $foundposts = true;
            $post = $result->fetch_assoc();
        }

    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/post.css">
    <link rel="stylesheet" href="./styles/nav.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>
    <title>
        <?php 
            echo $foundposts ? "POST | " . htmlspecialchars($post['title']) : "POST | Not Found";
        ?>
    </title>   
</head>
<body>
    <?php 
        $title = "POST | " . ($foundposts ? htmlspecialchars($post['title']) : "Not Found");
        include("./components/header.php"); ?>
    <?php
        if($foundposts && $post) {
            require_once './components/Parsedown.php';
            require_once './components/ParsedownExtra.php';
            require_once './components/ParsedownCheckbox.php';
            $parsedown = new ParsedownCheckbox();

            $content = $parsedown->text($post['content']);
    

    ?>

    <a href="./blog.php">Back to Blog</a>
    <div class="post">
        <h1><?php echo htmlspecialchars($post['title']) ?></h1>
        <p><em>By <?php echo htmlspecialchars($post['author']) ?> on <?php echo $post['created_at'] ?></em></p>
        <div><?php echo $content; ?></div>
    </div>
    <?php
        }
        else {
            echo "Post not found";
        }
    ?>
</body>
</html>
<script>hljs.highlightAll();</script>


