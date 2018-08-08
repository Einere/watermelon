<?php 
session_start(); 
$id = $_SESSION['username'];

include '../../common/dbconn.php';

//get db connection
$dbConnect = new dbconn();
$conn = $dbConnect->get_conn();

//get post list
$sql = "SELECT * FROM post WHERE postdelny='0' ORDER BY postseq DESC";
$postList = mysqli_query($conn, $sql);
$postList2 = mysqli_fetch_array($postList);

//get all nickname
$nicknameList = array();
foreach($postList as $post) {
    $memseq = $post["member_memseq"];
    $sql = "SELECT * FROM member WHERE memseq = '$memseq'";
    $result = mysqli_query($conn, $sql);
    $member = mysqli_fetch_array($result);
    array_push($nicknameList, $member['memnickname']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>BoardList</title>
    </head>
    <body>
        <div>
            <header id = "header" data-role="header" data-position="fixed">
                <blockquote>
                    <p>
                        <span style="font-size:50px"><strong>BOARD</strong></span>
                    </p>
                </blockquote>
                <dl>
                    <div style="float:right; margin-bottom:10px;">
                        <dt><a href="../../controller/board/uploadController.php"><input type="submit" value="등록" width="200px" ></a></dt>
                    </div>
                </dl>
            </header>
        </div>

        <article id="board_area">
            <header>
                <h1></h1>
                <table border=1 cellpadding="0" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width:20px;"><input type="checkbox" name="masterCheck"></th>
                            <th scope="col" style="width:100px;">번호</th>
                            <th scope="col" style="width:500px;">제목</th>
                            <th scope="col" style="width:150px">작성자</th>
                            <th scope="col" style="width:100px">조회수</th>
                            <th scope="col" style="width:300px">작성일</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form name='check_delete' method='post'>
                        <?php
                            $count = count($nicknameList);
                            $num = 0;

                            foreach($postList as $post) {
                                ?>
                                <tr>
                                    <td style="text-align:center"><input type="checkbox" value="<?= $post['postseq'];?>" name="checkList[]"></td>
                                    <th scope="row" style="text-align:center"><?= $count--;?></th>
                                    <td style="text-align:center"><a style="text-decoration:none; color:black" href="../../modules/board/boardDetail.php?postseq=<?= $post["postseq"]?>&count=<?= $count+1?>&id=<?=$_SESSION['username'];?>"><?= $post["posttitle"];?></a></td>
                                    <td style="text-align:center"><?= $nicknameList[$num++];?></td>
                                    <td style="text-align:center"><?= $post["postviewcount"];?></td>
                                    <td style="text-align:center"><?= $post["posttime"];?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </article>
        <div>
            <footer id="footer">
                <dl>
                    <?php 
                        if($id!=NULL)
                        {
                            $print='logout';
                        }
                        else
                        {
                            $print='log in';
                        }
                    ?>
                    <dt>
                        <input type='button' value='진짜삭제' onClick='mydelete(1)'>
                        <input type='button' value='가짜삭제' onClick='mydelete(2)'>
                    </dt>
                    </form>
                    <dt>
                        <form action="http://project_kiwi.com/index.php/modules/member/MemberController"><input type="submit" name="logout" value="<?= $print ?>" width=100px></form></dt>
                    <dt>
                </dl>
            </footer>
        </div>

        <script>
            function mydelete (index)
            {
                // console.log(index);
                //진짜삭제
                if(index==1)
                {
                    document.check_delete.action="http://project_kiwi.com/index.php/modules/board/BoardController/true_delete";
                }
                else
                {
                    document.check_delete.action="http://project_kiwi.com/index.php/modules/board/BoardController/false_delete";
                }


                document.check_delete.submit();
            };    
        </script>

        <script>
            let masterCheck = document.getElementsByName('masterCheck')[0];
            let checkList = document.getElementsByName('checkList[]');
            masterCheck.addEventListener('click', function(e){
                if(masterCheck.checked){
                    for(let item of checkList){
                        item.checked = true;
                    }
                }
                else{
                    for(let item of checkList){
                        item.checked = false;
                    }
                }
            });
        </script>
    </body>
</html>
