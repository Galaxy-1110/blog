<?php
    function alert($message, $type, $destination) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['alert'] = $message;
        $_SESSION['alert-type'] = $type;
        header("Location: $destination");
        exit();
    }
     
    function displayAlert() {
        if(isset($_SESSION['alert'])) {
            echo "
                <script>    
                    window.onload = function() {
                        showPopup('". $_SESSION['alert']. "', '" . $_SESSION['alert-type'] . "');
                    }
                 </script>
            ";
            unset($_SESSION['alert']);
            unset($_SESSION['alert-type']);
            
        }
    }
?>
