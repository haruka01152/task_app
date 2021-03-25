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

//カラーモード選択ファイルへ持っていく値
$_SESSION['loginmember']['user_id'] = $loginmember['user_id'];


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
    <?php if ($loginmember['colormode'] === '1') : ?>
        <link rel="stylesheet" href="../common/css/colormode1.css">
    <?php elseif ($loginmember['colormode'] === '3') : ?>
        <link rel="stylesheet" href="../common/css/colormode3.css">
    <?php elseif ($loginmember['colormode'] === '4') : ?>
        <link rel="stylesheet" href="../common/css/colormode4.css">
    <?php endif; ?>
    <title>トップ | タスク管理</title>
</head>

<body>

    <header id="header">
        <div class="container">
            <div class="colormode">
                <span>カラーモード選択</span>
                <form class="colors" method="post" action="colormode.php">
                    <div class="color simple">
                        <input type="radio" name="colormode" id="simple" value="simple" <?php if ($loginmember['colormode'] === '1') : ?> checked<?php endif; ?>>
                        <label for="simple">シンプル</label>
                    </div>
                    <div class="color natural">
                        <input type="radio" name="colormode" id="natural" value="natural" <?php if ($loginmember['colormode'] === '2') : ?> checked<?php endif; ?>>
                        <label for="natural">ナチュラル</label>
                    </div>
                    <div class="color dark">
                        <input type="radio" name="colormode" id="dark" value="dark" <?php if ($loginmember['colormode'] === '3') : ?> checked<?php endif; ?>>
                        <label for="dark">ダーク</label>
                    </div>
                    <div class="color cute">
                        <input type="radio" name="colormode" id="cute" value="cute" <?php if ($loginmember['colormode'] === '4') : ?> checked<?php endif; ?>>
                        <label for="cute">キュート</label>
                    </div>
                    <input type="submit" id="colormodesubmit" name="colormodesubmit" value="OK">
                </form>
            </div>
            <div class="logout_button">
                <a href="logout.php">ログアウト</a>
            </div>

            <div class="menu">
                <div class="menu_icon" id=menu_icon>
                    <span>　　　</span>
                    <span>　　　</span>
                    <span>　　　</span>
                </div>

                <div class="menu_lists" id=menu_lists>
                    <form action="colormode.php" method="post">
                        <span>カラーモード選択：</span>
                        <button type="submit" value="simple">シンプル</button>
                        <button type="submit" value="natural">ナチュラル</button>
                        <button type="submit" value="dark">ダーク</button>
                        <button type="submit" value="cute">キュート</button>
                    </form>
                    <div class="logout_button_sp">
                        <a href="logout.php">ログアウト</a>
                    </div>
                </div>
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
                                            <a href="modify_task.php?task_id=<?= $task['id'] ?>" class="task_name"><?= htmlspecialchars($task['task_name'], ENT_QUOTES | ENT_HTML5); ?></a>
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

                                        <a href="modify_task.php?task_id=<?= $task_today['id'] ?>" class="task_name"><?= htmlspecialchars($task_today['task_name'], ENT_QUOTES | ENT_HTML5); ?></a>
                                    </div>
                                    <hr>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="main_contents_right_bottom">
                        <div class="main_contents_right_bottom_title">
                            <i class="fas fa-exclamation fa-2x"></i>
                            <h3>もうすぐしめきりの<br class="sp-br">ご予定</h3>
                        </div>

                        <div class="right_bottom_taskarea">
                            <div class="right_bottom_tasks">
                                <?php while ($task_recent = $tasks_recent->fetch()) : ?>
                                    <div class="right_bottom_task">
                                        <span class="right_bottom_time"><?= date("m-d", strtotime($task_recent['datetime'])) . '（' . $week[date("w", strtotime($task_recent['datetime']))] . '）' ?></span>

                                        <a href="modify_task.php?task_id=<?= $task_recent['id'] ?>" class="task_name"><?= htmlspecialchars($task_recent['task_name'], ENT_QUOTES | ENT_HTML5); ?></a>
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

    <footer id="footer">
        <div class="container">
            <div class="copyright">
                <span>© 2021 All Rights Reserved.</span>
            </div>
        </div>
    </footer>

    <script>
        let menuicon = document.getElementById("menu_icon");

        menuicon.addEventListener("click", function() {
            let menulist = document.getElementById('menu_lists');
            menulist.classList.toggle('show');
            menuicon.classList.toggle('open');
        });

    </script>

</body>

</html>