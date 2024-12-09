<?php
$filename = $_POST['filename'];

$dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
$pdo = new PDO($dsn, "mysql", "mysql");

$sql = $pdo->prepare("SELECT id_rout FROM routes WHERE img = :filename");
$sql->execute(['filename' => $filename]);
$row = $sql->fetch(PDO::FETCH_ASSOC);
$id = $row['id_rout'];

$directory = '../img/';
$path = $directory . $filename;
if (file_exists($path)) {
    unlink($path);
}

$sql = "UPDATE routes SET img = '' WHERE id_rout = :id";
$stm = $pdo->prepare($sql);
$stm->execute(['id' => $id]);

header('Location: ../admin/ad_panel.php');
?>
