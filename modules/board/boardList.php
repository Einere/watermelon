<?php 
session_start(); 

include '../../common/dbconn.php';
$limit = 10;
$search_title = '';
$search_content = '';
$search_writer = '';
$search_choice = '';
if(isset($_GET['search_choice'])) {
    $search_choice = $_GET['search_choice'];
    $search_text = $_GET['search_text'];
    if($_GET['search_choice'] == 'search_title') {
        $search_title = '%'.$_GET['search_text'].'%';
    } else if($_GET['search_choice'] == 'search_content') {
        $search_content = '%'.$_GET['search_text'].'%';
    } else if($_GET['search_choice'] == 'search_writer'){
        $search_writer = '%'.$_GET['search_text'].'%';
    } else {
        $search_title = '%'.$_GET['search_text'].'%';
        $search_content = '%'.$_GET['search_text'].'%';
    }
    $sql = "SELECT 
            COUNT(*)
        FROM
            post, member
        WHERE
            postDelNY = 0 
            AND post.member_memseq = member.memseq
            AND (posttitle Like '$search_title'
            OR postcontent Like '$search_content'
            OR memnickname Like '$search_writer')
        ";
} else{
    $sql = "SELECT 
            COUNT(*)
        FROM
            post, member
        WHERE
            postDelNY = 0 
            AND post.member_memseq = member.memseq
        ";
}

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$total_count = $row['COUNT(*)'];

//페이지 찾기
$page=1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    if(isset($_SESSION['page']))
        $page=$_SESSION['page'];
}
if(isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    if(isset($_SESSION['limit']))
        $limit=$_SESSION['limit'];
}

$_SESSION['page'] = $page;
$_SESSION['limit'] = $limit;

//페이지 개수세기
$count = $total_count - $limit*($page-1);
$total_page = ceil($total_count/$limit);
$pagestart = ($page-1)*$limit;

if(isset($_GET['search_choice'])){
    //get post list
    $sql = "SELECT 
                * 
            FROM 
                post, member 
            WHERE 
                postdelny='0'
                AND post.member_memseq = member.memseq
                AND (posttitle Like '$search_title'
                OR postcontent Like '$search_content' 
                OR memnickname Like '$search_writer')

            ORDER BY 
                postseq DESC
            LIMIT
                $pagestart, $limit
            ";
} else{
    //get post list
    $sql = "SELECT 
                * 
            FROM 
                post, member 
            WHERE 
                postdelny='0'
                AND post.member_memseq = member.memseq
                

            ORDER BY 
                postseq DESC
            LIMIT
                $pagestart, $limit
            ";
}

$postList = mysqli_query($conn, $sql);
$postList2 = mysqli_fetch_array($postList);


