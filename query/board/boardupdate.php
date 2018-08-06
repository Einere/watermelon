<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');

class boardupdate {    
    function count_update($conn, $postseq, $count) {
        mysqli_query($conn, "
        UPDATE post SET postviewcount= $count WHERE postseq=$postseq
         ");

    } 

    function post_update($conn, $postseq, $posttitle, $postcontent, $postfile) {
        mysqli_query($conn, "
        UPDATE post SET posttitle = '$posttitle' WHERE postseq=$postseq;
         "); 

        mysqli_query($conn, "
        UPDATE post SET postcontent = '$postcontent' WHERE postseq=$postseq
         ");

        mysqli_query($conn, "
        UPDATE post SET postfile = '$postfile' WHERE postseq=$postseq
         ");

    } 

    function postdel_update($conn, $postseq){
        mysqli_query($conn, "
        UPDATE post SET postdelny = '1' WHERE postseq=$postseq;
        ");
    }
    
}  
?>  