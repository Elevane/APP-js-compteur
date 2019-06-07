<?php

include_once('bdco.php');


$value = htmlspecialchars($_POST['value']);

$req1 = "select value from chiffre;";
$res1 = $maConnexion->query($req1);
$result1 = $res1->fetchObject();

$rest = intval($result1->value);
$value = intval($value);

if($rest > $value){
    $action = "soustraction de " .  ($rest - $value. " mins");
    $reqadd = "insert into log (date, action) values(now(),'".$action."');";
    $query = $maConnexion->query($reqadd);
}
else if ($rest < $value){
    $action = "Ajout de " . ($value -$rest)." mins";
    $reqsous = "insert into log (date, action) values(now(),'".$action."');";
    $query = $maConnexion->query($reqsous);
    echo $action;
}



$req = 'UPDATE chiffre set value =  "'.$value .'" WHERE id = 1;';

$res = $maConnexion->query($req); // preparation de la requete

header('location:index.php');
?>