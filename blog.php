<?php include("./components/db.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Discover Blogs</title>
    <link rel="stylesheet" href="./styles/blog.css" />
    <link rel="stylesheet" href="./styles/nav.css" />
</head>

<body>
    <?php include("./components/nav.php"); ?>
    <?php
        $query = "SELECT * FROM POSTS ORDER BY CREATED_AT DESC";
        $result = $connection->query($query);
        if ($result->num_rows <= 0) {
            echo "No posts found <a href='create.php'>BE THE FIRST ONE TO CREATE</a>";
            return;
        }

    ?>
    <div class="posts">

        <?php
        while ($row = $result->fetch_assoc()) {
            require_once './components/Parsedown.php';
            require_once './components/ParsedownExtra.php';
            require_once './components/ParsedownCheckbox.php';
            $parsedown = new ParsedownCheckbox();

            $unf_content = $parsedown->text($row['content']);
            $content = html_entity_decode(strip_tags($unf_content));
            echo
            "<a href=\"post.php?id={$row['id']}\">
                 <div class=\"post\">
                    <div class=\"content\">
                        <h2>{$row['title']}</h2>
                        <p>" . (strlen($content) > 60 ? substr($content, 0, 56) . "..... " : $content) . "</p>
                    </div>
                    <span><em>By {$row['author']} on {$row['created_at']}</em></span>
                </div>
            </a>";
        }
   
        ?>
    </div>
</body>

</html>