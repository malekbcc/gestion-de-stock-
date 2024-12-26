<?php

require_once 'db.php';

if (isset($_POST['updatebtn'])) {
    $id_produit = intval($_GET['id']); // Changed to use id_produit
    $code_article = $_POST['code_article'];
    $nom_article = $_POST['nom_article'];
    $quantite = $_POST['quantite'];
    
    $sql = "UPDATE `produit` SET `code_article`=:code_art, `nom_article`=:nomart, `quantite`=:quant WHERE id_produit=:nouvelleid"; // Updated to use id_produit

    $query = $pdo->prepare($sql);
    $query->bindParam(':code_art', $code_article, PDO::PARAM_STR);
    $query->bindParam(':nomart', $nom_article, PDO::PARAM_STR);
    $query->bindParam(':quant', $quantite, PDO::PARAM_STR);
    $query->bindParam(':nouvelleid', $id_produit, PDO::PARAM_INT); // Updated to use id_produit

    $query->execute();

    echo "<script>alert('Vous avez modifié un produit');</script>";
    echo "<script>window.location.href='produit.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content goes here -->
</head>
<div class="background-image">
<style>
   .background-image{
		background-image: url("https://i.postimg.cc/5tpfwL3t/maliko.jpg");
		background-size: cover;
		height: 110vh;
        background-repeat: no-repeat;
        
	}
    </style>
<body>
    <?php require_once 'navbar.php'; ?>
    <h1>Mettre à jour ce Produit</h1>

    <div class="container">
        <div class="row">
            <div class="col-8">

                <?php
                $id_produit = intval($_GET['id']); // Changed to use id_produit
                $sql = "SELECT `code_article`, `nom_article`, `quantite` FROM `produit` WHERE id_produit=:id_produit"; // Updated to use id_produit

                $query = $pdo->prepare($sql);
                $query->bindParam(':id_produit', $id_produit, PDO::PARAM_INT); // Updated to use id_produit
                $query->execute();

                $resultat = $query->fetchAll(PDO::FETCH_OBJ);
                foreach ($resultat as $row) {
                    ?>
                    <form action="" method="POST" class="form-group">
                        Code Produit :
                        <input type="text" name="code_article" id="" class="form-control"
                               value="<?php echo $row->code_article; ?>">
                        Nom Produit :
                        <input type="text" name="nom_article" id="" class="form-control"
                               value="<?php echo $row->nom_article; ?>">
                        Quantité Produit :
                        <input type="text" name="quantite" id="" class="form-control"
                               value="<?php echo $row->quantite; ?>">

                        <input type="submit" name="updatebtn" id="" value="Mettre à jour" class="btn btn-primary mt-3">
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

</body>
</html>
