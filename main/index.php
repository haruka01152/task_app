<?php
session_start();
session_regenerate_id(true);

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../login/index.php');
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
    <title>トップ | タスク管理</title>
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
            <div class="greet">
                <p><?= htmlspecialchars($loginmember['user_id'], ENT_QUOTES | ENT_HTML5) ?>さん、おつかれさまです</p>
            </div>

            <section class="main_contents">
                <div class="main_contents_left">
                    <div class="main_task_tabarea">
                        <div class="tab tab-active">
                            <span>tab1</span>
                        </div>
                        <div class="tab">
                            <span>tab2</span>
                        </div>
                        <div class="tab">
                            <span>tab3</span>
                        </div>
                        <div class="tab">
                            <span>tab4</span>
                        </div>
                        <div class="tab">
                            <span>tab5</span>
                        </div>
                        <div class="tab">
                            <span>tab6</span>
                        </div>
                        <div class="tab">
                            <span>tab7</span>
                        </div>

                        <a href="" class="change_category_button">カテゴリ編集</a>

                    </div>

                    <div class="main_task_areas">
                        <div class="main_task_area main_task_area_show">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名1</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            <a href="" class="change_task"></a>
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                    <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                    <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                    <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                    <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                        <div class="main_task_area">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名2</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                        <div class="main_task_area">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名3</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                        <div class="main_task_area">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名4</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                        <div class="main_task_area">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名5</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                        <div class="main_task_area">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名6</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                        <div class="main_task_area">
                                <div class="main_task_area_title">
                                    <h1>カテゴリ名7</h1>
                                    <a href="" class="add_task"><i class="fas fa-plus-circle fa-3x"></i></a>
                                </div>

                                <div class="main_tasks">
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="main_task">
                                        <div class="main_task_left">
                                            <span class="date">〇月〇日（〇） 13:00</span>
                                            <a href="" class="task_name">テキストが入ります。</a>
                                        </div>
                                        
                                        <div class="main_task_right">
                                            
                                            <a href="" class="delete_task">削除×</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <a href=""><i class="fas fa-chevron fa-chevron-circle-left fa-2x"></i></a>
                                <a href=""><i class="fas fa-chevron fa-chevron-circle-right fa-2x"></i></a>
                        </div>

                    </div>
                </div>
                <div class="main_contents_right">
                    <div class="main_contents_right_top">
                        <div class="main_contents_right_top_title">
                        <i class="fas fa-lightbulb fa-2x"></i><h2>今日のご予定</h2>
                        </div>

                        <div class="right_top_taskarea">
                            <div class="right_top_tasks">
                                <div class="right_top_task">
                                    <span class="right_top_time">13:00</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                                <div class="right_top_task">
                                    <span class="right_top_time">13:00</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                                <div class="right_top_task">
                                    <span class="right_top_time">13:00</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="main_contents_right_bottom">
                        <div class="main_contents_right_bottom_title">
                            <i class="fas fa-exclamation fa-2x"></i><h3>もうすぐしめきりのご予定</h3>
                        </div>

                        <div class="right_bottom_taskarea">
                            <div class="right_bottom_tasks">
                                <div class="right_bottom_task">
                                    <span class="right_bottom_time">〇月〇日</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                                <div class="right_bottom_task">
                                    <span class="right_bottom_time">〇月〇日</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                                <div class="right_bottom_task">
                                    <span class="right_bottom_time">〇月〇日</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                                <div class="right_bottom_task">
                                    <span class="right_bottom_time">〇月〇日</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
                                <div class="right_bottom_task">
                                    <span class="right_bottom_time">〇月〇日</span>

                                    <a href="" class="task_name">テキストが入ります。</a>
                                </div>
                                <hr>
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