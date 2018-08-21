<?php   
    include '../../common/dbconn.php';

    session_start();

    $pageTitle = $_GET['name'];
    $postseq = 0;
    $title ='';
    $content ='';
    $time = date('Y-m-d');
    if($pageTitle=='Modify') {
        $postseq = $_GET['postseq'];
        $pageTitle = 'Modify';
        $sql = "SELECT *
                FROM
                    post
                WHERE postseq = '$postseq'
                ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);   
        $title= $row['posttitle'];
        $content= $row['postcontent'];
        $time= $row['posttime'];    
    }

    $id = $_SESSION['id'];
    $sql = "SELECT * 
    FROM 
        member 
    WHERE 
        memid = '$id'
    ";
    $count = 0;

    //수정이면
    if(isset($_GET['count']))
        $count=$_GET['count'];

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>  
<html>  
<head>  
    <title><?= $pageTitle.' Page' ?></title>  
</head>  
<body>  
    <h1><?= $pageTitle ?></h1>  
        <form action='<?= "uploadQuery.php?name=$pageTitle&postseq=$postseq&count=$count"?>' method='post'>
            <table border=1 width=100%>
                <input type="hidden" name='memseq' value='<?= $row['memseq'] ?>'>
                <thead>
                    <tr>
                        <th style="width:100px;">제목</th>
                        <th><input type='text' name='posttitle' value='<?= $title ?>' style = "width:99%"></th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">내용</th>
                        <th><textarea name='postcontent' style = "height:500px; width:99%"><?= $content ?></textarea></th>
                    </tr>

                    <tr>
                        <th style="width:100px;">작성자</th>
                        <th> <?= $row['memnickname'] ?>
                        </th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">작성일</th>
                        <th><?= $time ?>
                        </th>
                    </tr>
                </thead>


            </table>
            <input type='submit' value='<?= $pageTitle ?>' style="float:right; margin-top:10px; height:40px; width:80px">
        </form>
        <input type='button' onclick="location.href='<?= 'boardList.php'?>'" value='back' style="float:right; margin-top:10px; height:40px; width:80px">
</body>  
</html>  
