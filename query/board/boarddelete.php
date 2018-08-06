<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');

class boarddelete {    
    function post_delete($conn, $postseq) {
        mysqli_query($conn, "
        DELETE FROM post WHERE postseq = $postseq
         ");
    } 
    
}  
?>  