<?php
include("./components/db.php");

$query = "CREATE TABLE IF NOT EXISTS USERS (
    UID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ADMIN BOOLEAN DEFAULT FALSE
)";
$connection->query($query);

echo "Table USERS created successfully<br>";
$query = "CREATE TABLE IF NOT EXISTS POSTS (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    TITLE VARCHAR(255) NOT NULL,
    CONTENT TEXT NOT NULL,
    AUTHORID INT NOT NULL,
    CREATED_AT TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (AUTHORID) REFERENCES USERS(UID) ON DELETE CASCADE
)";
$connection->query($query);
$password = password_hash("admin", PASSWORD_DEFAULT);
echo "Table POSTS created successfully<br>";
$query = "INSERT INTO USERS (NAME, PASSWORD, ADMIN) VALUES ('admin', '$password', TRUE)";
$connection->query($query);

echo "Admin user created successfully<br>";
$query = "INSERT INTO POSTS (TITLE, CONTENT, AUTHORID) VALUES ('Hello World', 'Welcome to my blog', 1)";
$connection->query($query);

echo "Hello World post created successfully<br>";

echo "<script> setTimeout(function() {window.location = \"index.php\"},3000) </script>"
?>