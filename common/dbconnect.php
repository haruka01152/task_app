<?php

try{
    $db = new PDO('mysql:dbname=v3b9t_62234;host=mysql52.conoha.ne.jp;charset=utf8','v3b9t_task_app', 'hamutarou1151@');

}catch(PDOException $e){
    echo nl2br('DB接続エラー：'. $e->getMessage() ."\nただいまデータベース障害が発生しております。申し訳ございませんが、しばらく経ってから再度アクセスをお願い致します。");
}