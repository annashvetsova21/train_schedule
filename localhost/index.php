<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="styles/stylehtml.css" rel="stylesheet" type="text/css">
  <title>Train schedule</title>
</head>
<body>
  <div class="he">
    <div class="head1">
      <img src="images/head1.png" class="he1">
    </div>
    <div class="nad">
      <h1 class="a">Розклад руху потягів</h1>
    </div>
    <div class="head1">
        <img src="images/head2.png" class="he2">
    </div>
</div>

  <div class="search-container">
  <form id="search1" name="search1" method="post" action="search.php">
    <div class="form-group">
      <label class="label" for="startStation">Станція відправлення:</label>
      <input type="text" id="startStation" name="startStation" required>
    </div>
    <div class="form-group">
      <label class="label" for="endStation">Станція прибуття:</label>
      <input type="text" id="endStation" name="endStation" required>
    </div>
    <div class="form-group">
      <label class="label" for="date">Дата:</label>
      <input type="date" id="date" name="date" required>
    </div>
    <input class="button" type="submit" value="Пошук">
  </form>
</div>

  <script>
    document.getElementById('search1').addEventListener('submit', function(event) {
      event.preventDefault();

      var startStation = document.getElementById('startStation').value;
      var endStation = document.getElementById('endStation').value;
      var date = document.getElementById('date').value;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'search.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('result1').innerHTML = xhr.responseText;
        }
      };
      xhr.send('startStation=' + startStation + '&endStation=' + endStation + '&date=' + date);
    });
  </script>
  <div id="result1"></div>
  <div class="admin-window" id="adminWindow">
      <h2>Увійдіть як адміністратор</h2>
      <form action="admin/admin.php" method="post">
        <label>Логін</label>
        <input type="text" name="login" placeholder="Введіть свій логін">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введіть пароль">
        <button type="submit">Увійти</button>
      </form>
</body>
</html>
