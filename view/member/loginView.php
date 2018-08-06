<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="utf-8">  
    <title>Login Page</title>  
</head>  
<body>  
    <h1>Login</h1>  

    <form name="initView" action="../../controller/member/loginController.php" method="post">
        <p><input type="text" name="id"></p>
        <p><input type="text" name="pw"></p>   
        <p><input type="submit" value="Login" style="width:50px"> </p>
    </form>  
    <a href="signinView.php"><input type="button" value="join" style="width:50px"></a>

</body>  
</html>  