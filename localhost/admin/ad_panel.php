<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles/stylead.css" rel="stylesheet" type="text/css">
  <title>Admin Panel</title>
  <script>
    function deleteRoute(id) {
      if (confirm("Ви впевнені, що хочете видалити цей маршрут?")) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "../crud/delete.php");

        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "id");
        input.setAttribute("value", id);

        form.appendChild(input);

        document.body.appendChild(form);

        form.submit();
      }
    }

    document.querySelector('.create').addEventListener('submit', function(event) {
      var fileInput = document.getElementById('image1');
      if (fileInput.files.length === 0) {
        event.preventDefault();
        alert('Будь ласка, оберіть зображення');
      }
    });
  </script>
</head>
<body>
  <div class="cen">
    <?php if (!empty($_SESSION['login'])) : ?>

    <p class="ad_kab">Адміністраторський кабінет</p>
      <a href="logout.php">Вийти</a>

      <br>
      <h1>Редагування інформації про маршрути</h1>
      <?php
      $dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
      $pdo = new PDO($dsn, "mysql", "mysql");
      $sql = $pdo->prepare("SELECT * FROM routes");
      $sql->execute();
      $routes = $sql->fetchAll(PDO::FETCH_OBJ);
      ?>
      <table class="tab">
        <tr>
          <th>
            <label for="start">Початкова станція</label>
          </th>
          <th>
            <label for="finish">Кінцева станція</label>
          </th>
          <th>
            <label for="time1">Години поїздки</label>
          </th>
          <th>
            <label for="startt">Час відбуття</label>
          </th>
          <th>
            <label for="finisht">Час прибуття</label>
          </th>
          <th>
            <label for="train">Назва поїзда</label>
          </th>
          <th>
            <label for="dat">Дата</label>
          </th>
          <th>
            <label for="image">Зображення</label>
          </th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($routes as $route): ?>
  <form action="../crud/update.php" method="post" enctype="multipart/form-data">
    <tr>
      <td>
        <input type="text" id="start" name="start" value="<?php echo $route->start_station ?>">
      </td>
      <td>
        <input type="text" id="finish" name="finish" value="<?php echo $route->end_station ?>">
      </td>
      <td>
        <input type="text" id="time1" name="time1" value="<?php echo $route->time ?>">
      </td>
      <td>
        <input type="text" id="startt" name="startt" value="<?php echo $route->start_time ?>">
      </td>
      <td>
        <input type="text" id="finisht" name="finisht" value="<?php echo $route->end_time ?>">
      </td>
      <td>
        <input type="text" id="train" name="train" value="<?php echo $route->name_train ?>">
      </td>
      <td>
        <input type="text" id="dat" name="dat" value="<?php echo $route->data ?>">
      </td>
      <td>
        <select id="image" name="image">
          <option value="">Обрати зображення</option>
          <?php
          $imagePath = "../img/";
          $images = scandir($imagePath);
          foreach ($images as $image) {
            if ($image != '.' && $image != '..') {
              $selected = ($image == $route->img) ? 'selected' : '';
              echo '<option value="' . $image . '" ' . $selected . '>' . $image . '</option>';
            }
          }
          ?>
        </select>
              </td>
              <td>
                <input type="hidden" id="id" name="id" value="<?php echo $route->id_rout ?>">
              </td>
              <td>
                <input type="submit" value="Зберегти">
              </td>
              <td align="left">
                <button type="button" onclick="deleteRoute(<?php echo $route->id_rout; ?>)">Видалити</button>
              </td>
            </tr>
          </form>
        <?php endforeach; ?>
      </table>
      <div class="dm">
        <form class="create" action="../crud/create.php" method="post">
          <label for="start1">Станція відправлення:</label>
          <input type="text" id="start1" name="start1">
          <label for="finish1">Станція прибуття:</label>
          <input type="text" id="finish1" name="finish1">
          <label for="time2">Час поїздки:</label>
          <input type="time" id="time2" name="time2">
          <label for="startt1">Час відбуття:</label>
          <input type="time" id="startt1" name="startt1">
          <label for="finisht1">Час прибуття:</label>
          <input type="time" id="finisht1" name="finisht1">
          <label for="train1">Поїзд:</label>
          <input type="text" id="train1" name="train1">
          <label for="dat1">Дата:</label>
          <input type="date" id="dat1" name="dat1">

          <button type="submit">Додати новий маршрут</button>
        </form>
      </div>
      <div class="zob">
      <h1>Завантаження зображення</h1>

        <form action="../crud/upload.php" method="post" enctype="multipart/form-data">
          <label for="image">Оберіть зображення:</label>
          <input type="file" id="image" name="image">
          <button type="submit">Завантажити</button>
        </form>


<h1>Видалення зображення</h1>

<form action="../crud/unload.php" method="post">
  <label for="imageSelect">Оберіть зображення для видалення:</label>
  <select id="imageSelect" name="filename">
    <?php
    $dsn = "mysql:host=127.0.0.1;dbname=Base;charset=UTF8";
    $pdo = new PDO($dsn, "root", "tttt");

    $sql = "SELECT img FROM routes WHERE img != ''";
    $stm = $pdo->prepare($sql);
    $stm->execute();

    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['img'] . '">' . $row['img'] . '</option>';
    }
    ?>
  </select>
  <button type="submit">Видалити</button>
</form>
</div>


    <?php else: ?>
      <h2>Ви не маєте доступу до адміністраторської панелі!</h2>
      <a href="../index.php">На головну</a>
    <?php endif ?>
  </div>
</body>
</html>
