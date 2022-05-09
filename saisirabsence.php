<?php
session_start();
if( $_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit(); 
 }
else {
    include("connexion.php");
    @$nomgrp=$_GET['nomgrp'];
    $k=0;
    @$groupe=$_POST["classe"];

    $req="select * from groupes  ";
    $reponse = $pdo->query($req);
    $row =$reponse->fetchAll();

    if($reponse->rowCount()==0){
        
        /* header("location:index.php"); */
        echo("PAS d'étudiants ! ");
        

    }



    $tab=array();
    $i=0;
    foreach ($row as $gr ) {
        $tab[$i]=$gr["nomgrp"];
        $i=$i+1;

    }

    @$classe=$_POST['classe'];
    @$valider=$_POST['valider'];
    @$nom=$_GET['nom'];
    @$_SESSION['z']=$cl1;
    
  
  
  
    
    $req1="SELECT * FROM etudiant where Classe='$classe'";
    $reponse1 = $pdo->query($req1);
    
    if($reponse1->rowCount()>0) {
        $outputs["etudiants"]=array();
    while ($row1 = $reponse1->fetchAll()) {
            $etudiant = array();
            
            $etudiant['nom'] = $row1['nom'];
            
             array_push($outputs["etudiants"], $etudiant);
        }
        // success
        $outputs["success"] = 1;
        ;
    } else {
        $outputs["success"] = 0;
        $outputs["message"] = "Pas d'étudiants";
        // echo no users JSON
        
    }
  
    

}







?>








<script>
    function reload() {
    location.reload(true);
}
</script>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SCO-ENICAR Saisir Absence</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet" />
  </head>
  <body onload="refresh()">
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
            <a class="nav-link" href="#"
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

    <?php echo ($_SESSION['z']) ; ?>
    
    <?php echo("bonjour") ; ?>



    <main role="main">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
          <p>
            Pour signaler, annuler ou justifier une absence, choisissez d'abord
            le groupe, le module puis l'étudiant concerné!
          </p>
        </div>
      </div>
      

      <div class="container">
        <form method="post">
          <div class="form-group">
            <label for="semaine">Choisir une semaine:</label><br />
            <input
              id="semaine"
              type="week"
              name="debut"
              size="10"
              class="datepicker"
            />
          </div>
         
          
          <div class="form-group">
            <label for="classe">Choisir un groupe:</label><br />
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
              onchange="getval(this)"
              id="classe"
              onCchange
              name="classe"
              class="custom-select custom-select-sm custom-select-lg"
              value="classe"
            >
            
            <?php foreach ($tab as $cl ) :?>
              
                 <?php echo '<option method="post" selected value="'.$cl.'" name="classe"  id="classe" >'.$cl. '</option>'  ; ?>
                

            <?php endforeach  ?>
              
            </select>
          </div>
          <?php echo $cl1 ; ?>
          

          
          
          <div class="form-group">
            <label for="module">Choisir un module:</label><br />
            <select
              id="module"
              name="module"
              class="custom-select custom-select-sm custom-select-lg"
            >
              <option value="1">Tech. Web</option>
              <option value="2">SGBD</option>
              <option value="3">MATHS</option>
              <option value="4">ANAL NUM</option>
              <option value="5">UML</option>
              <option value="6">FRANCAIS</option>
              <option value="7">ANGLAIS</option>
            </select>
          </div>

          <table rules="cols" frame="box">
            <tr>
              <th>25 étudiants</th>

              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                Lundi
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                Mardi
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                Mercredi
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                Jeudi
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                Vendredi
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                Samedi
              </th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                07/03/2022
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                08/03/2022
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                09/03/2022
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                10/03/2022
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                11/03/2022
              </th>
              <th
                colspan="2"
                width="100px"
                style="padding-left: 5px; padding-right: 5px"
              >
                12/03/2022
              </th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <th>AM</th>
              <th>PM</th>
              <th>AM</th>
              <th>PM</th>
              <th>AM</th>
              <th>PM</th>
              <th>AM</th>
              <th>PM</th>
              <th>AM</th>
              <th>PM</th>
              <th>AM</th>
              <th>PM</th>
            </tr>
            
            
              
            <tr class="row_3">
              <p id="demo"> </p> 
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
            </tr>
            
            

            <!-- <tr class="row_3">
              <td><b>M. WALID SAAD</b></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
              <td><input type="checkbox" /></td>
            </tr> -->
          </table>
          <br />
          <br />
          <br />
          <!--Bouton Valider-->


          <button  name="valider" type="submit" class="btn btn-primary btn-block">
            ACTUALISER
          </button>
          
          <br />
<SCRIPT>
          function getval(sel)
{
  refresh(sel.value);
    alert(sel.value);
}
</script>
          <script>
    function refresh($groupe) {
        var xmlhttp = new XMLHttpRequest();
        var url = "http://localhost/miniprojet/auth-php-mysql/afficher.php";

    //Envoie de la requete
	xmlhttp.open("POST",url,true);
	xmlhttp.send("groupe=".$groupe);


    
     //Traiter la reponse
     xmlhttp.onreadystatechange=function()
            {  // alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction(this.responseText);
                    alert(this.responseText);
                    console.log(this.responseText);
                    //console.log(this.responseText);
                }
            }
    

    //Parse la reponse JSON
	function myFunction(response1){
		var obj=JSON.parse(response1);
        //alert(obj.success);

        if (obj.success==1)
        {
		var arr=obj.etudiants;
		var i;
    var j=arr.length;
		var out="<table  border=1 >";
		for ( i = 0; i < j; i++) {
			out+="<tr><td>"+
			arr[i].Classe +
			"</td></tr>" ;
		}
		out +="</table>";
		document.getElementById("demo").innerHTML=out;
       }
       else document.getElementById("demo").innerHTML="Aucune Inscriptions!";

    }
}
</script>




          <button name="aa" type="submit" class="btn btn-primary btn-block">
            Valider
          </button>
          
        </form>
      </div>
    </main>

    <footer class="container">
      <p>&copy; ENICAR 2021-2022</p>
    </footer>
    
  </body>
</html>
