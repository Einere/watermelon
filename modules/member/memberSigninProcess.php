<?php
    include '../../common/dbconn.php';

    //넘어온 데이터 저장
    $id = $_POST['memid'];
    $pw = $_POST['mempw'];
    $cpw = $_POST['memcpw'];
    $firstname = $_POST['memfirstname'];
    $lastname = $_POST['memlastname'];
    $birth = $_POST['membirth'];
    $addr = $_POST['memaddr'];
    $nickname = $_POST['memnickname'];
    $email = $_POST['eemail']; 
    $email2 = $_POST['eemail2']; 
    $phonenum = $_POST['phphonenum']; 
    $phonenum2 = $_POST['phphonenum2'];
    $agree = $_POST['memagree'];

    //id duplication check
    $sql = "SELECT * FROM member WHERE memid='$id'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);    
    if($count != 0){
        echo "<script>alert(\"아이디가 존재합니다\");location.replace('./memberSigninView.php');</script>";
    }
    
    //email duplication check
    $sql = "SELECT * FROM emaillist WHERE eemail='$email'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count!=0){
        echo "<script>alert(\"이메일이 이미 존재합니다\");location.replace('./memberSigninView.php');</script>";
    }

    if(strlen($email2)!=0){
        $sql = "SELECT * FROM emaillist WHERE eemail='$email2'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count!=0){
            echo "<script>alert(\"이메일이 이미 존재합니다\");location.replace('./memberSigninView.php');</script>";
        }
    }
    
    //phone duplication check
    $sql = "SELECT * FROM phone WHERE phphonenum='$phonenum'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count!=0){
        echo "<script>alert(\"전화번호가 이미 존재합니다\");location.replace('./memberSigninView.php');</script>";
    }
    
    //phone duplication check
    if(strlen($phonenum2)!=0){
        $sql = "SELECT * FROM phone WHERE phphonenum='$phonenum2'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count!=0){
            echo "<script>alert(\"전화번호가 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
        }
    }

    //nickname duplication check
    $sql = "SELECT * FROM member WHERE memnickname='$nickname'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count!=0){
        echo "<script>alert(\"닉네임이 이미 존재합니다\");location.replace('../../view/member/signinView.php');</script>";
    }

    // if($agree != "agree"){
    //     echo "<script>alert(\"동의해주세요\");location.replace('../../view/member/signinView.php');</script>";
    // }
    // else{
    //     $agree = 1;
    // }
    
    //data insert
    mysqli_query($conn, "
    INSERT INTO member
    (memid, mempw, memfirstname, memlastname, membirth, memaddr, memnickname, memagree)
    VALUES(
    '$id', '$pw', '$firstname', '$lastname', '$birth', '$addr', '$nickname', '$agree')
    ");

    $sql = "SELECT * FROM member WHERE memid = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $memseq = $row['memseq'];

    //email insert
    mysqli_query($conn, "
        INSERT INTO emaillist
        (member_memseq, eemail)
        VALUES(
        '$memseq', '$email')
        ");
    if($email2!=NULL){
        mysqli_query($conn, "
        INSERT INTO emaillist
        (member_memseq, eemail)
        VALUES(
        '$memseq', '$email2')
        ");
    }
    
    //phone insert
    mysqli_query($conn, "
        INSERT INTO phone
        (member_memseq, phphonenum)
        VALUES(
        '$memseq', '$phonenum')
        ");
    if($phonenum2!=NULL){
        mysqli_query($conn, "
        INSERT INTO phone
        (member_memseq, phphonenum)
        VALUES(
        '$memseq', '$phonenum2')
        ");
    }
    
    echo "<script>alert(\"회원가입 되었습니다!\"); location.replace('../../modules/board/boardList.php');</script>";
?>