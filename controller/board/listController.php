<?php
    include '../../query/connect.php';
    include '../../query/member/memberselect.php';
    include '../../query/board/boardselect.php';
    include '../../view/board/listView.php';

    $dbConnect = new connect();
    $conn = $dbConnect->get_conn();

    $listquery = new boardselect();
    $list = $listquery->get_list($conn);

    $memseq = new memberselect();

    $nickname = array();
    foreach($list as $lt) {
        $row = $memseq->select_memseq($conn, $lt['member_memseq']);
        array_push($nickname, $row['memnickname']);
    }

     $list_view = new listView();
     $list_view->listShow($list, $nickname);    
?>