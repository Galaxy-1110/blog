<?php 
    session_start();
    include_once("./components/db.php");
    include('./components/alert.php');
    displayAlert(); 
?>
<!DOCTYPE html>
<html lang="en">
    <?php 

        $title = "Explore new posts";
        include("./components/header.php"); 
    ?>
    <?php
        $query = "SELECT * FROM POSTS ORDER BY CREATED_AT DESC";
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
            echo "
            <a href=\"post.php?id={$row['ID']}\">
                <div class=\"post\">
                    <div class=\"content\">
                        <h2>{$row['TITLE']}</h2>
                        <p>" . (strlen($content) > 60 ? substr($content, 0, 56) . "..... " : $content) . "</p>
                    </div>
                    <span><em>By {$row['AUTHOR']} on {$row['CREATED_AT']}</em></span>
                </div>
            </a>";
        }
   
        ?>
    </div>
</body>

</html>