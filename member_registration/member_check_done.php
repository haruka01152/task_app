<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
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
            <div class="header-logo">
                <h1><img src="../common/img/logo.png" alt=""></h1>
            </div>
        </div>
    </header>


    <main class="main">
        <div class="container">
            <div class="inputarea">
                <div class="inputarea_title">
                    <span>登録情報確認</span>
                </div>

                <div class="check_done">
                    <p>メンバー登録が完了しました。</p>

                    <a id="goto_login_button" href="../login/index.php">ログイン画面へ</a>
                </div>
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