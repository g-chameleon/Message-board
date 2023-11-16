<?php
session_start();
error_reporting(0);
include_once "check_login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Message board</title>
    <style>
        /* 导航栏css*/
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar-message {
            overflow: hidden;
            background-color: #333;
        }

        .logout-message {
            float: right;
            display: block;
            color: white;
            margin-top: 60px;
            text-decoration: none;
        }

        .button-message {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 33px 20px;
            text-decoration: none;
        }

        .button-message:hover {
            background-color: #ddd;
            color: black;
        }

        .h1-message {
            color: white;
            float: left;
            text-align: center;
            font-size: 2.5rem;
            font-weight: 500;
            margin-top: 12px;
            margin-bottom: 0.5rem;
        }

        .logout-message:hover {
            background-color: #ddd;
            color: black;
        }

        /* 表单部分   */
        * {
            box-sizing: border-box;
        }

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        .col-25 {
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            width: 75%;
            margin-top: 6px;
        }

        /* 清除浮动 */
        .row-message:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
<div class="navbar-message">
    <h1 class="h1-message">留言板</h1>
    <a href="logout.php" class="logout-message">欢迎用户 <?php echo htmlspecialchars($_SESSION['user']); ?>，注销</a>
    <a href="userinfo.html" class="button-message"><img src="<?php echo $_SESSION['avatar']; ?>"width="30";height="30">个人信息</a>
    <a href="addnews.html" class="button-message">添加留言</a>
    <a href="index.php" class="button-message">首页</a>
</div>

<?php
include_once "config.php";

if (isset($_GET['newsID'])) {
    $newsID = $_GET['newsID'];
    $user = $_SESSION['user'];

    $sql = "SELECT cl_title,cl_content FROM tb_message WHERE cl_id = '{$newsID}' AND cl_author = '{$user}'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result)>0) {
        while ($r = mysql_fetch_assoc($result)) {
            $title = $r['cl_title'];
            $content = $r['cl_content'];
        }
    }else{
        echo "<script>alert('请勿修改他人的留言');location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('发生未知错误，请重新尝试');location.href = 'index.php';</script>";
}
?>
<form enctype="multipart/form-data" method="post" style="margin-top: 50px;margin-left: 300px">
    <div class="row-message">
        <div class="col-25">
            <label>标题</label>
        </div>
        <div class="col-75">
            <input type="text" value="<?php echo htmlspecialchars($title) ?>" name="title" required = 'required'>
        </div>
    </div>
    <div class="row-message">
        <div class="col-25">
            <label>上传附件</label>
        </div>
        <div class="col-75">
            <input type="file" name="upload">
        </div>
    </div>
    <div class="row-message">
        <div class="col-25">
            <label>内容</label>
        </div>
        <div class="col-75">
            <textarea name="content" style="height:200px"><?php echo htmlspecialchars($content) ?></textarea>
        </div>
    </div>
    <div class="row-message">
        <input class="btn btn-primary" type="submit" value="修改" style="margin-left: 970px">
    </div>
</form>

<?php
if ($_POST["title"] != "") {
    $new_title = $_POST["title"];
    $new_content = $_POST["content"];
    $file_db = "";

    if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0){
        $uploadInfo = $_FILES["upload"];
        $file = $uploadInfo["name"];
        $file_db = "uploads/" . $file;
        $upload_file = "uploads/" . iconv("UTF-8","GBK",$file);

        if ( !file_exists("uploads")){
            mkdir("uploads");
        }
        if(!move_uploaded_file($uploadInfo['tmp_name'], $upload_file)){
            echo "<script>alert('文件上传失败');location.href = 'addnews.html';</script>";
        }
    }

    if($file_db != ""){
        $sql = "UPDATE tb_message SET cl_title= '{$new_title}',cl_content = '{$new_content}',cl_file = '{$file_db}' WHERE cl_id = '{$newsID}'";
        $result = mysql_query($sql);
    }else{
        $sql = "UPDATE tb_message SET cl_title= '{$new_title}',cl_content = '{$new_content}' WHERE cl_id = '{$newsID}'";
        $result = mysql_query($sql);
    }
    if ($result){
        echo "<script>alert('留言发送成功');location.href = 'index.php';</script>";
    }else{
        echo "<script>alert('留言发送失败，请稍后重试');location.href = 'addnews.html';</script>";
    }
}
?>
</body>
</html>