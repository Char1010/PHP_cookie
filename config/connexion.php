<?php

// try {
// 		$access=new pdo("mysql:host=localhost:3303;dbname=maboutique;charset=utf8", "root", "Maker1000");
		
// 		$access->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// } catch (Exception $e) 
// {
// 	$e->getMessage();
	
// }

// $servername = "localhost:3303";
// $username = "root";
// $password = "Maker1000";
// $database = "maboutique";

//  try {
//    $con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//    //Définir le mode erreur PDO en exception
//    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connecté avec succès";
//  } catch(PDOException $e) {
//    echo "Connecté avec succès: " . $e->getMessage();
//  }


 //Deuxième test pour la connexion 


$con= mysqli_connect('localhost:3303', 'root','Maker1000', 'maboutique');
if(!$con) die ('erreur:'.mysqli_connect_error());

//echo 'connexion réussit !'

?>
    
