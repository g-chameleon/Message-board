<?php
session_start();

include_once "check_login.php";
include_once "config.php";

$user = $_SESSION['user'];
$pass = $_SESSION['pass'];

//修改密码
if (@$_POST["old_password"] != "" && @$_POST["password"] != "" && @$_POST["confirm"] != "") {
    $old_pass = $_POST["old_password"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if($pass == $old_pass){
        if($password == $confirm){
            $sql = "UPDATE tb_user SET cl_pass = '{$password}', cl_confirm = '{$confirm}' WHERE cl_user = '{$user}'";
            $result = mysql_query($sql);
            if($result){
                echo "<script>alert('修改密码成功，请重新登陆');location.href = 'login.html';</script>";
            }else{
                echo "<script>alert('修改密码失败，请重试');location.href = 'userinfo.html';</script>";
            }
        }else{
            echo "<script>alert('新密码不一致，请重新输入');location.href = 'userinfo.html';</script>";
        }
    }else{
        echo "<script>alert('密码有误，请重新输入');location.href = 'userinfo.html';</script>";
    }
}

//上传头像
if ( isset($_FILES["upload"]) ) {
    $uploadInfo = $_FILES["upload"];
    $pic_name = $uploadInfo["name"];

    $pic_db = "uploads/" . $pic_name;
    $upload_file = "uploads/" . iconv("UTF-8","GBK",$pic_name);

    $sql = "UPDATE tb_user SET cl_avatar = '{$pic_db}' WHERE cl_user = '{$user}'";
    $result = mysql_query($sql);

    if ( !file_exists("uploads")){
        mkdir("uploads");
    }
    if (move_uploaded_file($uploadInfo['tmp_name'], $upload_file) && $result) {
        echo "<script>alert('头像上传成功');location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('抱歉，上传文件时发生错误。');location.href = 'userinfo.html';</script>";
    }

}
?>