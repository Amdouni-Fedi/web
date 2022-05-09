<?php
   session_start();
   @$nomgrp=$_POST["nomgrp"];
   @$id=$_POST["id"];
   @$numetud=$_POST["numetud"];
   @$spec=$_POST["spec"];
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      if(empty($nomgrp)) $erreur="Nom laissé vide!";
      elseif(empty($id)) $erreur="Prénom laissé vide!";
      elseif(empty($numetud)) $erreur="Prénom laissé vide!";
      elseif(empty($spec)) $erreur="Login laissé vide!";
      else{
         include("connexion.php");
         $sel=$pdo->prepare("select id from groupes where id=? limit 1");
         $sel->execute(array($id));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Login existe déjà!";
         else{
            $ins=$pdo->prepare("insert into groupes(nomgrp,id,numetud,spec) values(?,?,?,?)");
            if($ins->execute(array($nomgrp,$id,$numetud,$spec)))
               header("location:ajoutergroupe2.php");
         }   
      }
   }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Hugo 0.88.1" />
    <title>SCO-ENICAR Inscription Enseignant</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./assets/dist/css/signin.css" rel="stylesheet" />
  </head>
  <body class="text-center">
    <div class="erreur"><?php echo $erreur ?></div>
    <form class="form-signin" method="post" action="">
      <img class="mb-4"
        src="./brand/user-login.svg"
        alt=""
        width="72"
        height="72"
      />
      <h1 class="h3 mb-3 font-weight-normal">Veuillez ajouter un groupe </h1>

      <input
        type="text"
        class="form-control"
        name="nomgrp"
        placeholder="Nom du groupe"
        required
        value="<?php echo $nomgrp?>"
        autofocus
      /><br />
      <!-- <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom?>" /><br /> -->
      <input
        type="number"
        class="form-control"
        name="id"
        placeholder="Id"
        value="<?php echo $id?>"
        required
      /><br />
      <input
        type="number"
        class="form-control"
        name="numetud"
        placeholder="Nombre des étudiants"
        
        required
      /><br />
      <input
        type="text"
        class="form-control"
        name="spec"
        placeholder="Specialité"
        
        required
      /><br />
      
      <button class="btn btn-lg btn-primary btn-block" name="valider" type="submit">AJOUTER</button>

      <p class="mt-5 mb-3 text-muted">&copy; SOC-Enicar 2021-2022</p>
    </form>
    
  </body>
</html>

