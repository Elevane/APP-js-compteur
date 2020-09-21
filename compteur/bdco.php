<?php
// fichier de connection à la base de données


// données de connection : 

$user = "root"; // identifiant
$mdp = "password"; // pwd
$serveur = "127.0.0.1:3308"; // adresse ip du serveur de bdd
$bd = "compteur"; // nom de la base
$dns="mysql:host=$serveur;dbname=$bd;charset=utf8"; // requete dns avec les infos précédement remplies



//connection a la base avec $maConnexion comme objet de la classe PDO
try
 {
 	$maConnexion = new PDO($dns,$user,$mdp); // connexion a la base de données
 	$maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // aides pour les erreurs
 }
catch (PDOException $e)
{
	echo "<script>alert(". 'erreur avec la bdd :' .$e->getMessage().")</script>"; // message d'erreur en cas d'echec de connexion
	die();
}
 ?>