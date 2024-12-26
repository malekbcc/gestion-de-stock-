<?php
require_once 'db.php';


if (isset($_GET['del'])) {
    $sup = intval($_GET['del']);

    $sql = "DELETE FROM produit WHERE id=:id_produit";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_produit', $sup, PDO::PARAM_INT);
    $query->execute();

    
    header('Location: produit.php');
    
}

$stmt = $pdo->query('SELECT * FROM produit');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


   <div class="background-image">
   <style>
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
    margin-top: 10% !important;
    
}

/* Style the label "Search" */
.dataTables_filter label {
    color: #000; /* Dark black color for the label */
    font-weight: bold; /* Optionally make the label bold */
}
    </style>
  
	
</head>
<body style="background:lightblue">

<?php require_once 'navbar.php'; ?>

<div class="container" >
    <table class="table table-striped" id="example" >
        <thead >
            <th>Image</th>
            <th>Code Article</th>
            <th>Designation</th>
            <th>Quantite</th>
            <th>prix unitaire</th>
            <th> prix total</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch()) { ?>
            <tr id="bc">
                <td><img src="./uploads/<?php echo $row->image_produit; ?>" alt=" " class="image_product"></td>
                <td id="za"><?php echo $row->code_article; ?></td>
                <td><?php echo $row->nom_article; ?></td>
                <td><?php echo $row->quantite; ?></td>
                <td><?php echo $row->prix;?></td>
                <td><?php echo $row->prixtotal;?></td>
                <td>
    <a href="updateProduit.php?id=<?php echo $row->id_produit; ?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
    <a href="delete.php?id_produit=<?php echo $row->id_produit; ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
    <a href="facture.php?id_produit=<?php echo $row->id_produit;?>"><button  class="btn btn-info"> <i class='fa-solid fa-file-invoice'></i></button></a>
</td>

</td>

                </td>
            </tr>
        <?php
     } ?>
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
</body>
</html>
