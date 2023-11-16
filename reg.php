<?php
//insert into tb_user (cl_user, cl_pass) values ("admin", "123");
if (@$_POST["user"] != "" && @$_POST["password"] != "" && @$_POST["confirm"] != "" && @$_POST["protect"] != "") {
    $user = $_POST["user"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $protect = $_POST["protect"];

    include_once "config.php";

    $user_db = "select * from tb_user where cl_user = '{$user}'";
    $result = mysql_query($user_db);

    if (mysql_num_rows($result) > 0) {
        echo "<script>alert('用户名已经被注册');location.href = 'reg.html';</script>";
    } else {
        if ($password == $confirm) {
            $sql = "insert into tb_user (cl_user, cl_pass,cl_confirm,cl_protect) values ('{$user}', '{$password}','{$confirm}','{$protect}')";
            $res = mysql_query($sql);
            if ($res) {
                echo "<script>alert('⽤户注册成功');location.href = 'login.html';</script>";
            } else {
                echo "<script>alert('⽤户注册失败');location.href = 'reg.html';</script>";
                echo mysql_error();
            }
        } else {
            echo "<script>alert('输入密码有误，请重新输入');location.href = 'reg.html';</script>";
        }
    }
} else {
    echo "所有字段都必须填写";
}