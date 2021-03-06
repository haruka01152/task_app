<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit();
}

$member['id'] = $_SESSION['id'];

$statement = $db->prepare('SELECT * FROM members WHERE id=?');
$statement->execute(array($_SESSION['id']));
$loginmember = $statement->fetch();

$statement = $db->prepare('INSERT INTO tasks SET member_id=?,task_name=?,task_detail=?, date=?, datetime=?');
$statement->execute(array(
    $member['id'],
    $_SESSION['task_name'],
    $_SESSION['task_detail'],
    $_SESSION['datetime'],
    $_SESSION['datetime']
));

unset($_SESSION['task_name'], $_SESSION['task_detail'], $_SESSION['datetime']);

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
    <?php if($loginmember['colormode'] === '1'): ?>
    <link rel="stylesheet" href="../common/css/colormode1.css">
    <?php elseif($loginmember['colormode'] === '3'): ?>
    <link rel="stylesheet" href="../common/css/colormode3.css">
    <?php elseif($loginmember['colormode'] === '4'): ?>
    <link rel="stylesheet" href="../common/css/colormode4.css">
    <?php endif; ?>
    <title>タスク追加完了 | タスク管理</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="logout_button">
                <a href="logout.php">ログアウト</a>
            </div>
        </div>
    </header>


    <section class="main">
        <div class="container">

            <div class="addtask_area">
                <div class="addtask_area_title">
                    <h1>タスク追加完了</h1>
                </div>

                <div id="addtask_done_message">
                    <p>タスクの追加が完了しました。</p>
                </div>

            </div>

            <div class="goto_topbutton">
                <a href="index.php">トップへ戻る</a>
            </div>
        </div>
    </section>


    <footer>
        <div class="container">
            <div class="copyright">
                <span>© 2021 All Rights Reserved.</span>
            </div>
        </div>
    </footer>

</body>

</html>