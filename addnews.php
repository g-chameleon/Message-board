<?php
session_start();
include_once "check_login.php";
include_once "config.php";

if ($_POST["title"] != "") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_SESSION["user"];
    $file_db = "";

    if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0) {
        $uploadInfo = $_FILES["upload"];
        $file = $uploadInfo["name"];
        $file_db = "uploads/" . $file;
        $upload_file = "uploads/" . iconv("UTF-8", "GBK", $file);

        if (!file_exists("uploads")) {
            mkdir("uploads");
        }

        if (!move_uploaded_file($uploadInfo['tmp_name'], $upload_file)) {
            echo "<script>alert('文件上传失败');location.href = 'addnews.html';</script>";
        }
    }

    $sql = "INSERT INTO tb_message (cl_title, cl_content, cl_author, cl_file) VALUES ('$title', '$content', '$author', '$file_db')";
    $result = mysql_query($sql);
    if ($result) {
        echo "<script>alert('留言发送成功');location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('留言发送失败，请稍后重试');location.href = 'addnews.html';</script>";
    }
} else {
    echo "<script>alert('标题不能为空');location.href = 'addnews.html';</script>";
}
?>