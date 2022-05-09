<?php
session_start();
if( $_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit(); 
 }
 else{
     @$id=$_POST["id"];
     @$valider=$_POST["valider"];
     if (isset($valider)){
         include("connexion.php");
         $req="select * from groupes where id='$id'";
          $reponse = $pdo->query($req);
          if($reponse->rowCount()>0) {
              $sel="DELETE from groupes where id='$id'";
              $reponse = $pdo->query($sel);
              

     }
     header("location:supprimergroupe.php");
    }
 }
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MODIFICATION D'UN GROUPE</title>
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
              href="index.php"
              id="dropdown01"
              data-toggle="dropdown"
              aria-expanded="false"
              >Gestion des Groupes
              </a
            >
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="listeretudiants.php"
                >Lister tous les étudiants</a
              >
              <a class="dropdown-item" href="choisirgroupe2.php"
                >Etudiants par Groupe</a
              >
              <a class="dropdown-item" href="ajoutergroupe2.php"
                >Ajouter Groupe</a
              >
              <a class="dropdown-item" href="choisirgroupe3.php">Modifier Groupe</a>
              <a class="dropdown-item" href="supprimergroupe.php">Supprimer Groupe</a>
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
              <a class="dropdown-item" href="ajouetud.php">
                Ajouter Etudiant</a
              >
              <a class="dropdown-item" href="choisirgroupe4.php">Chercher Etudiant</a>
              <a class="dropdown-item" href="modifieretudiant.php">Modifier Etudiant</a>
              <a class="dropdown-item" href="supprimeretudiant.php">Supprimer Etudiant</a>
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
            <a href="deconnexion.php" class="nav-link" href="#"
              >Se Déconnecter <span class="sr-only">(current)</span></a
            >
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
          <h1 class="display-4">Supprimer un groupe</h1>
          <p>Entrez l'id du groupe à supprimer</p>
        </div>
      </div>

      <div class="container" method="post">
        <form method="post" name="fo" id="myform"  action="">
          <div class="form-group" action=''>
            <label for="id">Id du groupe :</label><br />
            <input
              type="text"
              id="nom"
              name="id"
              class="form-control"
              required
              autofocus
            />
          
       

          

          <!--Bouton Ajouter-->
          <button name="valider" type="submit" class="btn btn-primary btn-block">
            SUPPRIMER
          </button>
        </form>
      </div>
    </main>

    <footer class="container">
      <p>&copy; ENICAR 2021-2022</p>
    </footer>
  </body>
</html>
