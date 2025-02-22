<?php
include_once("./components/alert.php");
   session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
session_start();
alert("You have been logged out", "success", "./");
?>