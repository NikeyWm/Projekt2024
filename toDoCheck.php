<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('dbconnection.php');

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
    $uid = $_SESSION['uid'];

    $stmt = $pdo->prepare("UPDATE aufgaben SET fertig = 1 WHERE tid = ? AND uid = ?");
    $stmt->execute([$tid, $uid]);
}

$filter = $_GET['filter'] ?? 'alle';
header("Location: toDoAnzeigen.php?filter=" . urlencode($filter));
exit();
?>
