<?php include("./components/db.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Homepage</title>
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/nav.css" />
</head>

<body>
    <?php include("./components/nav.php"); ?>
    <section class="hero">
        <h1>Exploring the World, One Blog Post at a Time</h1>
        <p>Sharing stories, tips, and lessons from a curious mind.</p>
        <a href="./blog.php"><button>Explore the Blog</button></a>
         <img src="./images/globe.gif" alt="like" class="i1" />
        <!-- <img src="./images/like.svg" alt="like" class="i1" />
        <img src="./images/laptop.png" alt="post" class="i2" /> -->
    </section>
</body>

</html>