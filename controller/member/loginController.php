<?php 
    include '../../query/connect.php';
    include '../../query/member/memberselect.php';
    $dbConnect = new connect();
    $conn = $dbConnect->get_conn();
    
    $login = new memberselect();
    $result = $login->select_confirm($conn, $_POST['id'], $_POST['pw']);

    if($result->num_rows == 1) { // 로그인 성공
        session_start();
        $_SESSION['id']=$_POST['id'];
        echo "<script>alert(\"로그인에 성공하였습니다.\");
        location.replace('../../view/board/listView.php');</script>";
    } else { // 로그인 실패 
        echo "<script>alert(\"로그인에 실패하였습니다.\");
        location.replace('../../view/member/loginView.php');</script>";
    }
?>