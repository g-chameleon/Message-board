<?php
error_reporting(0);
session_start();
include_once "config.php";
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
        .logout-message{
            float: right;
            display: block;
            color: white;
            margin-top: 60px;
            text-decoration: none;
        }
        .button-message{
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
        .h1-message{
            color: white;
            float: left;
            margin-top: 20px;
            text-align: center;
        }
        .logout-message:hover {
            background-color: #ddd;
            color: black;
        }


        .news-id {
            font-size: 20px;
            width: 50px;
        }

        .news-title {
            font-size: 20px;
            width: 200px;
        }

        .news-content {
            font-size: 20px;
            width: 700px;
        }
        .news-author{
            font-size: 20px;
            width: 150px;
        }
        .news-time{
            font-size: 20px;
            width: 200px;
        }
        .news-file{
            font-size: 20px;
            width: 100px;
        }
        .news-action{
            font-size: 20px;
            width: 100px;
        }
        .actions {
            color: #333333;
            display: block;
            text-align: center;
            padding: 1px 8px;
            text-decoration: none;
        }
        .actions:hover {
            background-color: #ddd;
            color: black;
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


<div style="padding:20px;text-align: center;">
    <table class="table table-hover">
        <thead>
        <tr>
            <td class="news-id">ID</td>
            <td class="news-title">标题</td>
            <td class="news-content">内容</td>
            <td class="news-author">作者</td>
            <td class="news-time">时间</td>
            <td class="news-file">附件</td>
            <td class="news-action">操作</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "select * from tb_message";

        $res = mysql_query($sql) or die(mysql_error());

        while ($r = mysql_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>{$r['cl_id']}</td>";
            echo "<td>{$r['cl_title']}</td>";
            echo "<td>{$r['cl_content']}</td>";
            echo "<td>{$r['cl_author']}</td>";
            echo "<td>{$r['cl_date']}</td>";
            echo "<td><a href='{$r['cl_file']}'>附件</a></td>";
            echo "<td>";
            echo "<a href='delnews.php?newsID={$r['cl_id']}' class='actions'>删除</a>";
            echo "<a href='editnews.php?newsID={$r['cl_id']}' class='actions'>修改</a>";
            echo "</td>";
        }
        ?>
        </tbody>
    </table>
</div>

