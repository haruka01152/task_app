<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../login/index.php');
    exit();
}

$member['id'] = $_SESSION['id'];

$statement = $db->prepare('SELECT * FROM members WHERE id=?');
$statement->execute(array($member['id']));
$loginmember = $statement->fetch();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="../common/css/style_main.css">
    <title>トップ | タスク管理</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="logout_button">
                <a href="logout.php">ログアウト</a>
            </div>
        </div>
    </header>


    <main class="main">
        <div class="container">
            <div class="greet">
                <p><?= $loginmember['user_id'] ?>さん、おつかれさまです</p>
            </div>
        </div>
    </main>


    <footer>
        <div class="container">
            <div class="copyright">
                <span>© 2021 All Rights Reserved.</span>
            </div>
        </div>
    </footer>

</body>

</html>