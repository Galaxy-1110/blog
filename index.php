<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
        include_once("./components/db.php");
        $title = "Home";
        $easyMDE = false;
        include("./components/header.php"); 

        include("./components/alert.php");
        displayAlert();
    

    ?>
    <div class="hero">
        <div class="content">
            <h1 class="h1 cursor-hover-animate">Exploring the World,<br><span style="font-size: 0.8em;"> One Blog Post at a Time</span></h1>
            <p>Sharing stories, tips, and lessons from a curious mind.</p>

        </div>
        <a href="./blog.php"><button>Explore the Blog</button></a>
         <img src="./images/globe.gif" alt="like" class="i" height="700px" />
    </div>
</body>
</html>
<script>
    let text = document.querySelector('h1');

    text.addEventListener("mouseenter", (e) => {
        gsap.to(cursor, 0.2, { width: '150px' ,height: '150px', overwrite: "auto"})
    })
    text.addEventListener("mouseleave", (e) => {
        gsap.to(cursor, 0.2, {width: '20px', height: '20px', overwrite: "auto" })
    })
</script> 