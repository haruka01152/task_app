<?php
session_start();

require_once '../common/dbconnect.php';

if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
    exit();
}


$statement = $db->prepare('DELETE FROM tasks WHERE id=?');
$statement->execute(array($_REQUEST['task_id']));

header('Location: delete_task_done.php');
exit();