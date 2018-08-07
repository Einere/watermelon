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
        Header("Location:../../view/board/listView.php");        
    } else { // 로그인 실패 
        
        Header("Location:../../view/member/loginView.php");
    }
?>