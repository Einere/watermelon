<?php  

class boardinsert {    
    function post_insert($conn, $memseq, $title, $content, $file) {
        $today = date("Y-m-d H:i:s"); 
        mysqli_query($conn, "
        INSERT INTO post
        (member_memseq, posttitle, postcontent, posttime, postfile)
        VALUES(
        '$memseq','$title', '$content', '$today', '$file')
         ");
    } 
    
}  
?>  