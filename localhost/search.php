<?php
$dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
$pdo = new PDO($dsn, "mysql", "mysql");

if (isset($_POST['startStation']) && isset($_POST['endStation']) && isset($_POST['date'])) {

  $startStation = $_POST['startStation'];
  $endStation = $_POST['endStation'];
  $date = $_POST['date'];

  $query = "SELECT * FROM routes WHERE start_station = :startStation AND end_station = :endStation AND data = :date";

  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':startStation', $startStation);
  $stmt->bindValue(':endStation', $endStation);
  $stmt->bindValue(':date', $date);

  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    echo '<div class="result1">';
    echo '<link rel="stylesheet" href="styles/style.css">';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $idRout = $row['id_rout'];
      $trainName = $row['name_train'];
      $start = $row['start_time'];
      $end = $row['end_time'];
      $duration = $row['time'];


      $startTime = date('H:i', strtotime($start));
      $endTime = date('H:i', strtotime($end));
      $time = date('H:i', strtotime($duration));

      echo '<a href="details.php?id='.$idRout.'" class="route-button">';
      echo $trainName.': '.$startTime.'-'.$endTime.'<br>';
      echo 'Час поїздки: '.$time.' '.$startStation.' - '.$endStation.'<br>';
      echo '</a>';
    }
    echo '</div>';
}
else {
  echo '<h2>Маршрути не знайдено.<h2>';
;
  }
}
?>