// //get all nickname
// $nicknameList = array();
// foreach($postList as $post) {
//     $memseq = $post["member_memseq"];
//     $sql = "SELECT * FROM member WHERE memseq = '$memseq'";
//     $result = mysqli_query($conn, $sql);
//     $member = mysqli_fetch_array($result);
//     array_push($nicknameList, $member['memnickname']);
// }

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
                        <a href = 'boardList.php'> <span style="font-size:50px"><strong>BOARD</strong></span></a>
                    </p>
                </blockquote>
                <center>
                    <select name="search_choice" id ="search_choice">
                        <option value="search_title" selected>제목</option>
                        <option value="search_content">내용</option>
                        <option value="search_all">제목+내용</option>
                        <option value="search_writer">등록자</option>
                    </select>
                    
                    <input type='text' name='search_text' id='search_text' >
                    <!-- <input type='submit' value='검색!'> -->
                    <input type="button" value="검색 !" onclick="search_click()">
                    <script>
                        //유지 되게 하기
                        var sel = document.getElementById("search_choice");
                        var search = '<?= $search_choice ?>';
                        for(var i = 0; i < sel.options.length; i++)
                        {
                            if(search == sel.options[i].value)
                            {
                                sel.options[i].selected = true;
                                break;
                            }
                        }
                        document.getElementById("search_text").value = '<?= $_GET['search_text']?>';
                    </script>
                </center>
                <dl>
                    <dt><input type="button" name="logout" value=<?= $print ?> onclick="login_click(this)" width="100px">
                        <?php
                        if($print=="Login") { ?>
                            <a href="../member/memberSigninView.php"><input type="button" name="Sign In" value="Sign In" width="100px"></a>
                            <div style="float:right; margin-bottom:10px;">
                            <input type="submit" value="Post" width="200px" onclick="alert('로그인 하고 이용하세요.');">
                        <?php 
                        }
                        else { ?>
                        <div style="float:right; margin-bottom:10px;">
                        <a href="../board/boardForm.php?name=Upload"><input type="submit" value="Post" width="200px" ></a>
                        <?php
                        }
                        ?><br>
                        <select id="list_count" onchange="limit_change()">
                            <option value="10" selected>10</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <script>
                            //유지되게 하기
                            var sel = document.getElementById("list_count");
                            var limit = <?= $limit ?>;
                            for(var i = 0; i < sel.options.length; i++)
                            {
                                if(limit == sel.options[i].value)
                                {
                                    sel.options[i].selected = true;
                                    break;
                                }
                            }
                        </script>
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
                            $num = 0;
                            if($count == 0){
                                ?> <tr><td colspan="6"><center><strong>검색결과가 없습니다!</strong></center></td></tr>
                                <?php
                            }
                            foreach($postList as $post) {
                                ?>
                                <tr>
                                    <td style="text-align:center"><input type="checkbox" value="<?= $post['postseq'];?>" name="checkList[]"></td>
                                    <th scope="row" style="text-align:center"><?= $count--;?></th>
                                    <td style="text-align:center"><a style="text-decoration:none; color:black" href="boardView.php?postseq=<?= $post["postseq"]?>&count=<?= $count+1?>"><?= $post["posttitle"];?></a></td>
                                    <td style="text-align:center"><?= $post["memnickname"];?></td>
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
        <center>
            <?php
                for($i=1; $i<=$total_page; $i++) {
                    if($i != $page) { ?>
                        <a href="boardList.php?page=<?= $i ?>&limit=<?=$limit?>&search_choice=<?= $search_choice?>&search_text=<?=$search_text?>"><?= $i ?></a>
                        <?php
                    } else {
                        echo '<strong>'.$i.'</strong>';
                    }
                } ?>
        </center>
        <script>
            function login_click(obj) {
                    var popUrl = "../member/memberLogin.php?print="+obj.value;	//팝업창에 출력될 페이지 URL
                    var popOption = "width=450, height=180, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)
                    window.open(popUrl,"",popOption);

            }
        </script>

        <script>
            function search_click() {
                var page = 1;
                var limit = <?= $limit ?>;
                var sel = document.getElementById("search_choice");
                var val = sel.options[sel.selectedIndex].value;
                var text = document.getElementById("search_text").value;

                location.href="boardList.php?page="+page+"&limit="+limit+"&search_choice="+val+"&search_text="+text;                    
            }
        </script>

        <script>
            function mydelete (index)
            {
                // console.log(index);
                //진짜삭제
                var con_test = confirm("정말로 삭제 하시겠습니까?");
                if(con_test == true){
                    if(index==1)
                    {
                        document.check_delete.action="boardDelete.php?del=true_delete";
                    }
                    else
                    {
                        document.check_delete.action="boardDelete.php?del=false_delete";
                    }
                    document.check_delete.submit();
                }
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

        <script>
            function limit_change() {
                //var page = <?= $page ?>;
                var page = 1;
                var sel = document.getElementById("list_count");
                var val = sel.options[sel.selectedIndex].value;
                location.href="boardList.php?page="+page+"&limit="+val;
            }
        </script>
    </body>
</html>
