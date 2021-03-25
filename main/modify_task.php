<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit();
}

$_SESSION['task_id'] = $_REQUEST['task_id'];

$statement = $db->prepare('SELECT * FROM members WHERE id=?');
$statement->execute(array($_SESSION['id']));
$loginmember = $statement->fetch();

$tasks = $db->prepare('SELECT * FROM tasks WHERE id=?');
$tasks->execute(array($_REQUEST['task_id']));
$task = $tasks->fetch();

if(!empty($_POST)){

    if($_POST['datetime'] == ''){
        $error['datetime'] = 'blank';
    }

    if($_POST['task_name'] == ''){
        $error['task_name'] = 'blank';
    }

    if(empty($error)){
        $_SESSION['datetime'] = $_POST['datetime'];
        $_SESSION['task_name'] = $_POST['task_name'];
        $_SESSION['task_detail'] = $_POST['task_detail'];

        header('Location: modify_task_done.php');
        exit();
    }
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
    <?php if($loginmember['colormode'] === '1'): ?>
    <link rel="stylesheet" href="../common/css/colormode1.css">
    <?php elseif($loginmember['colormode'] === '3'): ?>
    <link rel="stylesheet" href="../common/css/colormode3.css">
    <?php elseif($loginmember['colormode'] === '4'): ?>
    <link rel="stylesheet" href="../common/css/colormode4.css">
    <?php endif; ?>
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

            <div class="addtask_area">
                <div class="addtask_area_title">
                    <h1>タスク参照・編集</h1>
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

                    <?php if($error['datetime'] === 'blank'): ?>
                        <p class="error addtask_error">* 日時を入力してください</p>
                        <?php endif; ?>
                        <?php if($error['task_name'] === 'blank'): ?>
                        <p class="error addtask_error">* タスク名を入力してください</p>
                        <?php endif; ?>
                    <div class="modify_addtask_submitbutton">
                        <input type="submit" value="修正登録">
                        <a href="delete_task.php?task_id=<?= $_REQUEST['task_id'] ?>" class="modify_delete_task">削除×</a>
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