<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
    if(isset($_GET["cin"]))
{
    $cin=$_GET["cin"];


include("connexion.php");
         $sel=$pdo->prepare("select cin from etudiant where cin=? limit 1");
         $sel->execute(array($cin));
         $tab=$sel->fetchAll();
         
            $req="DELETE FROM etudiant WHERE cin=$cin ";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="OK";
          
         echo $erreur;
        }
        header("location:supprimerEtudiant.php");
}

?>