<?php 
    include '../../common/dbconn.php';
    
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $sql = "SELECT * FROM member WHERE memid = $id AND mempw = $pw";
    $result = mysqli_query($conn, $sql);
    session_start();

    if(mysqli_num_rows($result) == 1) { // 로그인 성공 
        $_SESSION['id']=$_POST['id'];
        ?>
        <script>
            alert("로그인에 성공하였습니다.");
            window.opener.location.reload();
            window.close();
        </script>
        <?php

    } else { // 로그인 실패 
    ?>
        <script>
            alert("로그인에 실패하였습니다.");
            location.replace('memberLogin?print=Login.php');
        </script>
    <?php
    }
?>