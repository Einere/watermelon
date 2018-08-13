<?php
    include '../../common/dbconn.php';

    $today = date("Y-m-d H:i:s"); 
    $id = $_POST['id'];
    $posttitle = $_POST['posttitle'];
    $postcontent= $_POST['postcontent'];
    $memseq = $_POST['memseq'];
    $count = 0;
    $postseq = 0;
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
        $sql = "SELECT 
            COUNT(*),
            MAX(postseq)
        FROM
            post
        WHERE
            postDelNY = 0
        ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $count = $row['COUNT(*)'];
        $postseq = $row['MAX(postseq)'];
    } else {
        $postseq = $_GET['postseq'];
        $count = $_GET['count'];
        $sql = "UPDATE post 
                SET 
                    posttitle='$posttitle', 
                    postcontent='$postcontent' 
                WHERE 
                    postseq = '$postseq'
                ";
        mysqli_query($conn, $sql);
    }

    Header("Location:boardDetail.php?postseq=$postseq&count=$count");
?>