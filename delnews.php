<?php
session_start();
include_once "config.php";
include_once "check_login.php";

if (isset($_GET['newsID'])) {
    $newsID = $_GET['newsID'];
    $user = $_SESSION['user'];

    $sql1 = "SELECT cl_file FROM tb_message WHERE cl_id = '{$newsID}' AND cl_author = '{$user}'";
    $r = mysql_query($sql1);
    if(mysql_num_rows($r) > 0){
        $row = mysql_fetch_assoc($r);
        $filePath = $row['cl_file'];
        $filepath_gbk = iconv('UTF-8', 'GBK', $filePath);//删除中文文件时需要转码

        $sql = "DELETE FROM tb_message WHERE cl_id = '{$newsID}' AND cl_author = '{$user}'";
        $result = mysql_query($sql);
        if($result){
            if (!empty($filepath_gbk) && file_exists($filepath_gbk)) {
                unlink($filepath_gbk);//删除文件路径
            }
            echo "<script>alert('删除成功');location.href = 'index.php';</script>";
        }else{
            echo "<script>alert('删除失败');location.href = 'index.php';</script>";
        }
    }else{
        echo "<script>alert('请勿删除他人留言');location.href = 'index.php';</script>";
    }
}else{
    echo "<script>alert('出现意外错误，请重试');location.href = 'index.php';</script>";
}
?>