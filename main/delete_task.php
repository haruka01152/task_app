<?php
session_start();

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit();
}

$statement = $db->prepare('SELECT * FROM members WHERE id=?');
$statement->execute(array($_SESSION['id']));
$loginmember = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
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