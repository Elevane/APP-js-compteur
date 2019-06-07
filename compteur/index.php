<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Compteur</title>
</head>
<body>
    <div id="all">
    <h1>Compteur</h1>

    <div id="conteneur">
        <div id="compteurA">
    <!-- chiffre compteur de temps actuel-->
    <span id="compteur"><?php
    
    include_once('bdco.php');
    $req = "select value from chiffre where nom = 'value';";

    $result = $maConnexion->query($req);

    while($row = $result->fetchObject()){
        echo $row->value;
    }
    ?></span></div>


    <!-- Menus de boutons-->
    <div>
        <button id="+1" class="plus">  1</button>
        <button id="+5"  class="plus">  5</button>
        <button id="+10"  class="plus">  10</button>
    </div>

    <div>
        <button id="-1"  class="moins">  1</button>
        <button id="-5" class="moins">  5</button>
        <button id="-10" class="moins">  10</button>
    </div>
    </div>
    <form action="save.php" method="POST">
        <input type="text" id="value" name="value" hidden>
        <input id="submit" type="submit">
    </form>
    </div>
    <div id="log">

        <table>
            <tr>
                <th>date</th>
                <th>action</th>
              
            </tr><?php
                include_once('bdco.php');

                $req = "select * from log order by date desc;";
                $res = $maConnexion->query($req);

                while($row = $res->fetchObject()){
            echo"
            <tr>
                <td>".$row->date."</td>
                <td>".$row->action."</td>
            
            </tr>";

                }
            ?>
        </table>
    </div>

    <!-- script js s'ésécutesans rechargement de la bade de données ni de la page, c'est ici que l'on va cahnger la valeur du compteur pour ajouter ou supprimer du temps-->
    <script type="text/javascript">
        
        //boutons plus
        var plusun = document.getElementById('+1');
        var pluscinq = document.getElementById('+5');
        var plusdix = document.getElementById('+10');
        //boutons moins
        var moinsun = document.getElementById('-1');
        var moinscinq = document.getElementById('-5');
        var moinsdix = document.getElementById('-10');


        var compteur = document.getElementById('compteur');
        //si on appuie sur un bouton

        //+1
        plusun.addEventListener('click', function(){plus(1);});

        //+5
        pluscinq.addEventListener('click', function(){plus(5);});

        //+10
        plusdix.addEventListener('click', function(){plus(10);});

        //-1
        moinsun.addEventListener('click', function(){moins(1);});

        //-5
        moinscinq.addEventListener('click', function(){moins(5);});

        //-10
        moinsdix.addEventListener('click', function(){moins(10);});

        // fonctions d'ajout ou suppriession de valeur au compteur
        function plus(value){
            timeTranslate();
            compteur.innerHTML = parseInt(compteur.innerHTML) + value;
            timeChange();
        }

        function moins(value){
            
            timeTranslate();
            
            compteur.innerHTML = parseInt(compteur.innerHTML) - value;
            
            console.log(compteur.innerHTML);
            timeChange();
            
        }


        var form = document.getElementById('submit');
        form.addEventListener('click',function(){
            var input = document.getElementById('value');
            timeTranslate();
            input.value = parseInt(compteur.innerHTML);

            
        })

        // traduit le temps en minutes et heure

        
        function timeChange(){

            var tempsMin = parseInt(compteur.innerHTML);

            if(tempsMin > 59){
                
                var h = Math.floor(tempsMin / 60);
                var min = Math.floor(tempsMin%60);
                compteur.innerHTML = h + " h "+ min + " min"
            }
            else{
                compteur.innerHTML = tempsMin + " min"
            }

        }

        function timeTranslate(){
            var tempsHmin = compteur.innerHTML;
            
            if (tempsHmin.length > 6){
                var h = tempsHmin.substr(0,1);
                hour = parseInt(h);

                var m = tempsHmin.substr(4,2);
                min = parseInt(m);

                compteur.innerHTML = hour *60 + min;

                
            }

            else if (tempsHmin.length < 7 )
            {
                console.log("<<");
                var m = tempsHmin.substr(0,3);
                min = parseInt(m);
                compteur.innerHTML = min;
            }

            
            
        }
        // au chargement de la page traduit le nombre de minutes contenue dan la base de donnée en minutes et ou / heures
        window.onload= function(){timeChange();};
            
        



    </script>
</body>
</html> 