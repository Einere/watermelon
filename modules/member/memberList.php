<?php 
    include '../../common/dbconn.php';
    $dbconnect = new dbconn();
    $conn = $dbconnect->get_conn();
   
    $sql = 
            "SELECT * 
            FROM 
                member, 
                emaillist, 
                phone 
	        WHERE member.memseq = emaillist.member_memseq 
            AND member.memseq = phone.member_memseq 
            AND emaillist.edefault=1 AND phone.phdefault=1";
            
    $result = mysqli_query($conn, $sql);
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8"/>
            <title>MemberList</title>
            
        </head>
        <body>
            <div>
                <header id = "header" data-role="header" data-position="fixed">
                    <blockquote>
                        <p>
                            <span style="font-size:50px"><strong>Member List</strong></span></p>
                    </blockquote>
                </header>
            </div>

            <article id="board_area">
                    <table border=1 cellpadding="0" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width:20px;"><input type="checkbox" name="masterCheck"></th>
                            <th scope="col" style="width:100px;">memseq</th>
                            <th scope="col" style="width:500px;">id</th>
                            <th scope="col" style="width:150px">firstname</th>
                            <th scope="col" style="width:100px">lastname</th>
                            <th scope="col" style="width:300px">nickname</th>
                            <th scope="col" style="width:300px">pw</th>
                            <th scope="col" style="width:300px">birth</th>
                            <th scope="col" style="width:300px">addr</th>
                            <th scope="col" style="width:300px">agree</th>
                            <th scope="col" style="width:300px">email</th>
                            <th scope="col" style="width:300px">phonenum</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    foreach($result as $rt) { 
?>
                        <tr>
                            <td style="text-align:center"><input type="checkbox" value="<?= $rt['memseq'];?>" name="checkList[]"></td>
                            <th scope="row" style="text-align:center"><?= $rt['memseq']?></th>
                            <td style="text-align:center"><?= $rt["memid"];?></td>
                            <td style="text-align:center"><?= $rt["memfirstname"];?></td>
                            <td style="text-align:center"><?= $rt['memlastname'];?></td>
                            <td style="text-align:center"><?= $rt["memnickname"];?></td>
                            <td style="text-align:center"><?= $rt["mempw"];?></td>
                            <td style="text-align:center"><?= $rt["membirth"];?></td>
                            <td style="text-align:center"><?= $rt['memaddr'];?></td>
                            <td style="text-align:center"><?= $rt["memagree"];?></td>
                            <td style="text-align:center"><?= $rt["eemail"];?></td>
                            <td style="text-align:center"><?= $rt['phphonenum'];?></td>
                        </tr>
<?php             
    }    
?>
                    </tbody>
                </table>
            </article>
        </body>
    </html>
