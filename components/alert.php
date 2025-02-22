<?php
    function alert($message, $type, $destination) {
        $_SESSION['alert'] = $message;
        $_SESSION['alert-type'] = $type;
        header("Location: $destination");
        exit();
    }
     
    function displayAlert() {
        if(isset($_SESSION['alert'])) {
            echo "
                <script>
                 function showPopup(message, type) {
                    var popup = document.createElement('div');
                    popup.className = 'popup ' + type;
                    popup.innerHTML = '<p>' + message + '</p>';
                    document.body.appendChild(popup);
                    popup.classList.add('show');
                    

                    setTimeout(function() {
                        popup.classList.remove('show');
                        popup.classList.add('hide');
                        setTimeout(function() {
                            document.body.removeChild(popup);
                        }, 500);
                    }, 5000);

                }
                    
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

<style>
    .popup {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%); 
        background-color: #333;
        color: white;
        padding: 10px;
        border-radius: 5px;
        z-index: 1000000000;
        transition: opacity 0.5s ease-in-out;
    }
    .popup p {
        margin: 0;
    }
    .popup.success {
        background-color: green;
    }

    .popup.error {
        background-color: red;
    }
    .popup.show {
        opacity: 1;
    }
    .popup.hide {
        opacity: 0;
    }   

</style>
