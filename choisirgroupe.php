<?php
session_start();
if ($_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
} else{
    @$valider=$_POST["valider"];
    @$GRP=$_POST["nomgrp"];
    @$erreur='';
    include ("connexion.php");
    $req="SELECT * FROM groupes";
    $reponse = $pdo->query($req);
    if($reponse->rowCount()>0) {
        $outputs["groupes"]=array();
    while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
            $groupes = array();
            $groupes["nomgrp"] = $row["nomgrp"];
             array_push($outputs["groupes"], $groupes);
        }
        // success
        $outputs["success"] = 1;
         echo json_encode($outputs);
    } else {
        $outputs["success"] = 0;
        $outputs["message"] = "Pas d'étudiants";
        // echo no users JSON
        echo json_encode($outputs);
    }
    if (isset($valider)){
        header("location:afficheretudiantparclasse.php");
    }



}

?>



<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <style>
         *{
            font-family:arial;
         }
         body{
            margin:20px;
         }
         input{
            border:solid 1px #2222AA;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
         a{
            font-size:12pt;
            color:#EE6600;
            text-decoration:none;
            font-weight:normal;
         }
         a:hover{
            text-decoration:underline;
         }
      </style>
   </head>
   <body onLoad="document.fo.login.focus()">
      <h1>CHOISIR Groupe<a href="choisirgroupe.php">Choisir un groupe</a> ]</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text" name="nomgrp" placeholder="Nom du groupe" /><br />
         <href="afficheretudiantparclasse.php"  input type="submit" name="chercher" value="Chercher" />
         <input type="submit" href="afficheretudiantparclasse.php" name="valider" value="choisir groupe" />
      </form>
   </body>
</html>