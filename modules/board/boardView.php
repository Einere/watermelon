<?php
    include '../../common/dbconn.php';

    session_start();
    //get clicked post information
    $loginId = '';
    if(isset($_SESSION['id']))
        $loginId = $_SESSION['id'];
    $postseq = $_GET['postseq'];
    $count = $_GET['count'];
    
    //select post tuple
    $sql = "SELECT * FROM post, member WHERE postseq = $postseq AND member.memseq = post.member_memseq";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_array($result);
    $writeId = $post['memid'];
    if(!isset($_GET['name'])) {
        $postcount = ++$post['postviewcount'];
        
        //update view count
        $sql = "UPDATE post SET postviewcount = $postcount WHERE postseq = $postseq";
        mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>detail view</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<!-- 게시판 수정 -->
	<table cellpadding="0" cellspacing="0">
    <tr align="center" valign="middle">
        <td colspan="5">익명 게시판</td>
    </tr>
    <tr bgcolor="cccccc">
        <td colspan="2" style="height:1px;"></td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;" height="16">
            <div align="center">글번호&nbsp;&nbsp;</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
            <?=$count;?>
        </td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;" height="16">
            <div align="center">제 목&nbsp;&nbsp;</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
        <?=$post['posttitle'];?>
        </td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;" height="16">
            <div align="center">작성자&nbsp;&nbsp;</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
        <?=$post['memnickname'];?>
        </td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;" height="16">
            <div align="center">등록시간&nbsp;&nbsp;</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
            <?=$post['posttime'];?>
        </td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;" height="16">
            <div align="center">조회수&nbsp;&nbsp;</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
            <?=$post['postviewcount'];?>
        </td>
    </tr>
    <tr bgcolor="cccccc">
        <td colspan="2" style="height:1px;">
        </td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;">
            <div align="center">내 용</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
            <table border=0 width=490 height=250 style="table-layout:fixed">
                <tr>
                    <td valign=top style="font-family:돋음; font-size:12px;">
                        <?=$post['postcontent'];?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="font-family:돋음; font-size:12px;">
            <div align="center">첨부파일</div>
        </td>
        <td style="font-family:돋음; font-size:12px;">
            <a href="./boardForm/<%=board.getFile()%>">
                <?=$post['postfile'];?>
            </a>
        </td>
    </tr>
    <tr bgcolor="cccccc">
        <td colspan="2" style="height:1px;"></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr align="center" valign="middle">
        <form name = 'check_delete' method='post'>
        <td colspan="5">
            <?php if($writeId == $loginId) { ?>
            <input type="button" value='[수정]' onclick="location.href='<?= "boardForm.php?name=Modify&postseq=".$post['postseq']."&count=".$count; ?>'">
            &nbsp;&nbsp;

            <input type="button" value='[진짜삭제]' onclick='mydelete(1)'>
            &nbsp;&nbsp;

            <input type="button" value='[가짜삭제]' onclick="mydelete(2)">
            &nbsp;&nbsp;

            <?php } ?>
            <input type="button" value='[목록]' onclick="location.href='<?= 'boardList.php'?>'">
             &nbsp;&nbsp;
        </td>
        </form>
    </tr>
</table>

        <script>
            function mydelete (index)
            {
                var postseq = <?= $postseq ?>;

                // console.log(index);
                //진짜삭제
                var con_test = confirm("정말로 삭제 하시겠습니까?");
                if(con_test == true){
                    if(index==1)
                    {
                        document.check_delete.action="boardDelete.php?del=true_delete&postseq="+postseq;
                    }
                    else
                    {
                        document.check_delete.action="boardDelete.php?del=false_delete&postseq="+postseq;
                    }
                }
                document.check_delete.submit();
            };    
        </script>


</body>

</html>
