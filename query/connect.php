<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class connect {
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