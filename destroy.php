<?php
include_once("./components/alert.php");
   session_start();
   session_unset(); 
   session_destroy(); 
   session_start();
   alert("You have been logged out", "success", "./");
?>