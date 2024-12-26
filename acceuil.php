<?php
// Include your database connection and other necessary code here
require_once 'db.php';

// Logout script
if (isset($_POST['logout'])) {
    // Destroy the current session (logout)
    session_start();
    session_destroy();
    
    // Redirect to index.php
    header('Location: index.php');
    exit;
}

// Your existing code for adding a product and retrieving products
if (isset($_POST['ajouter']) && !empty($_POST['code_article'])
    && !empty($_POST['nom_article'])
    && !empty($_POST['quantite'])
) {
    $code_article = $_POST['code_article'];
    $nom_article = $_POST['nom_article'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $prixtotal=$prix * $quantite;
    $fournisseur=$_POST['fournisseur'];

    $images=$_FILES['profile']['name'];
        $tmp_dir=$_FILES['profile']['tmp_name'];
        $imageSize=$_FILES['profile']['size'];
           
        $upload_dir='uploads/';
        $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
        $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
        $picProfile=rand(1000, 1000000).".".$imgExt;
        move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
    // Handling image upload (your existing code)

    $sql = "INSERT INTO produit(code_article, nom_article, image_produit, quantite , prix, prixtotal,fournisseur)
            VALUES (:code_article, :nom_article, :pic, :quantite , :prix , :prixtotal, :fournisseur)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':code_article', $code_article);
    $stmt->bindParam(':nom_article', $nom_article);
    $stmt->bindParam(':pic', $picProfile);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':prixtotal', $prixtotal);
    $stmt->bindParam(':fournisseur', $fournisseur);

    $stmt->execute();
    header('Location: acceuil.php?success=1');
}

// Retrieve products (your existing code)
$stmt = $pdo->query('SELECT * FROM produit');

$stmt=$pdo->query("SELECT id_fournisseur, nom_fournisseur FROM fournisseurs ")
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
<div class="background-image">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
    <style>
       *{
        margin: 0;
        padding: 0;
       }
       .background-image{
		background-image: url("https://i.postimg.cc/5tpfwL3t/maliko.jpg");
		background-size: cover;
		height: 110vh;
        background-repeat: no-repeat;
        
	}
	
        body {
           
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            color: #000;
        }

        .btn-primary {
            background-color: #fcba03;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #f06d06;
        }

        .logout-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    
<?php require_once 'navbar.php'; ?>

<div class="container">
    <div class="form-container">
    <div id="alert-message" style="display: none;"></div>
        <form action="acceuil.php" class="form-group" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile">Image du Produit :</label>
                <input type="file" class="form-control" id="profile" name="profile" accept="image/*">
            </div>
            <div class="form-group">
                <label for="code_article">Code Article :</label>
                <input type="text" class="form-control" id="code_article" name="code_article" required>
            </div>
            <div class="form-group">
                <label for="nom_article">Designation du Produit :</label>
                <input type="text" class="form-control" id="nom_article" name="nom_article" required>
            </div>
            <div class="form-group">
                <label for="fournisseur"> Fournisseur :</label></div>
                <div class="form-group "  >


               <?php 
               if ($stmt->rowCount() > 0) {
                echo '<select id="selectData" name="fournisseur">';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_fournisseur = $row['id_fournisseur'];
                    $nom_fournisseur = $row['nom_fournisseur'];
                    echo '<option value="' . $nom_fournisseur . '">' . $nom_fournisseur . '</option>';
                }
                echo '</select>';
            } else {
                echo "No data found.";
            }?>
            </div>
            
            <div class="form-group">
                <label for="quantite">Quantite :</label>
                <input type="text" class="form-control" id="quantite" name="quantite" required>
            </div>
            <div class="form-group">
                <label for="prix">prix :</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
                
            </div>
            <button type="submit" class="btn btn-primary" name="ajouter">Enregistrer</button>
            <div id="success-message" style="color: green;"></div>
            
        </form>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the success message div element
    var successMessage = document.getElementById("success-message");

    // Check if the success message is set in the URL query parameters
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("success")) {
        // Display the success message
        successMessage.textContent = "Votre donnée a été enregistrée.";
    }
    var form = document.querySelector("form");
    form.addEventListener("submit", function() {
        // Hide the success message when the form is submitted again
        successMessage.style.display = "none";
    });
});
</script>


<form action="acceuil.php" method="POST">
        <button type="submit" class="btn btn-primary logout-button" name="logout">Log Out</button>
    </form>

</body>

  

</html>
