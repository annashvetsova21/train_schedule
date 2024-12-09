<?php session_start();?>
<?php
$dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
$pdo = new PDO($dsn, "mysql", "mysql");

$login = $_POST['login'];
$password = $_POST['password'];

$sqr = $pdo->prepare("SELECT id FROM logpass WHERE login=:login AND password=:password");
$sqr->execute(array('login' => $login, 'password' => $password));
$a = $sqr->fetch(PDO::FETCH_ASSOC);
if($a['id'] > 0){
  $_SESSION['login'] = $login;
  header('Location:ad_panel.php');
  exit;
}
else{
  $message = "Неправильний логін або пароль";
   echo "<script>
     window.onload = function() {
       var message = '" . addslashes($message) . "';
       alert(message);
       window.location.href = '../index.php';
     };
   </script>";
   exit;
}
?>
