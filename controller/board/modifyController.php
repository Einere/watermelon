<?php
    include '../../query/connect.php';
    include '../../query/board/boardselect.php';
    include '../../view/board/uploadView.php';

    session_start();
    $id = $_SESSION['id'];
    $postseq = $_GET['postseq'];
    $nickname = $_GET['nickname'];

    $dbConnect = new connect();
    $conn = $dbConnect->get_conn();

    $detail = new boardselect();
    $post = $detail->get_detail($conn, $postseq);

     $board_view = new uploadView();    
?>