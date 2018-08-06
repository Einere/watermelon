<!DOCTYPE html>  
<html>  
<head>  
    <title>Upload Page</title>  
</head>  
<body>  
    <h1>Upload</h1>  
        <form action=<?php echo base_url()."index.php/modules/board/BoardController/upload_validation"?> method='post'>
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
                        <th><?=  
                            $memseq['memnickname'];
                            ?>
                        </th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">작성일</th>
                        <th><?php $today = date("Y-m-d");
                        echo $today;?>
                        </th>
                    </tr>
                </thead>


            </table>
            <input type='submit' value='upload' style="float:right; margin-top:10px; height:40px; width:80px">
        </form>
    <button style = "margin-top:10px; height:40px; width:80px" onclick="window.location.href='<?php echo base_url()."index.php/modules/board/BoardController"; ?>'">cancel</button>
    
    
</body>  
</html>  