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
        <?=$nickname;?>
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
            <a href="./boardupload/<%=board.getFile()%>">
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
        <td colspan="5">
            <?php if($nickname == $login) { ?>
            <a href="<?php echo base_url()."index.php/modules/board/BoardController/modify/".$post['postseq']."?nickname=".$nickname; ?>">
                [수정]
            </a>&nbsp;&nbsp;
            <a href="<?php echo base_url()."index.php/modules/board/BoardController/delete/".$post['postseq']; ?>">
                [삭제]
            </a>&nbsp;&nbsp;
            <?php } ?>
            <a href="<?php echo base_url()."index.php/modules/board/BoardController/lists"; ?>">
                [목록]
            </a>&nbsp;&nbsp;
        </td>
    </tr>
</table>
</body>

</html>