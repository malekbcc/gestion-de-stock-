<?php
require_once 'db.php';

if (isset($_GET['id_fournisseur'])) {
    $id_fournisseur = intval($_GET['id_fournisseur']);
    $sql = "DELETE FROM fournisseurs WHERE id_fournisseur = :id_fournisseur";

    $query = $pdo->prepare($sql);
    $query->bindParam(':id_fournisseur', $id_fournisseur, PDO::PARAM_INT);
    $query->execute();

}
header('Location: fournisseur.php');
?>