<?php
session_start();
@include_once 'include/header.php';

require 'config/connexion.php';
require 'config/commandes.php';

error_reporting (E_ALL ^ E_NOTICE); 
error_reporting(0); 


// suppimer les produit si la variable del existe
if (isset($_GET['del'])){
    $id_del = $_GET['del'];
//supression
    unset($_SESSION['panier'][$id_del]);
}

?>

<body class="panier">

<a href="index.php" class="link"> Ma boutique </a>
<h3>Details de la commande</h3>
<br />
<section>
<table>
    <tr>
        <td></td>
        <td >Nom</td>
        <td >Quantite</td>
        <td >Prix</td>
        <td >total</td>
        <td>Action</td>
    </tr>

<?php

$total=0;


//liste des produits
// récupère les clés du tableau session
$ids = array_keys($_SESSION['panier']);
// s'il n'a aucune clé dans le tableau
if(empty($ids)){
    echo 'votre panier est vide';
}else {

//si oui 
    $produits = mysqli_query($con, "SELECT * FROM produits WHERE id IN (".implode(',', $ids).")");
    
// liste des produits avce une boucle foreach
foreach($produits as $produit):
// total calcul du panier
$total = $total + $produit['prix'] * $_SESSION ['panier'][$produit['id']];

  ?>
<tr>
    <td><img src='image/<?=$produit['img']?>'></td>
    <td><?=$produit['nom']?></td>
    <td><?=$_SESSION['panier'][$produit['id']]?></td>
    <td><?=$produit['prix']?>$</td>
    <td><?=$produit['prix']*$_SESSION ['panier'][$produit['id']]?></td>
    <td> <a href="panier.php?del=<?=$produit['id']?>">Effacer</a></td>
    </tr>
<?php endforeach ;} ?>

<tr class="total">
    <th>Total:<?=$total?>$</th>
</tr>
</section> 

</table>
  
</body>

<?php
@include_once 'include/footer.php';
?>