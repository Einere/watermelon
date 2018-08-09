<?php
    session_start();
    if($_GET['print']=="Logout") {
        unset($_SESSION['id']);
        ?>
        <script>
            window.opener.location.reload();
            window.close();
        </script>
        <?php
    }
?>
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="utf-8">  
    <title>Login Page</title>  
</head>  
<body>  
    <center>
    <h1>Login</h1>  
    <form name="loginView" action="memberCheck.php" method="post">
        <table>
        <tr>
            <td><input type="text" name="id"></td>
            <td rowspan="2"><input type="submit" value="Login" style="width:70px; height:50px"></td>
        </tr>
        <tr>
            <td><input type="text" name="pw"></td>
        </tr>
        </table>
    </form>  
    </center>
    <script>
    </script>
</body>  
</html>  