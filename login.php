<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
     $title = "Login";
     include_once('./components/header.php');
     include_once("./components/db.php");
     include_once("./components/alert.php");
     include_once("./components/isloggedin.php");

    $user = isloggedin();
    if($user->status) {
        alert("You are already logged in as " . $user->name, "error", "./");
    }
    displayAlert();
?>
    
<?php
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = $connection->prepare("SELECT * FROM USERS WHERE NAME = ?");
        $sql->bind_param("s", $username);
        if($sql->execute()) {
            $result = $sql->get_result();
            if($result->num_rows <=0) {
                alert("Invalid username or password", "error", "login.php");
            }
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['PASSWORD'])) {
                $_SESSION['uid'] = $row['UID'];
                alert("Login Successful!", "success", "./");
            } else {
                alert("Invalid username or password", "error", "login.php");
            }
        }   
    }
?>
    <body>
        <div class="container">
            <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="form-group">

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            </div>
            
            <button type="submit" name="login">Signup</button>
            
            <p class="blur">Don't have an account? <a href="signup.php">Sign up</a> here!</p>
        </form>
        </div>



</body>
</html>