<?php
session_start();
if ($_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();

}
else {
    @$nomgrp=$_POST["nomgrp"];
    @$numetud=$_POST["numetud"];
    @$spec=$_POST["spec"];
    @$id=$_POST["id"];
    @$erreur='';
    if(isset($valider)){
        if(empty($nomgrp)) $erreur="Nom laissé vide!";
        elseif(empty($numetud)) $erreur="nombre des étudiants laissé vide!";
        elseif(empty($spec)) $erreur="specialité laissée vide!";
    }
    else{
       include("connexion.php");
      $sel=$pdo->prepare("select id from groupes where id=? limit 1");
      $sel->execute(array($id));
      $tab=$sel->fetchAll();
      if(count($tab)>0)
         $erreur="NOT OK";// Etudiant existe déja
      else{
         
         //$ins=$pdo->prepare("insert into etudiant(cin,email,password,cpassword,nom,prenom,adresse,Classe) values(?,?,?,?,?,?,?,?)");
         //if($ins->execute(array($cin,$email,md5($pwd),md5($cpwd),$nom,$prenom,$adresse,$classe)))
            //header("location:AjouterEtudiant.php");
         $req=$pdo->prepare("insert into groupes(id,nomgrp,numetud,spec) values(?,?,?,?)");
         $req="insert into etudiant values ('$id','$nomgrp','$numetud','$spec')";
         /* $reponse = $pdo->exec($req) or die("error"); */
         $pdo->exec($req);
         $erreur ="AJOUT AVEC SUCCES";
      }

      

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
      <h1>AJOUT Groupe<a href="ajoutergroupe.php">Ajouter un groupe</a> ]</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text" name="nomgrp" placeholder="Nom du groupe" /><br />
         <input type="int" name="numetud" placeholder="Nombre des étudiants" /><br />
         <input type="int" name="spec" placeholder="Specialité" /><br />
         <input type="submit" name="ajouter" value="Ajout" />
      </form>
   </body>
</html>