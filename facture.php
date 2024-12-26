<?php 
require_once 'db.php';


    $id_produit = intval($_GET['id_produit']); 
    
    // Define a query to fetch product details
    $sql = "SELECT * FROM produit WHERE id_produit = :id_produit";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
    
    // Execute the query and check for errors
    if ($stmt->execute()) {
        // Fetch product details
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "No data found for id_produit: $id_produit";
        }
    } else {
        echo "Error executing the SQL query: " . $stmt->errorInfo()[2];
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
}

.invoice {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    margin-top:90px;
}

h1 {
    text-align: center;
    color: #333;
}

.invoice-details {
    display: flex;
    justify-content: space-between;
}

.invoice-from, .invoice-to {
    width: 48%;
    margin-bottom: 10%;
}

.invoice-items {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.invoice-items th, .invoice-items td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

tfoot td {
    font-weight: bold;
}

tfoot td:last-child {
    text-align: right;
}

.center-button {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 20vh;
  }

.print-button {
    padding: 10px 20px;
    background-color: #007bff; 
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }

  
.print-button:hover {
    background-color: #0056b3; 
}
</style>
<body>
    <div class="invoice">
        <h1>Invoice</h1>
        <div class="invoice-details">
            <div class="invoice-from">
                <p>From:</p>
                <address>
                  Rapid-Poste<br>
                  Rue de la Révolution 9100 Sidi Bouzid, Sidi Bouzid <br>
                    
                   city sidi Bouzid, tunisie,9100<br>
                    Phone:  71 281 854
                </address>
            </div>
            <div class="invoice-to">
                <p>To:</p>
                <address>
                <?php echo $product['fournisseur'];?><br>
                   
                </address>
            </div>
        </div>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if ($product) { ?>
                    <tr>
                        <td><?php echo $product['nom_article']; ?></td>
                        <td><?php echo $product['quantite']; ?></td>
                        <td><?php echo $product['prix']; ?></td>
                       
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total:</td>
                    <td>$<?php echo $product['prixtotal'];?> </td>
                </tr>

            </tfoot>
        </table> 
        
    </div>
    <div class="center-button">
  <input type="button" class="print-button" value="Print" onclick="window.print()" />
</div>
</body>
</html>
