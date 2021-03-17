<?php
session_start();
session_regenerate_id(true);

if(!empty($_POST)){
    //空欄の場合エラー
    if ($_POST['userID'] === '') {
        $error['userID'] = 'blank';
    }
    //空欄の場合エラー
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    //エラーが起きていなければポストの値をセッションに渡して確認画面に進む
    if(empty($error)){
        $_SESSION['join'] = $_POST;

        header('Location: ../main/index.php');
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
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="../common/css/style.css">
    <title>ログイン | タスク管理</title>
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
                    <span>ログイン</span>
                </div>

                <form action="" method="post">
                    <div class="input_group">
                        <div class="inputs userID">
                            <label for="userID">ユーザーID</label>
                            <input type="text" name="userID" id="userID" value="<?= htmlspecialchars($_POST['userID'], ENT_QUOTES | ENT_HTML5); ?>">
                            <?php if ($error['userID'] === 'blank') : ?>
                                <p class="error">* ユーザーIDを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="inputs password">
                            <label for="password">パスワード</label>
                            <input type="password" name="password" id="password">
                            <?php if ($error['password'] === 'blank') : ?>
                                <p class="error">* パスワードを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <input type="submit" id="submit_button" value="ログイン">
                    </div>
                </form>
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