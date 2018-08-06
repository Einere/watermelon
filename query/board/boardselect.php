<?php
    class boardselect {
        function get_list($conn) {       
            $sql = "SELECT * FROM post WHERE postdelny='0' ORDER BY postseq DESC";
            $result = mysqli_query($conn, $sql);
            return $result;
        }

        function get_detail($conn, $postseq){
            $sql = "SELECT * FROM post WHERE postseq = $postseq";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            return $row;
        }
    }
?>