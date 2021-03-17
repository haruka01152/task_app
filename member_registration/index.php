<?php
session_start();
session_regenerate_id();

if (!empty($_POST)) {
    //空欄の場合エラー
    if ($_POST['userID'] === '') {
        $error['userID'] = 'blank';
    }
    //15文字より長い場合エラー
    if(!empty($_POST['userID']) && strlen($_POST['userID']) > 15){
        $error['userID'] = 'length';
    }
    //半角英数字じゃない場合エラー
    if(!empty($_POST['userID']) && !preg_match("/^[a-zA-Z0-9]+$/", $_POST['userID'])){
        $error['userID'] = 'length';
    }

    //空欄の場合エラー
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }
    //15文字より長い場合エラー
    if(!empty($_POST['userID']) && strlen($_POST['password']) > 15){
        $error['password'] = 'length';
    }
    //半角英数字じゃない場合エラー
    if(!empty($_POST['userID']) && !preg_match("/^[a-zA-Z0-9]+$/", $_POST['userID'])){
        $error['userID'] = 'length';
    }

    //エラーが起きていなければ確認画面に進む
    if(empty($error)){
        $_SESSION['userID'] = $_POST['userID'];
        $_SESSION['password'] = sha1($_POST['password']);

        header('Location: member_check.php');
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
    <title>メンバー登録 | タスク管理</title>
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
                    <span>メンバー登録</span>
                </div>

                <form action="" method="post">
                    <div class="input_group">
                        <div class="inputs userID">
                            <label for="userID">ユーザーID</label>
                            <input type="text" name="userID" id="userID" value="<?= $_POST['userID']; ?>">
                            <?php if ($error['userID'] === 'blank') : ?>
                                <p class="error">* ユーザーIDを入力してください</p>
                            <?php endif; ?>
                            <?php if ($error['userID'] === 'length') : ?>
                                <p class="error">* ユーザーIDは15文字以下の英数字で入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="inputs password">
                            <label for="password">パスワード</label>
                            <input type="password" name="password" id="password">
                            <?php if ($error['password'] === 'blank') : ?>
                                <p class="error">* パスワードを入力してください</p>
                            <?php endif; ?>
                            <?php if ($error['password'] === 'length') : ?>
                                <p class="error">* パスワードは15文字以下の英数字で入力してください</p>
                            <?php endif; ?>
                        </div>
                        <input type="submit" id="submit_button" value="登録">
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