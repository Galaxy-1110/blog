<?php 
    session_start();
    include_once("./components/db.php");

    include("./components/alert.php");
    displayAlert();
    
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "Explore new posts";
        include("./components/header.php"); 
    ?>
    <?php
        $query = "SELECT POSTS.*, USERS.NAME AS AUTHOR
         FROM POSTS 
         JOIN USERS ON POSTS.AUTHORID = USERS.UID 
         ORDER BY CREATED_AT DESC";

        $result = $connection->query($query);
        if ($result->num_rows <= 0) {
            echo "<section class=\"nofind\">No posts found! <a href='create.php'>BE THE FIRST ONE TO CREATE</a></section>";
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

            $unf_content = $parsedown->text($row['CONTENT']);
            $content = strip_tags(html_entity_decode($unf_content));;
            $title = strip_tags(html_entity_decode($row['TITLE']));

            // DATE
            $date = new DateTime($row['CREATED_AT']);
    
            echo "
            <a href=\"post.php?id={$row['ID']}\">
                <div class=\"post\">
                    <div class=\"thumbnail\">
                        <img src=\"https://placeholder.co/400x200\" alr=\"POST THUMBNAIL\">
                        <span class=\"category\">Technology</span>
                    </div>
                    <div class=\"post-content\">
                        <div>
                            <h2>". ( strlen($title) > 30 ? substr($title, 0, 30) . "...." : $title) . "</h2>
                            <p>" . (strlen($content) > 60 ? substr($content, 0, 60) . "..... " : $content) . "</p>
                        </div>
                        <div class=\"meta\"><em>By {$row['AUTHOR']} on {$date->format('F j, Y')}</em></div>
                    </div>
                </div>
            </a>";
        }
   
        ?>
    </div>
</body>

</html>