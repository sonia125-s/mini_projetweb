<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>

<style>
html,
body {
  height: 100%;
}
body {
  margin: 0;
  background: -webkit-linear-gradient(45deg, #49a09d, #5f2c82);
  background: linear-gradient(45deg, #49a09d, #5f2c82);
  font-family: sans-serif;
  font-weight: 100;
}
.container {
  position: absolute;
  top: 70%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}
table {
  width: 800px;
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}
th,
td {
  padding: 15px;
  background-color: rgba(255, 255, 255, 0.2);
  color: #fff;
}
b {
  bottom : 10%;
}
th {
  text-align: left;
}
thead th {
  background-color: #55608f;
}
tbody tr:hover {
  background-color: rgba(255, 255, 255, 0.3);
}
tbody td {
  position: relative;
}
tbody td:hover:before {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  top: -9999px;
  bottom: -9999px;
  background-color: rgba(255, 255, 255, 0.2);
  z-index: -1;
}

</style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Afficher Etudiants</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">

</head>
<body >
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.html" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="ajouter_groupe.php">Ajouter Groupe</a>
                <a class="dropdown-item" href="modifier_groupe.php">Modifier Groupe</a>
                <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="rechercherEtudiant.php">Chercher Etudiant</a>
                <a class="dropdown-item" href="modifierEtudiant.php">Modifier Etudiant</a>
                <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            
              <h1 class="display-4">Liste des groupe</h1>
              <p style="color:#ffcc00;">Cliquer sur le bouton afin de modifier le groupe!</p>
            </div>
          </div>


<div class="container">
<div class="row">
<div class="table-responsive"> 
  
<div class="table table-striped table-hover ">
   <table class="table table-striped table-hover " >
   <tr><th> matiere</th><th> classe </th> <th>action</th></tr>
    <?php
   
    $id=$_SESSION['id'];
   
include("connexion.php");
$req="SELECT * FROM enseignant_groupe  ";

$reponse = $pdo->query($req);

if($reponse->rowCount()>0) {
	$outputs["etudiants"]=array();	
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
     if($row["id_prof"]==$id){
        
        $id = $row["id_prof"];
        $matiere = $row["matiere"];
        $classe= $row["classe"];
        echo "<tr><td>$matiere</td> <td>$classe</td>";
            echo "<td>";
            echo"<a href='modifierG.php?classe=$classe '  onclick='return confirm(\"etre sur!!\");' class='btn btn-warning'>modifier </a>";

            echo" </tr>";
     }
    }
  }
      
    /*
    $req="SELECT * FROM etudiant";
    $reponse = $pdo->query($req);
    if($reponse->rowCount()>0){

        $row = $reponse ->fetchALL();
        for($i=0;$i<count($row);$i++)
        { 
          $cin=$row[$i]['cin'];
          $nom=$row[$i]['nom'];
          $prenom=$row[$i]['prenom'];
          $adresse=$row[$i]['adresse'];
          $email=$row[$i]['email'];
           $classe=$row[$i]['Classe'];
          echo "<tr><td>$cin</td><td>$nom</td><td>$prenom</td> <td>$adresse</td> <td>$email</td><td>$classe</td>";
            echo "<td>";
            echo"<a href='modifier.php?cin=$cin' class='btn btn-warning'>supprimer </a>";

            echo" </tr>";

        }
    }




*/

?>
</div>
</div>
</div>
</div>

<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
 
</body>
</html>