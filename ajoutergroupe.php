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
    @$valider=$_POST["valider"];
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
         $erreur="Groupe existe déjà!";
      else{
        $ins=$pdo->prepare("insert into enseignant(id,nomgrp,numetud,spec) values(?,?,?,?)");
        if($ins->execute(array($id,$nomgrp,$numetud,$spec)))
           header("location:index.php");
            
          
      } 


    }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajout Groupe</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet" />
  </head>
  <body onLoad="document.fo.login.focus()">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="index.php">SCO-Enicar</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"
              >Home <span class="sr-only">(current)</span></a
            >
          </li>

          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="index.html"
              id="dropdown01"
              data-toggle="dropdown"
              aria-expanded="false"
              >Gestion des Groupes</a
            >
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="afficherEtudiants.html"
                >Lister tous les étudiants</a
              >
              <a class="dropdown-item" href="afficherEtudiantsParClasse.html"
                >Etudiants par Groupe</a
              >
              <a class="dropdown-item" href="ajoutergroupe.html"
                >Ajouter Groupe</a
              >
              <a class="dropdown-item" href="#">Modifier Groupe</a>
              <a class="dropdown-item" href="#">Supprimer Groupe</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="dropdown01"
              data-toggle="dropdown"
              aria-expanded="false"
              >Gestion des Etudiants</a
            >
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="ajouterEtudiant.html"
                >Ajouter Etudiant</a
              >
              <a class="dropdown-item" href="#">Chercher Etudiant</a>
              <a class="dropdown-item" href="#">Modifier Etudiant</a>
              <a class="dropdown-item" href="#">Supprimer Etudiant</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="dropdown01"
              data-toggle="dropdown"
              aria-expanded="false"
              >Gestion des Absences</a
            >
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="saisirAbsence.html"
                >Saisir Absence</a
              >
              <a class="dropdown-item" href="etatAbsence.html"
                >État des absences pour un groupe</a
              >
            </div>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="login.html"
              >Se Déconnecter <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">
          <input
            class="form-control mr-sm-2"
            type="text"
            placeholder="Saisir un groupe"
            aria-label="Chercher un groupe"
          />
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Chercher Groupe
          </button>
        </form>
      </div>
    </nav>

    <main role="main">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Ajouter un groupe</h1>
          <p>Remplir le formulaire ci-dessous afin d'ajouter un groupe!</p>
        </div>
      </div>

      <div class="container" method="POST">
        <form name="fo" id="myform"  action="ajoutergroupe.php">
          <div class="form-group" action=''>
            <label for="nom">Nom du groupe :</label><br />
            <input
              type="text"
              id="nom"
              name="nom"
              class="form-control"
              required
              autofocus
            />
          </div>

          <!--num d'eleves-->
          <div class="form-group">
            <label for="numetud">Nombre d'élèves:</label><br />
            <input
              type="number"
              id="email"
              name="numetud"
              class="form-control"
              required
            />
          </div>
          <div class="container">
              <div class="form-group">
                <label for="spec">Choisir la spécialié:</label><br />
                <!--
    <input list="classe">
    <datalist id="classe" name="classe">
        <option value="1-INFOA">1-INFOA</option>
        <option value="1-INFOB">1-INFOB</option>
        <option value="1-INFOC">1-INFOC</option>
        <option value="1-INFOD">1-INFOD</option>
        <option value="1-INFOE">1-INFOE</option>
    </datalist>
    -->
                <select
                  id="classe"
                  name="spec"
                  class="custom-select custom-select-sm custom-select-lg"
                  
                >
                  <option >Informatique</option>
                  <option >Génie industriel</option>
                  <option >Infotronique</option>
                  <option >Mécatronique</option>
                </select>
              </div>
          </div>

          <!--Bouton Ajouter-->
          <button name="valider" type="submit" class="btn btn-primary btn-block">
            Ajouter
          </button>
        </form>
      </div>
    </main>

    <footer class="container">
      <p>&copy; ENICAR 2021-2022</p>
    </footer>
  </body>
</html>
