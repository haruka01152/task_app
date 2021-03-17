<?php

try{
    $db = new PDO('mysql:dbname=task_app;host=127.0.0.1;charset=utf8', 'root', '');

}catch(PDOException $e){
    echo 'DB接続エラー：'. $e->getMessage() ."\nただいまデータベース障害が発生しております。申し訳ございませんが、しばらく経ってから再度アクセスをお願い致します。";
}