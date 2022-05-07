<?php
 session_start();
 
     //$classe=$_REQUEST['classe'];
     
   
include("connexion.php");
$req="SELECT * FROM enseignant_groupe where classe like ('%1%') ";

$reponse = $pdo->query($req);

if($reponse->rowCount()>0) {
	$outputs["etudiants"]=array();




	
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
     
        $etudiant = array();
        
        $etudiant["classe"] = $row["classe"];
        
         array_push($outputs["etudiants"], $etudiant);
     
    }
    // success
    if($outputs["etudiants"]!=[])
    {
    $outputs["success"] = 1;
    }
    else{
     $outputs["success"] = 0;  
    }
     echo json_encode($outputs);
     
}
else {
    $outputs["success"] = 0;
    $outputs["message"] = "Pas d'étudiants";
    // echo no users JSON
    echo json_encode($outputs);
   
}

?>