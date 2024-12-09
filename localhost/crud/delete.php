<?php
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $dsn = "mysql:host=127.0.0.1;dbname=base;charset=UTF8";
    $pdo = new PDO($dsn, "mysql", "mysql");

    $sql = $pdo->prepare("SELECT id_rout FROM routes WHERE id_rout = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $deletedRowOrder = $row['id_rout'];

    $sql = $pdo->prepare("DELETE FROM routes WHERE id_rout = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();

    $sql = $pdo->prepare("UPDATE routes SET id_rout = id_rout - 1 WHERE id_rout > :order");
    $sql->bindParam(':order', $deletedRowOrder);
    $sql->execute();

    $sql = $pdo->prepare("SELECT MAX(id_rout) AS max_id FROM routes");
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $maxId = $row['max_id'];

    $sql = $pdo->prepare("SET @num := 0");
    $sql->execute();

    $sql = $pdo->prepare("UPDATE routes SET id_rout = (@num := @num + 1) ORDER BY id_rout ASC");
    $sql->execute();

    header("Location: ../admin/ad_panel.php");
    exit();
}
?>
