<?php
    include_once('./components/db.php');
    class user {
        public $uid;
        public $name;
        public $status;
        public $admin;
    }
    function isloggedin() {
        global $connection;
        if (isset($_SESSION['uid'])) {
            $query = $connection->prepare("SELECT * FROM USERS WHERE UID = ?");
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $result = $query->get_result();
            $row = $result->fetch_assoc();
            $user=  new user();

            if(!$row) {
                session_unset();
                session_destroy();
                $user->status = FALSE;
                session_start();
                return $user;
            }
            
            $user->uid = $row['UID'];
            $user->name = $row['NAME'];
            $user->status = TRUE;
            $user->admin = $row['ADMIN'];

            return $user;
        } else {
            $user = new user();
            $user->status = FALSE;
            return $user;
        }
    }
?>