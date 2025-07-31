<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    $title = "Signup";
    include_once './components/header.php';
    include_once("./components/db.php");
    include("./components/alert.php");
    include_once("./components/isloggedin.php");

    $user = isloggedin();
    if($user->status) {
        alert("You are already logged in as " . $user->name, "error", "./");
    }
    displayAlert();
?>
<?php
    if(isset($_POST['signup'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = $_POST['password'];

        if( strlen($username) < 4 || strlen($username) > 20) {
            alert("Username must be between 4 and 20 characters", "error", "signup.php");
        
        }

        if( strlen($password) < 8 || strlen($password) > 20) {
            alert("Password must be between 8 and 20 characters", "error", "signup.php");
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $connection->prepare("SELECT * FROM USERS WHERE NAME = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if($result->num_rows > 0) {
            alert("Username already exists", "error", "signup.php");
        }

        $query = $connection->prepare("INSERT INTO USERS (NAME, PASSWORD) VALUES (?, ?)");
        $query->bind_param("ss", $username, $password);

        if($query->execute()) {
            alert("Account created successfully", "success", "login.php");
        } else {
            alert("Error creating account", "error", "signup.php");
        }
    }
?>

    <div class="container" name=>
        <h1>Signup</h1>
        <form method="post">
            <div class="form-group">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
            </div>
            
            <button type="submit" name="signup">Signup</button>
            <p class="blur">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

    
</body>
</html>