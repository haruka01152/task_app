<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit();
}

$post = htmlspecialchars($_POST, ENT_QUOTES | ENT_HTML5);

$tasks = $db->prepare('SELECT * FROM tasks WHERE id=?');
$tasks->execute(array($_REQUEST['task_id']));
$task = $tasks->fetch();

$statement = $db->prepare('UPDATE tasks SET task_name=?,category_id=?,task_detail=?,datetime=? WHERE id=?');
$statement->execute(array(
    $post['task_name'],
    $post['category_id'],
    $post['task_detail'],
    $post['datetime']
));

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
    <title>タスク編集 | タスク管理</title>
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
            <div class="category_name">
                <span>カテゴリ名1 ：</span>
            </div>

            <div class="addtask_area">
                <div class="addtask_area_title">
                    <h1>タスク編集</h1>
                </div>

                <form method="post" action="" id="addtask_forms">
                    <div class="addtask_form datetime">
                        <span id="datetime_label">日時</span>
                        <input type="datetime-local" name="datetime" id="datetime" value="<?=date('Y-m-d\TH:i', strtotime($task['datetime']))?>">
                    </div>
                    <div class="addtask_form task_name">
                        <span id="task_name_label">タスク名</span>
                        <input type="text" name="task_name" id="task_name" value="<?= $task['task_name']; ?>">
                    </div>
                    <div class="addtask_form detail">
                        <span id="task_detail_label">詳細メモ</span>
                        <textarea name="task_detail" id="task_detail" cols="30" rows="10"><?= $task['task_detail']; ?></textarea>
                    </div>

                    <div class="addtask_submitbutton">
                        <input type="submit" value="登録">
                    </div>
                </form>
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