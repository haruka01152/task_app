<?php
require_once '../common/dbconnect.php';

$statement = $db->prepare('DELETE FROM tasks WHERE id=?');
$statement->execute(array($_REQUEST['task_id']));

header('Location: index.php');
exit();