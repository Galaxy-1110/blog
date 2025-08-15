<?php
    session_start();
    include("./components/db.php");

    include("./components/alert.php");
    displayAlert();
    

    $foundposts = false;
    $post = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT POSTS.*, USERS.NAME AS AUTHOR
         FROM POSTS 
         JOIN USERS ON POSTS.AUTHORID = USERS.UID
         WHERE ID = $id";
        $result = $connection -> query($query);
       
        if($result->num_rows > 0) {
            $foundposts = true;
            $post = $result->fetch_assoc();
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "POST | " . ($foundposts ? htmlspecialchars($post['TITLE']) : "Not Found");
        $easyMDE = true;
        include("./components/header.php"); ?>
    <?php
        if($foundposts && $post) {
            require_once './components/Parsedown.php';
            require_once './components/ParsedownExtra.php';
            require_once './components/ParsedownCheckbox.php';
            $parsedown = new ParsedownCheckbox();

            $content = $parsedown->text($post['CONTENT']);
    

    ?>

    <a href="./blog.php">Back to Blog</a>
    <div class="post">
        <h1><?php echo htmlspecialchars($post['TITLE']) ?></h1>
        <p><em>By <?php echo htmlspecialchars($post['AUTHOR']) ?> on <?php echo $post['CREATED_AT'] ?></em></p>
        <div><?php echo $content; ?></div>
        <?php
            include_once('./components/isloggedin.php');
            $user= isloggedin();
            if($user->status && $user->uid == $post['AUTHORID'] || $user->admin) {
                echo "<hr>";
                echo "<div class='actions'>";
                echo "<a href=\"edit.php?id={$post['ID']}\"><img title='EDIT' src=\"./images/edit.svg\" alt=\"Edit\" class=\"edit\"></a>";
                echo "<a href=\"delete.php?id={$post['ID']}\"><img title='DELETE' src=\"./images/delete.svg\" alt=\"Delete\" class=\"delete\"></a>";
                echo "</div>";

            }
        ?>

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


