<?php
    include '../../common/dbconn.php';

    $today = date("Y-m-d H:i:s"); 
    $id = $_POST['id'];
    $posttitle = $_POST['posttitle'];
    $postcontent= $_POST['postcontent'];
    $memseq = $_POST['memseq'];

    if($_GET['name'] =='Upload') {
        $sql = "INSERT INTO post(
                    member_memseq, 
                    posttitle, 
                    postcontent, 
                    posttime, 
                    postfile
                )
                VALUES ( 
                    $memseq,
                    '$posttitle', 
                    '$postcontent', 
                    '$today', 
                    ''
                )";

        mysqli_query($conn, $sql);
    } else {
        $postseq = $_GET['postseq'];
        $sql = "UPDATE post 
                SET 
                    posttitle='$posttitle', 
                    postcontent='$postcontent' 
                WHERE 
                    postseq = '$postseq'
                ";
        mysqli_query($conn, $sql);
    }
    Header("Location:boardList.php");
?>