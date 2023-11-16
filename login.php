<?php
session_start();

if ( @$_POST["user"] != "" && @$_POST["password"] != "" ){
    $uname = $_POST["user"];
    $upass = $_POST["password"];

    include_once "config.php";

    $sql = "select * from tb_user where cl_user = '{$uname}' and cl_pass ='{$upass}'";

    $res = mysql_query($sql) or die(mysql_error());

    if (mysql_num_rows($res) > 0) {
        $userinfo = mysql_fetch_assoc($res);

        $_SESSION["isLogin"] = 1;
        $_SESSION["user"] = $userinfo["cl_user"];
        $_SESSION["pass"] = $userinfo["cl_pass"];
        $_SESSION["avatar"] = $userinfo["cl_avatar"];

        echo "<script>alert('登录成功');location.href = 'index.php';</script>";
    }else{
        echo "<script>alert('用户名或密码有误，请重新输入');location.href = 'login.html';</script>";
    }
}
?>