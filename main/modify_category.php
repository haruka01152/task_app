<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
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
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> 
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="../common/css/style_main.css">
    <title>カテゴリ編集 | タスク管理</title>
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
                <span>カテゴリ編集</span>
            </div>

            <div class="modifycategory_area">

                <form method="post" action="" id="addtask_forms">
                    <div class="addtask_form datetime">
                        <span id="datetime_label">日時</span>
                        <input type="datetime-local" name="datetime" id="datetime">
                    </div>
                    <div class="addtask_form task_name">
                        <span id="task_name_label">タスク名</span>
                        <input type="text" name="task_name" id="task_name">
                    </div>
                    <div class="addtask_form detail">
                        <span id="task_detail_label">詳細メモ</span>
                        <textarea name="task_detail" id="task_detail" cols="30" rows="10"></textarea>
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


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
    $(function() {
  let tabs = $(".tab"); // tabのクラスを全て取得し、変数tabsに配列で定義
  $(".tab").on("click", function() { // tabをクリックしたらイベント発火
    $(".tab-active").removeClass("tab-active"); // activeクラスを消す
    $(this).addClass("tab-active"); // クリックした箇所にactiveクラスを追加
    const index = tabs.index(this); // クリックした箇所がタブの何番目か判定し、定数indexとして定義
    $(".main_task_area").removeClass("main_task_area_show").eq(index).addClass("main_task_area_show"); // showクラスを消して、contentクラスのindex番目にshowクラスを追加
  })
})
</script>

</body>

</html>