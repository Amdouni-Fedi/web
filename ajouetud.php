<?php
 session_start();
 
 if( $_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit(); 
 }
else {
@$cin=$_POST['cin'];
@$nom=$_POST['nom'];
@$prenom=$_POST['prenom'];
@$email=$_POST['email'];
@$adresse=$_POST['adresse'];
@$pwd=$_POST['pwd'];
@$cpwd=$_POST['cpwd'];
@$classe=$_POST['classe'];


include("connexion.php");
         $sel=$pdo->prepare("select cin from etudiant where cin=? limit 1");
         $sel->execute(array($cin));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="NOT OK";// Etudiant existe déja
         else{
            
            //$ins=$pdo->prepare("insert into etudiant(cin,email,password,cpassword,nom,prenom,adresse,Classe) values(?,?,?,?,?,?,?,?)");
            //if($ins->execute(array($cin,$email,md5($pwd),md5($cpwd),$nom,$prenom,$adresse,$classe)))
               //header("location:AjouterEtudiant.php");
            $req=$pdo->prepare("insert into enseignant(nom,prenom,login,pass) values(?,?,?,?)");
            $req="insert into etudiant values ('$cin','$email',md5('$pwd'),md5('$cpwd'),'$nom','$prenom','$adresse','$classe')";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="AJOUT AVEC SUCCES";
         }  

         
         
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SCO-ENICAR Ajouter Etudiant</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet" />
  </head>
  <body>
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
          <h1 class="display-4">Ajouter un étudiant</h1>
          <p>Remplir le formulaire ci-dessous afin d'ajouter un étudiant!</p>
        </div>
      </div>

      <div class="container">
        <form id="myform" method="POST" action="ajouetud.php">
          <!--
                        TODO: Add form inputs
                        Prenom - required string with autofocus
                        Nom - required string
                        Email - required email address
                        CIN - 8 chiffres
                        Password - required password string, au moins 8 letters et chiffres
                        ConfirmPassword
                        Classe - Commence par la chaine INFO, un chiffre de 1 a 3, un - et une lettre MAJ de A à E
                        Adresse - required string
                    -->
          <!--Nom-->
          <div class="form-group">
            <label for="nom">Nom:</label><br />
            <input
              type="text"
              id="nom"
              name="nom"
              class="form-control"
              required
              autofocus
            />
          </div>
          <!--Prénom-->
          <div class="form-group">
            <label for="prenom">Prénom:</label><br />
            <input
              type="text"
              id="prenom"
              name="prenom"
              class="form-control"
              required
            />
          </div>
          <!--Email-->
          <div class="form-group">
            <label for="email">Email:</label><br />
            <input
              type="email"
              id="email"
              name="email"
              class="form-control"
              required
            />
          </div>
          <!--CIN-->
          <div class="form-group">
            <label for="cin">CIN:</label><br />
            <input
              type="text"
              id="cin"
              name="cin"
              class="form-control"
              required
              pattern="[0-9]{8}"
              title="8 chiffres"
            />
          </div>
          <!--Password-->
          <div class="form-group">
            <label for="pwd">Mot de passe:</label><br />
            <input
              type="password"
              id="pwd"
              name="pwd"
              class="form-control"
              required
              pattern="[a-zA-Z0-9]{8,}"
              title="Au moins 8 lettres et nombres"
            />
          </div>
          <!--ConfirmPassword-->
          <div class="form-group">
            <label for="cpwd">Confirmer Mot de passe:</label><br />
            <input
              type="password"
              id="cpwd"
              name="cpwd"
              class="form-control"
              required
            />
          </div>
          <!--Classe-->
          <div class="form-group">
            <label for="classe">Classe:</label><br />
            <input
              type="text"
              id="classe"
              name="classe"
              class="form-control"
              required
              pattern="INFO[1-3]{1}-[A-E]{1}"
              title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C"
            />
          </div>
          <!--Adresse-->
          <div class="form-group">
            <label for="adresse">Adresse:</label><br />
            <textarea
              id="adresse"
              name="adresse"
              rows="10"
              cols="30"
              class="form-control"
              required
            >
            </textarea>
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
