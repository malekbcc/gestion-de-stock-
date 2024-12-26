<?php

require_once 'db.php';

if (isset($_POST['updatebtn'])) {
    $id_fournisseur = intval($_GET['id']); // Changed to use id_produit
    $nom_fournisseur = $_POST['nom_fournisseur'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $produit = $_POST['produit'];

    $sql = "UPDATE `fournisseurs` SET `nom_fournisseur`=:z, `adresse`=:e, `telephone`=:b,`produit`=:i WHERE id_fournisseur=:nouvelleid"; // Updated to use id_produit

    $query = $pdo->prepare($sql);
    $query->bindParam(':z', $nom_fournisseur, PDO::PARAM_STR);
    $query->bindParam(':e', $adresse, PDO::PARAM_STR);
    $query->bindParam(':b', $telephone, PDO::PARAM_STR);
    $query->bindParam(':i', $produit, PDO::PARAM_STR);
    
    $query->bindParam(':nouvelleid', $id_fournisseur, PDO::PARAM_INT); // Updated to use id_produit

    $query->execute();

    echo "<script>alert('Vous avez modifié un fournisseur');</script>";
    echo "<script>window.location.href='fournisseur.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content goes here -->
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <h1>Mettre à jour ce fournisseur </h1>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <?php
    $id_fournisseur = intval($_GET['id']); // Changed to use id_produit
               
                $sql = "SELECT `nom_fournisseur`, `adresse`, `telephone` ,`produit` FROM `fournisseurs` WHERE id_fournisseur=:id_fournisseur"; // Updated to use id_produit

                $query = $pdo->prepare($sql);
                $query->bindParam(':id_fournisseur', $id_fournisseur, PDO::PARAM_INT); // Updated to use id_produit
                $query->execute();

                $resultat = $query->fetchAll(PDO::FETCH_OBJ);

                foreach ($resultat as $row) {
                    ?>
                    <form action="" method="POST" class="form-group">
                        name : 
                        <input type="text" name="nom_fournisseur" id="" class="form-control"
                               value="<?php echo $row->nom_fournisseur; ?>">
                       adresse:
                        <input type="text" name="adresse" id="" class="form-control"
                               value="<?php echo $row->adresse; ?>">
                        telephone : 
                        <input type="text" name="telephone" id="" class="form-control"
                               value="<?php echo $row->telephone; ?>">
                               produit : 
                        <input type="text" name="produit" id="" class="form-control"
                               value="<?php echo $row->produit; ?>">

                        <input type="submit" name="updatebtn" id="" value="Mettre à jour" class="btn btn-primary mt-3">
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

</body>
</html>
