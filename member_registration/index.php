<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!empty($_POST)){
    //空欄の場合エラー
    if ($_POST['userID'] === '') {
        $error['userID'] = 'blank';
    }
    //15文字より長い場合エラー
    if(strlen($_POST['userID']) > 15){
        $error['userID'] = 'length';
    }
    //空欄の場合エラー
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }
    //15文字より長い場合エラー
    if(strlen($_POST['password']) > 15){
        $error['password'] = 'length';
    }

    //アカウントの重複をチェック
    if(empty($error)){
        $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE user_id=?');
        $member->execute(array($_POST['userID']));
        $record = $member->fetch();

        if($record['cnt'] > 0){
            $error['userID'] = 'duplicate';
        }
    }

    //エラーが起きていなければポストの値をセッションに渡して確認画面に進む
    if(empty($error)){
        $_SESSION['join'] = $_POST;

        header('Location: member_check.php');
        exit();
    }
}

//書き直しで戻ってきたらセッションの値をポストに戻す
if($_REQUEST['action'] === 'rewrite'){
    $_POST = $_SESSION['join'];
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
    <title>アカウント登録 | タスク管理</title>
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
                    <span>アカウント登録</span>
                </div>

                <form action="" method="post">
                    <div class="input_group">
                        <div class="inputs userID">
                            <label for="userID">ユーザーID</label>
                            <input type="text" name="userID" id="userID" value="<?= htmlspecialchars($_POST['userID'], ENT_QUOTES | ENT_HTML5); ?>">
                            <?php if ($error['userID'] === 'blank') : ?>
                                <p class="error">* ユーザーIDを入力してください</p>
                            <?php endif; ?>
                            <?php if ($error['userID'] === 'length') : ?>
                                <p class="error">* ユーザーIDは15文字以下の英数字で入力してください</p>
                            <?php endif; ?>
                            <?php if ($error['userID'] === 'duplicate') : ?>
                                <p class="error">* このユーザーIDはすでに登録されています</p>
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
                        <a id="goto_login_button" href="../login/index.php">アカウントをお持ちの方はこちら</a>
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