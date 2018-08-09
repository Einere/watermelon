<!DOCTYPE html>  
<html>  
<head>  
    <title>Upload Page</title>  
</head>  
<body>  
    <h1>Upload</h1>  
        <form action='<?= "uploadQuery.php"?>' method='post'>
            <input type="hidden" name='id' value='1'>
            <table border=1 width=100%>
                <thead>
                    <tr>
                        <th style="width:100px;">제목</th>
                        <th><input type='text' name='posttitle' style = "width:99%"></th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">내용</th>
                        <th><textarea name='postcontent' style = "height:500px; width:99%"></textarea></th>
                    </tr>

                    <tr>
                        <th style="width:100px;">작성자</th>
                        <th> <?= 1 ?>
                        </th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">작성일</th>
                        <th><?= date('Y-m-d');?>
                        </th>
                    </tr>
                </thead>


            </table>
            <input type='submit' value='upload' style="float:right; margin-top:10px; height:40px; width:80px">
        </form>
</body>  
</html>  
