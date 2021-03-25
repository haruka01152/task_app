<?php
session_start();

require_once '../common/dbconnect.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}

//カラーモード選択
if ($_POST['colormodesubmit']) {

    switch ($_POST['colormode']) {

        case 'simple':
            $colormode = 1;
            break;

        case 'natural':
            $colormode = 2;
            break;

        case 'dark':
            $colormode = 3;
            break;

        case 'cute':
            $colormode = 4;
            break;
    }

    if ($colormode !== '') {
        $color_db = $db->prepare('UPDATE members SET colormode=? WHERE user_id=?');
        $color_db->execute(array($colormode, $_SESSION['loginmember']['user_id']));
    
        header('Location: index.php');
        exit();
    
    }else{
        echo '問題が発生しました。しばらく経ってから再度お試しください。';
    }
    
}



