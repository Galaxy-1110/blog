<?php 
 include("./components/db.php");

if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);   
    $content = $_POST['content']; 
    $author = htmlspecialchars($_POST['author']);

    $query = $connection->prepare("INSERT INTO POSTS (TITLE, CONTENT, AUTHOR) VALUES (?, ?, ?)");
    $query->bind_param("sss", $title, $content, $author);

    if ($query->execute()) {
        header("Location: ./blog.php");
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
            <input type="text" name="author" placeholder="Author" required>
            <div id="content">
                <span id="warn" >Content must be at least 120 characters long</span>
                <textarea id="markdown-editor" name="content" ></textarea>
            </div>
            <input type="submit" name="submit" value="Create">
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