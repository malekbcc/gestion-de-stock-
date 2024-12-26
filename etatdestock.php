<?php 
require_once 'db.php';

$stmt = $pdo->query('SELECT * FROM produit');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<div class="background-image">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <div class="container">
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
.dataTables_filter label {
    color: #000; /* Dark black color for the label */
    font-weight: bold; /* Optionally make the label bold */
}
    </style>
        <table class="table table-striped"  id="example">
            <thead>
                <th>image</th>
                <th>Code Article</th>
                <th>Designation</th>
                <th>Quantite</th>
                <th>Etat en stock</th>
            </thead>
            <tbody>
                <?php 
                while ($row = $stmt->fetch()) {
                    ?>
                    <tr>
                        <td><img src="./uploads/<?php echo $row->image_produit; ?>" alt=" " class="image_product"></td>
                        <td><?php echo $row->code_article; ?> </td>
                        <td><?php echo $row->nom_article; ?> </td>
                        <td><?php echo $row->quantite; ?></td>
                        <td>
                            <?php
                            if ($row->quantite == 0) {
                                echo '<span class="badge bg-danger">epuise</span>';
                            } else {
                                echo '<span class="badge bg-success">en stock</span>';
                            }
                            ?>
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
</body>
</html>
