<?php
    include '../../common/dbconn.php';
    $dbconnect = new dbconn();
    $conn = $dbconnect->get_conn();

    $today = date("Y-m-d H:i:s"); 
    $id = $_POST['id'];
    $posttitle = $_POST['posttitle'];
    $postcontent= $_POST['postcontent'];
    $sql = "SELECT * 
            FROM 
                member 
            WHERE 
                memid = '$id'
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $memseq = $row['memseq'];

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
?>