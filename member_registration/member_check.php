<?php
session_start();
session_regenerate_id(true);

if(!isset($_SESSION['join'])){
    header('Location: ../index.php');
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
        </div>
    </header>


    <section class="main">
        <div class="container">
            <div class="inputarea">
                <div class="inputarea_title">
                    <span>登録情報確認</span>
                </div>

                <div class="display_areas">
                    <div class="display_area userID">
                        <span class="userID_label">ユーザーID</span>
                        <span class="userID"><?= htmlspecialchars($_SESSION['join']['userID'], ENT_QUOTES | ENT_HTML5) ?></span>
                    </div>
                    <div class="display_area password">
                        <span class="password_label">パスワード</span>
                        <span class="password">表示されません</span>
                    </div>
                </div>

                <div class="confirm_buttons">
                    <a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a>
                    <form method="post" action="member_check_done.php">
                        <input type="submit" value="登録する">
                    </form>
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