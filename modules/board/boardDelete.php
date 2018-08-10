<?php
    include '../../common/dbconn.php';

    $del = $_GET['del'];

    if(isset($_GET['postseq'])) {
        $postseq = $_GET['postseq'];
        $sql ="
            DELETE FROM 
                post 
            WHERE 
                postseq = $postseq
        ";
        mysqli_query($conn, $sql);
    } else {
        $checkList = $_POST['checkList'];
        foreach($checkList as $postseq) {
            if($_GET['del'] == 'true_delete') {
                $sql ="
                        DELETE FROM 
                            post 
                        WHERE 
                            postseq = $postseq
                ";
                mysqli_query($conn, $sql);
            } else {
                    $sql ="
                            UPDATE
                                post
                            SET
                                postDelNY=1 
                            WHERE 
                                postseq = $postseq
                    ";
                    mysqli_query($conn, $sql);    
            }
        }
    }

    Header("Location:boardList.php");

?>