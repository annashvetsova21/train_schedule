<?php
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
  $targetDir = '../img/';
  $targetFile = $targetDir . basename($_FILES['image']['name']);

  if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
    $message = 'Зображення успішно завантажено.';
  }
  else{
    $message = 'Виникла помилка при завантаженні зображення.';
  }
}
else {
  $message = 'Помилка завантаження зображення: ' . $_FILES['image']['error'];
}

echo "<script>
  window.onload = function() {
    var message = '" . addslashes($message) . "';
    alert(message);
    window.location.href = '../admin/ad_panel.php';
  };
</script>";
exit;
?>
