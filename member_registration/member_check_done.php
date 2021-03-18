<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
}

if(!empty($_SESSION['join'])){
    $statement = $db->prepare('INSERT INTO members SET user_id=?, password=?');
    $statement->execute(array(
        $_SESSION['join']['userID'],
        sha1($_SESSION['join']['password'])
    ));
    unset($_SESSION['join']);

    $alert = 'OK';
}else{
    $alert = 'NG';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="../common/css/style.css">
    <title>登録情報確認 | タスク管理</title>
</head>

<body>

    <header>
        <div class="container">
        </div>
    </header>


    <section class="main">
        <div class="container">
            <div class="inputarea">
                <div class="inputarea_title">
                    <span>登録情報確認</span>
                </div>

                <div class="check_done">
                    <?php if($alert === 'OK'): ?>
                        <p>アカウント登録が完了しました。</p>
                    <?php else: ?>
                        <p>問題が発生しました。<br>恐れ入りますが最初からやり直してください。</p>
                    <?php endif; ?>

                    <a id="goto_login_button" href="../login/index.php">ログイン画面へ</a>
                </div>
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