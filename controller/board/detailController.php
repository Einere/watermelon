<?php
    include '../../query/connect.php';
    include '../../query/member/memberselect.php';
    include '../../query/board/boardselect.php';
    include '../../query/board/boardupdate.php';
    include '../../view/board/listView.php';
    include '../../view/board/detailView.php';

    $id = $_GET['id'];
    $postseq = $_GET['postseq'];
    $count = $_GET['count'];

    $dbConnect = new connect();
    $conn = $dbConnect->get_conn();

    $detail = new boardselect();
    $post = $detail->get_detail($conn, $postseq);

 
    $member = new memberselect();
    $result = $member->select_memseq($conn, $post['member_memseq']);
    $nickname = $result['memnickname'];
    $post['postviewcount']++;
    $result = $member->select_memid($conn, $id);
    $login = $result['memnickname'];

    $board = new boardupdate();
    $board->count_update($conn, $postseq, $post['postviewcount']);

    $board_view = new detailView();
    $board_view->detailShow($count, $nickname, $login, $post);
    
?>