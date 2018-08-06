<!DOCTYPE html>  
<html>  
<head>  
    <title>Modify Page</title>  
</head>  
<body>  
    <h1>Modify</h1>  
  
        <form action=<?php echo base_url()."index.php/modules/board/BoardController/modify_validation/".$post['postseq']; ?> method='post'>
            <table border=1 width=100%>
                <thead>
                    <tr>
                        <th style="width:100px;">제목</th>
                        <th><input type='text' value='<?= $post['posttitle'] ?>' name='posttitle' style = "width:99%"></th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">내용</th>
                        <th><textarea name='postcontent' style = "height:500px; width:99%"><?= $post['postcontent'] ?></textarea></th>
                    </tr>

                    <tr>
                        <th style="width:100px;">작성자</th>
                        <th><?=  
                             $nickname;
                            ?>
                        </th>
                    </tr>
                    
                    <tr>
                        <th style="width:100px">작성일</th>
                        <th><?= $post['posttime']; ?>
                        </th>
                    </tr>
                </thead>


            </table>
            <input type='submit' value='modify' style="float:right; margin-top:10px; height:40px; width:80px">
        </form>
    <button style = "margin-top:10px; height:40px; width:80px" onclick="window.location.href='<?php echo base_url()."index.php/modules/board/BoardController"; ?>'">cancel</button>
    
    
</body>  
</html>  