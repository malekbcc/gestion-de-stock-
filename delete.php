<?php
require_once 'db.php';

if (isset($_GET['id_produit'])) {
    $id_produit = intval($_GET['id_produit']);
    $sql = "DELETE FROM produit WHERE id_produit = :id_produit";

    $query = $pdo->prepare($sql);
    $query->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->execute();

}
header('Location: produit.php');
?>