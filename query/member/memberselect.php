<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');

class memberselect {   
    function select_confirm($conn, $id, $pw) {  
        $query = "SELECT * FROM member WHERE memid = '$id' AND mempw = '$pw'";
        $result = $conn->query($query);
        return $result;
    } 

    function select_memid($conn, $id) {  
        $sql = "SELECT * FROM member WHERE memid = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return $row;
    }  

    function select_memseq($conn, $memseq) {  
        $sql = "SELECT * FROM member WHERE memseq = '$memseq'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return $row;
    }  
}  
?>  