<?php

include_once "config.php";


if (@$_POST["user"] != "" && @$_POST["password"] != "" && @$_POST["confirm"] != "" && @$_POST["protect"] != "") {
    $new_pass = $_POST["password"];
    $confirm = $_POST["confirm"];
    $user = $_POST["user"];
    $protect = $_POST["protect"];

    if ($new_pass == $confirm) {

        $sql = "SELECT * FROM tb_user WHERE cl_user = '{$user}' AND cl_protect = '{$protect}'";
        $result = mysql_query($sql);

        if (mysql_num_rows($result)>0) {

            $update_sql = "UPDATE tb_user SET cl_pass = '{$new_pass}', cl_confirm = '{$confirm}' WHERE cl_user = '{$user}' AND cl_protect = '{$protect}'";
            $update_result = mysql_query($update_sql);

            if ($update_result) {
                echo "<script>alert('修改密码成功，请重新登录');location.href = 'login.html';</script>";
            } else {
                echo "<script>alert('密码更新失败，请稍后重试');location.href = 'forgetpass.html';</script>";
            }
        } else {
            echo "<script>alert('用户名或密保信息有误，请重新尝试');location.href = 'forgetpass.html';</script>";
        }
    } else {
        echo "<script>alert('输入的密码不匹配，请重新输入');location.href = 'forgetpass.html';</script>";
    }
}