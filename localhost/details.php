<?php
$dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
$pdo = new PDO($dsn, "mysql", "mysql");
$id = $_GET['id'];

$query = "SELECT * FROM routes WHERE id_rout = :id";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $trainName = $row['name_train'];
    $start = $row['start_time'];
    $end = $row['end_time'];
    $duration = $row['time'];
    $imagePath = $row['img'];

    $startTime = date('H:i', strtotime($start));
    $endTime = date('H:i', strtotime($end));
    $duration = date('H:i' , strtotime($duration));
    echo '<link rel="stylesheet" href="styles/styled.css">';

    echo '<div class="cont">';
    echo '<p class="l">Детальна інформація про маршрут</p>';
    echo'</div>';
      echo '<div class="cont">';
    echo '<div class="jk">';
    echo '<p>Назва потягу: '.$trainName.'</p>';
    echo '<p>Час відправлення: '.$startTime.'</p>';
    echo '<p>Час прибуття: '.$endTime.'</p>';
    echo '<p>Час поїздки: '.$duration.'</p>';
    echo'</div>';
    echo'</div>';
    echo'<br>';
    echo'<br>';
    echo'<br>';
    if ($imagePath) {
           echo '<div class="i">';
        echo '<img src="'.$imagePath.'" alt="Маршрут">';
          echo'  </div>';
    }
     else {
       echo '<div class="con">';
    echo 'Додаткової інформації про маршрут немає.';
  echo'  </div>';
}
}
?>
