<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');

class memberinsert {    
    function mem_insert($conn, $id, $pw, $firstname, $lastname, $birth, $addr, $nickname, $agree) {  
        mysqli_query($conn, "
        INSERT INTO member
        (memid, mempw, memfirstname, memlastname, membirth, memaddr, memnickname, memagree)
        VALUES(
        '$id', '$pw', '$firstname', '$lastname', '$birth', '$addr', '$nickname', '$agree')
         ");
    } 
    
    function email_insert($conn, $memseq, $email) {
        mysqli_query($conn, "
        INSERT INTO emaillist
        (member_memseq, eemail)
        VALUES(
        '$memseq', '$email')
         ");
    }

    function phone_insert($conn, $memseq, $phonenum) {
        mysqli_query($conn, "
        INSERT INTO phone
        (member_memseq, phphonenum)
        VALUES(
        '$memseq', '$phonenum')
         ");
    }
}  
?>  