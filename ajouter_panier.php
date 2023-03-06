<?php
include_once 'config/connexion.php';
// vérifie si la session existe
if (!isset($_SESSION)){
    // sinon start la session
    session_start();
}
// création de la session
if(!isset($_SESSION['panier'])){
//si pas session , création et inclure le tableau array< l'intérieur
    $_SESSION['panier'] = array();
}

//echo $_GET['id'];
// récupération du ID dans le lien
if(isset($_GET['id'])){
    $id = $_GET['id'];

//var_dump($_GET['id']);
// Vérification avec le ID si le produit exist dans BDN
$produits = mysqli_query($con , "SELECT * FROM produits WHERE id = $id");
if (empty(mysqli_fetch_assoc($produits))){
    die ('ce produit est inexistant');
}
//ajouter le produit dans le panier
if (isset($_SESSION['panier'][$id])){
    $_SESSION['panier'][$id]++;
}else{
// sinon on ajoute le produit
    $_SESSION['panier'][$id]= 1 ;
    echo 'le produit est mis dans le panier';
    var_dump($_SESSION['panier']);
}
   header('location:index.php');
}





?>






