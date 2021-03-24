<?php

try{
    $db = new PDO('mysql:dbname=task_app;host=localhost;port=8889;charset=utf8','root', 'root');

}catch(PDOException $e){
    echo nl2br('DB接続エラー：'. $e->getMessage() ."\nただいまデータベース障害が発生しております。申し訳ございませんが、しばらく経ってから再度アクセスをお願い致します。");
}