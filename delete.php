<?php
    session_start();

    include("./components/alert.php");
    displayAlert();
    
    include_once('./components/isloggedin.php');
    $user = isloggedin();
    
    if(!$user->status) {
        alert("You are not permitted to do that!", "error", "./blog.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $connection->prepare("SELECT AUTHORID, ID FROM POSTS WHERE ID = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $post = $result->fetch_assoc();
        if($post['AUTHORID'] == $user->uid || $user->admin) {
            $query = $connection->prepare("DELETE FROM POSTS WHERE ID = ?");
            $query->bind_param("i", $id);
            if ($query->execute()) {
                alert("Post deleted successfully", "success", "./blog.php");
            } else {
                echo "ERROR: " . $connection->error;
            }
        } else {
            alert("You are not permitted to do that!", "error", "./blog.php");
        }   
    }
?>