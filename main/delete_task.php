<?php
session_start();

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> 
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="../common/css/style_main.css">
    <title>タスク削除 | タスク管理</title>
</head>

<body>
    <script>
        window.alert('タスクを削除してもよろしいですか？間違って押した場合、ブラウザの「戻る」ボタンを押してください。')

        let urlParam = location.search.substring(1);
        location.href = 'delete_task_do.php?' + urlParam;
    </script>

</body>
</html>