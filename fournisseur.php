<?php
require_once 'db.php';
   
   // ajouter un produit depuis le formulaire 

if(isset($_POST['ajouter']) && !empty($_POST['nom_fournisseur'])
                       && !empty($_POST['adresse'])
                       && !empty($_POST['telephone'])
                       && !empty($_POST['produit'])

)
{   
$nom_fournisseur= $_POST['nom_fournisseur'];
$adresse = $_POST['adresse'];
$telephone = $_POST['telephone'];
$produit = $_POST['produit'];


$sql ="INSERT INTO fournisseurs(nom_fournisseur,adresse, telephone , produit)
         VALUES (:nom_fournisseur, :adresse, :telephone ,:produit)";
         $stmt = $pdo->prepare($sql);

       
         $stmt->bindParam(':nom_fournisseur', $nom_fournisseur);
         $stmt->bindParam(':adresse', $adresse);
         $stmt->bindParam(':telephone', $telephone);
         $stmt->bindParam(':produit', $produit);

         $stmt->execute();
         header('Location:fournisseur.php');


}
$stmt = $pdo->query('SELECT * FROM fournisseurs');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <div class="background-image">
    <style>
        #za {
    background-color: transparent; /* Transparent white background */
    
    margin-bottom: 5%;
    border-color: black;
    
}
#a{
    font-size: 20px  black;
    color: darkblue; /* Dark black color for the label */
    font-weight: bold;

}

        .background-image{
		background-image: url("https://i.postimg.cc/5tpfwL3t/maliko.jpg");
		background-size: cover;
		height: 110vh;
        background-repeat: no-repeat;
        
	}
    .dataTables_filter input {
    background-color: transparent !important; /* Creamy grey background color */
    border: 2px solid black !important; /* Solid border with red color */
    color: #000 !important; /* Dark black text color */
    border-radius: 5px !important;
    padding: 5px !important;
    margin-bottom: 25%;
    
}
/* Style the label "Search" */
.dataTables_filter label {
    color: darkblue; /* Dark black color for the label */
    font-weight: bold;
    
     /* Optionally make the label bold */
}

	</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background:lightblue" >

<?php require_once 'navbar.php'; ?>
<div class="container">
    <div class="row">
<div class="col-4 mt-3 ">
               <form action="fournisseur.php" class="form-group mt-5 "  id="za" method="POST" enctype="multipart/form-data" >
                <label for="" id="a">name :</label>
                     <input type="text" class="form-control mt-3" id="za" style="background-color: rgba(255, 255, 255, 0.8)" name="nom_fournisseur" >
                   <label for="" id="a"> adresse:</label>
                   <input type="text" class="form-control mt-3" style="background-color:rgba(255, 255, 255, 0.8)" id="za" name="adresse" required>
                   <label for="" id="a">telephone :</label>
                   <input type="text" class="form-control mt-3" style="background-color: rgba(255, 255, 255, 0.8)" id="za" name="telephone" required>
                   <label for="" id="a"> produit :</label>
                   <input type="text" class="form-control mt-3" id="za" style="background-color: rgba(255, 255, 255, 0.8)" name="produit" required>
                   <button type="submit" class="btn btn-primary mt-3" name="ajouter">Enregistrer</button>
               </form>
            </div>

<div class="col-7 mt-3">
                <table class="table table-striped display" id="example" >
                    <thead>
                        <th>name</th>
                        <th>adresse</th>
                        <th>telephone</th>
                        <th>produit</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php 
                  
                  while ( $row =  $stmt->fetch())
                    {
                        ?>
                    
                        <tr>
                            <td><?php echo $row-> nom_fournisseur; ?> </td>
                            <td><?php echo $row-> adresse; ?> </td>
                            <td><?php echo $row-> telephone; ?> </td>
                            <td><?php echo $row-> produit; ?> </td>
                           <td> <a href="updatefournisseurs.php?id=<?php echo $row->id_fournisseur;?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                             <a href="deletefournisseurs.php?id_fournisseur=<?php echo $row->id_fournisseur; ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                    </td>
                 </tr>
                       <?php } ?>
                    </tbody>
                </table>
                <script>
                $(document).ready(function() {
                    $('#example').DataTable( {
                        "scrollY":        "500px",
                        "scrollCollapse": true,
                        "paging":         false
                        } );
                    } );
            </script>

            </div>
            </div>
            </div>
                    </div>
</body>
</html>
