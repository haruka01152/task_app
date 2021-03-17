<?php
session_start();

$_SESSION = [];

if(ini_set('session.use_cookies')){
    $params = session_get_cookie_params();
    setcookie(session_name() . '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();

setcookie('email', '', time() - 3600);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="../common/css/style.css">
    <title>ログアウト | タスク管理</title>
</head>

<body>

    <header>
        <div class="container">
        </div>
    </header>


    <main class="main">
        <div class="container">
            <div class="inputarea">
                <div class="inputarea_title">
                    <span>ログアウト</span>
                </div>

                <div class="logout_message">
                    <p>ログアウトしました。</p><br><br>
                    <a href="../login/index.php">ログイン画面へ</a>
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