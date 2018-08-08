<?php
    include '../../query/connect.php';
    include '../../query/member/memberselect.php';
    include '../../view/board/uploadView.php';

    session_start();
    $id = $_SESSION['id'];
    $today = date("Y-m-d");

    $dbConnect = new connect();
    $conn = $dbConnect->get_conn();

    $member = new memberselect();
    $getmember = $member->select_memid($conn, $id);

     $board_view = new uploadView();
     $board_view->upload('', '', $getmember['memnickname'], $today);
    
?>