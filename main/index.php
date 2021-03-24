<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}

$week = ['日', '月', '火', '水', '木', '金', '土', '日'];

$member['id'] = $_SESSION['id'];

$bday = new DateTime();
$today = $bday->format('Y-m-d');

$statement = $db->prepare('SELECT * FROM members WHERE id=?');
$statement->execute(array($member['id']));
$loginmember = $statement->fetch();

$sql_forcount = 'SELECT COUNT(*) as cnt FROM tasks WHERE member_id=' . $member['id'];
$counts = $db->query($sql_forcount);
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 5);


if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];

    if ($_GET['page'] > $max_page || $_GET['page'] < 1) {
        header('Location: index.php');
        exit();
    }

} else {
    $page = 1;
}

$start = 5 * ($page - 1);

$sql = 'SELECT * FROM tasks WHERE member_id=? ORDER BY id DESC LIMIT ' . $start . ', 5';
$tasks = $db->prepare($sql);
$tasks->execute(array($loginmember['id']));

$tasks_today = $db->prepare('SELECT * FROM tasks WHERE member_id=? AND date=?ORDER BY datetime LIMIT 0, 3');
$tasks_today->execute(array(
    $loginmember['id'],
    $today
));

$tasks_recent = $db->prepare('SELECT * FROM tasks WHERE member_id=? AND datetime > CURDATE()+1 AND CURDATE()+4 > datetime ORDER BY datetime LIMIT 0, 5');
$tasks_recent->execute(array($loginmember['id']));

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
    <title>トップ | タスク管理</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="colormode">
                <span>カラーモード選択</span>
                <form class="colors" method="post" action="">
                    <div class="color simple" id="simpleblock" onclick="changeColor('simpleblock')">
                        <input type="radio" name="colormode" id="simple" value="simple" checked>
                        <label for="simple">シンプル</label>
                    </div>
                    <div class="color natural" id="naturalblock">
                        <input type="radio" name="colormode" id="natural" value="natural">
                        <label for="natural">ナチュラル</label>
                    </div>
                    <div class="color dark" id="darkblock">
                        <input type="radio" name="colormode" id="dark" value="dark">
                        <label for="dark">ダーク</label>
                    </div>
                    <div class="color cute" id="cuteblock">
                        <input type="radio" name="colormode" id="cute" value="cute">
                        <label for="cute">キュート</label>
                    </div>
                    <input type="submit" id="colormodesubmit" name="colormodesubmit" value="OK">
                </form>

                <script>
                    function changeColor(idname){
                        let obj = document.getElementById(idname);
                        obj.style.color = '#fff';
                        obj.style.backgroundColor = '#000';
                    }
                </script>
            </div>
            <div class="logout_button">
                <a href="logout.php">ログアウト</a>
            </div>
        </div>
    </header>


    <section class="main">
        <div class="container">
            <div class="greet">
                <p><?= htmlspecialchars($loginmember['user_id'], ENT_QUOTES | ENT_HTML5) ?>さん、おつかれさまです</p>
            </div>

            <section class="main_contents">
                <div class="main_contents_left">
                    <!-- <div class="main_task_tabarea">
                        <div class="tab tab-active">
                            <span>tab1</span>
                        </div>
                        <div class="tab">
                            <span>tab2</span>
                        </div>
                        

                        <a href="modify_category.php" class="change_category_button">カテゴリ編集</a>
                        <input type="hidden" name="category_id" value="">

                    </div> -->

                    <div class="main_task_areas">
                        <div class="main_task_area main_task_area_show">
                            <div class="main_task_area_title">
                                <h1>すべてのタスク</h1>
                                <a href="add_task.php" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                            </div>

                            <div class="main_tasks">
                                <?php while ($task = $tasks->fetch()) : ?>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date"><?= date("Y-m-d", strtotime($task['datetime'])) . '（' . $week[date("w", strtotime($task['datetime']))] . '）' . date("H:i", strtotime($task['datetime'])) ?></span>
                                            <a href="modify_task.php?task_id=<?= $task['id'] ?>" class="task_name"><?= htmlspecialchars($task['task_name'],ENT_QUOTES | ENT_HTML5); ?></a>
                                        </div>

                                        <div class="main_task_right">
                                            <a href="delete_task.php?task_id=<?= $task['id'] ?>" id="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endwhile; ?>
                            </div>

                            <!-- ページネーションボタン -->
                            <?php if ($_GET['page'] >= 2) : ?>
                                <a href="index.php?page=<?= $page - 1 ?>"><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                            <?php endif; ?>
                            <?php if ($page < $max_page) : ?>
                                <a href="index.php?page=<?= $page + 1 ?>"><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="main_contents_right">
                    <div class="main_contents_right_top">
                        <div class="main_contents_right_top_title">
                            <i class="fas fa-lightbulb fa-2x"></i>
                            <h2>今日のご予定</h2>
                        </div>

                        <div class="right_top_taskarea">
                            <div class="right_top_tasks">
                                <?php while ($task_today = $tasks_today->fetch()) : ?>
                                    <div class="right_top_task">
                                        <span class="right_top_time"><?= date("H:i", strtotime($task_today['datetime'])) ?></span>

                                        <a href="modify_task.php?task_id=<?= $task_today['id'] ?>" class="task_name"><?= htmlspecialchars($task_today['task_name'],ENT_QUOTES | ENT_HTML5); ?></a>
                                    </div>
                                    <hr>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="main_contents_right_bottom">
                        <div class="main_contents_right_bottom_title">
                            <i class="fas fa-exclamation fa-2x"></i>
                            <h3>もうすぐしめきりのご予定</h3>
                        </div>

                        <div class="right_bottom_taskarea">
                            <div class="right_bottom_tasks">
                                <?php while ($task_recent = $tasks_recent->fetch()) : ?>
                                    <div class="right_bottom_task">
                                        <span class="right_bottom_time"><?= date("m-d", strtotime($task_recent['datetime'])) . '（' . $week[date("w", strtotime($task_recent['datetime']))] . '）' ?></span>

                                        <a href="modify_task.php?task_id=<?= $task_recent['id'] ?>" class="task_name"><?= htmlspecialchars($task_recent['task_name'],ENT_QUOTES | ENT_HTML5); ?></a>
                                    </div>
                                    <hr>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>


    <footer>
        <div class="container">
            <div class="copyright">
                <span>© 2021 All Rights Reserved.</span>
            </div>
        </div>
    </footer>


    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
</script> -->

</body>

</html>