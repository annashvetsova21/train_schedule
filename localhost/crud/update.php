<?php
$id = $_POST['id'];
$image = $_POST['image'];
$imagePath = '';

if ($image) {
  $imagePath = "../img/" . $image;
}

$dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
$pdo = new PDO($dsn, "mysql", "mysql");

$sql = $pdo->prepare("SELECT * FROM routes WHERE id_rout = :id");
$sql->execute(['id' => $id]);
$route = $sql->fetch(PDO::FETCH_OBJ);

$start = isset($_POST['start']) && $_POST['start'] !== '' ? $_POST['start'] : $route->start_station;
$finish = isset($_POST['finish']) && $_POST['finish'] !== '' ? $_POST['finish'] : $route->end_station;
$time1 = isset($_POST['time1']) && $_POST['time1'] !== '' ? $_POST['time1'] : $route->time;
$startt = isset($_POST['startt']) && $_POST['startt'] !== '' ? $_POST['startt'] : $route->start_time;
$finisht = isset($_POST['finisht']) && $_POST['finisht'] !== '' ? $_POST['finisht'] : $route->end_time;
$dat = isset($_POST['dat']) && $_POST['dat'] !== '' ? $_POST['dat'] : $route->data;
$train = isset($_POST['train']) && $_POST['train'] !== '' ? $_POST['train'] : $route->name_train;

$sql = "UPDATE routes SET start_station = :start, end_station = :finish, time = :time1, start_time = :startt, end_time = :finisht, name_train = :train, data = :dat, img = :img WHERE id_rout = :id";
$std = $pdo->prepare($sql);
$std->execute(['start' => $start, 'finish' => $finish, 'time1' => $time1, 'startt' => $startt, 'finisht' => $finisht, 'train' => $train, 'dat' => $dat, 'img' => $imagePath, 'id' => $id]);

echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../admin/ad_panel.php">';
?>
