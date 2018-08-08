<?php
    class dbconn {
        function get_conn() {       
            $conn = mysqli_connect(
                "lxrb0tech2.csaf2qenttko.us-east-2.rds.amazonaws.com",
                "lxrb0tech2", 
                "luxrobo1!",
                "kiwi");
            return $conn;
        }
    }
?>