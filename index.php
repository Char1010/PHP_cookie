<?php
session_start();
@include_once 'include/header.php';

require 'config/connexion.php';
require 'config/commandes.php';


// Modifie la valeur d'une option de configuration du fichier php.ini
ini_set("display_error", 1);

// Rapporte toutes les erreurs ( https://www.php.net/manual/fr/function.error-reporting.php )


?>
  <h3 class= "titre_a">Ma super boutique</h3>

<body>

    <a href="panier.php" class="link"> panier <span><?=array_sum($_SESSION['panier'])?> </a>
    <section class="produit_list">
      
        <?php
$req= mysqli_query($con, "SELECT * FROM produits");
while ($row = mysqli_fetch_assoc($req)){


        ?>
        
            <form method="POST" class="produit">
                <div class="image_produit">
                    <img src="image/<?=$row['img'] ?>" >
                </div>
                <div class= "content">
                    <h4 class="name"><?=$row['name'] ?> </h4>
                    <h2 classe="prix"><?=$row['prix'] ?> $</h2>
                    <a href="ajouter_panier.php?id=<?=$row['id']?>" class="id_produit">Ajouter au produit</a>
                </div>
            </form>
<?php } ?>
     

</body>

<?php
@include_once 'include/footer.php';
?>