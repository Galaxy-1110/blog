<!DOCTYPE html>
<html lang="en">
    <?php
        include_once("./components/db.php");
        session_start();
        $title = "Home";
        include("./components/header.php"); 
        include("./components/alert.php");
        displayAlert();

    ?>
    <section class="hero">
        <h1>Exploring the World, One Blog Post at a Time</h1>
        <p>Sharing stories, tips, and lessons from a curious mind.</p>
        <a href="./blog.php"><button>Explore the Blog</button></a>
         <img src="./images/globe.gif" alt="like" class="i1" />
    </section>
</body>

</html>