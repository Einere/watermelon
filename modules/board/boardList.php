<?php 
session_start(); 

include '../../common/dbconn.php';

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

if(isset($_SESSION['id'])) {
    $print='Logout';
} else {
    $print='Login';
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
                    <dt><input type="button" name="logout" value=<?= $print ?> onclick="login_click(this)" width="100px">
                    <a href="../member/memberSigninView.php"><input type="button" name="Sign In" value="Sign In" width="100px"></a>
                    <div style="float:right; margin-bottom:10px;">
                        <?php
                        if($print=="Login") { ?>
                            <input type="submit" value="Post" width="200px" onclick="alert('로그인 하고 이용하세요.');">
                        <?php 
                        }
                        else { ?>
                        <a href="../board/boardUpload.php"><input type="submit" value="Post" width="200px" ></a>
                        <?php
                        }
                        ?>
                    </div>
                    </dt>
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
                    <dt>
                        <input type='button' value='진짜삭제' onClick='mydelete(1)'>
                        <input type='button' value='가짜삭제' onClick='mydelete(2)'>
                    </dt>
                    </form>
                </dl>
            </footer>
        </div>

        <script>
            function login_click(obj) {
                    var popUrl = "../member/memberLogin.php?print="+obj.value;	//팝업창에 출력될 페이지 URL
                    var popOption = "width=450, height=180, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)
                    window.open(popUrl,"",popOption);

            }
        </script>

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
