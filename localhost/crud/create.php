<?php
$dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
$pdo = new PDO($dsn, "mysql", "mysql");

$start1 = $_POST['start1'];
$finish1 = $_POST['finish1'];
$time2 = $_POST['time2'];
$startt1 = $_POST['startt1'];
$finisht1 = $_POST['finisht1'];
$dat1 = $_POST['dat1'];
$train1 = $_POST['train1'];
$time2 = $time2 . ':00';
$startt1 = $startt1 . ':00';
$finisht1 = $finisht1 . ':00';

$sql = $pdo->prepare("SELECT COALESCE(MAX(id_rout), 0) AS max_id FROM routes");
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);
$maxId = $row['max_id'];

$sql = "INSERT INTO routes (id_rout, start_station, end_station, time, start_time, end_time, name_train, data)
        VALUES (:id, :start1, :finish1, :time2, :startt1, :finisht1, :train1, :dat1)";

$stm = $pdo->prepare($sql);
$stm->execute([
    'id' => $maxId + 1,
    'start1' => $start1,
    'finish1' => $finish1,
    'time2' => $time2,
    'startt1' => $startt1,
    'finisht1' => $finisht1,
    'train1' => $train1,
    'dat1' => $dat1
]);

header('Location: ../admin/ad_panel.php');
?>
