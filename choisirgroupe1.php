<?php
   session_start();
   @$id=$_POST["id"];
   @$numetud=$_POST["numetud"];
   @$valider=$_POST["valider"];
   $erreur="";
   
   
   if(isset($valider)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from groupes where id=? and numetud=? limit 1");
      $sel->execute(array($id,$numetud));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["id"]=($tab[0]["id"]);
         $_SESSION["autoriser"]="oui";
         header("location:index.php");
      }
      else
         $erreur="Mauvais login ou mot de passe!";
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
      <a class="navbar-brand" href="#">SCO-Enicar</a>
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
            <a class="nav-link" href="index.html"
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
          <h1 class="display-4">Choisir un groupe</h1>
        </div>
      </div>

      <div class="container" method="get">
        <form name="fo" id="myform"  action="">
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
          </div>



          

          <!--Bouton Ajouter-->
          <button class="btn btn-lg btn-primary btn-block" name="valider" type="submit">Chercher</button>
        </form>
      </div>
    </main>

    <footer class="container">
      <p>&copy; ENICAR 2021-2022</p>
    </footer>
  </body>
</html>
