<?php 
    session_start();
    include_once("./components/db.php");
    include("./components/alert.php");
    include_once('./components/isloggedin.php');
    $user = isloggedin();
   
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM POSTS WHERE ID = $id";
        $result = $connection -> query($query);
        if($result->num_rows > 0) {
            $post = $result->fetch_assoc();
            $author = $post['AUTHORID'];
            if(!$user->status || $user->uid != $author && $user->admin == FALSE) {
                alert("You are not permitted to do that!", "error", "./");
            }
        }
    }

    if (isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title']);
        $content = $_POST['content'];
        $query = $connection->prepare("UPDATE POSTS SET TITLE = ?, CONTENT = ? WHERE ID = ?");
        $query->bind_param("ssi", $title, $content, $id);

        if ($query->execute()) {
            alert("Post edited successfully", "success", "./post.php?id=$id");
        } else {
            echo "ERROR: " . $connection->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "Edit Your Post";
        include("./components/header.php"); 
    ?>
    <div class="container">
        <h1>Edit Your Blog Post</h1>
        <form method="POST" onsubmit="return validate()">
            <input type="text" name="title" id="title"placeholder="Title" required>
            
            <div id="content">
                <textarea id="markdown-editor" name="content" ></textarea>
                <span id="warn" >Content must be at least 120 characters long</span>
            </div>
            <input type="submit" name="submit" class="submit" value="Edit">
        </form>
        <div id="postContent" style="display:none;"><?php echo htmlspecialchars($post['CONTENT']); ?></div>
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
        var postContent = document.getElementById('postContent').innerText;
        easyMDE.value(postContent);
        document.getElementById("title").value = "<?php echo htmlspecialchars($post['TITLE']); ?>";
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