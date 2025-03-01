<?php 
    session_start();
    include_once("./components/db.php");
    include("./components/alert.php");
    include_once('./components/isloggedin.php');
    $user = isloggedin();
    if(!$user->status) {
        alert("You must be logged in to create a post", "error", "./login.php");
    }
    $author = $user->name;

    if (isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title']);   
        $content = $_POST['content']; 
        $query = $connection->prepare("INSERT INTO POSTS (TITLE, CONTENT, AUTHORID) VALUES (?, ?, ?)");
        $query->bind_param("ssi", $title, $content, $user->uid);

        if ($query->execute()) {
            alert("Post created successfully", "success", "./blog.php");
        } else {
            echo "ERROR: " . $connection->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "Create a New Blog Post";
        include("./components/header.php"); 
    ?>
    <div class="container">
        <h1>Create a New Blog Post</h1>
        <form method="POST" onsubmit="return validate()">
            <input type="text" name="title" placeholder="Title" required>
            
            <div id="content">
                <textarea id="markdown-editor" name="content" ></textarea>
                <span id="warn" >Content must be at least 120 characters long</span>
            </div>
            <input type="submit" name="submit" class="submit" value="Create">
        </form>
    </div>

    <script>
        var easyMDE = new EasyMDE({  
            element: document.getElementById("markdown-editor"), 
            placeholder: "Enter what's on your mind", 
            toolbar: ["bold", "italic", "strikethrough", "heading", "|", "code", "quote", "unordered-list", "ordered-list", "|", "link", "image", "table", "horizontal-rule", "|", "preview", "side-by-side",  "|", "guide", "|", "undo", "redo"],
            spellChecker: false,
            sideBySideFullscreen: false,
            renderingConfig: {
                codeSyntaxHighlighting: true,
            }
        });
        function validate() {
            var content = easyMDE.value().length;
            if(content < 120) {
                document.getElementById("warn").classList.add("show");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>